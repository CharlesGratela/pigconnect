import logging
from fastapi import FastAPI, Depends, HTTPException, Query
from sqlalchemy.orm import Session
from sqlalchemy.exc import SQLAlchemyError
from datetime import datetime
from pydantic import BaseModel
from app.database import SessionLocal, engine, Base
from app.models import BuyersPreference, PigFarmInformation, Pig, UserInteraction, User
import pandas as pd
from sklearn.metrics.pairwise import cosine_similarity
from sklearn.preprocessing import StandardScaler
import os

# Configure logging
log_directory = "/var/www/html/pigconnect/app/logs"
os.makedirs(log_directory, exist_ok=True)
log_file_path = os.path.join(log_directory, "app.log")

logging.basicConfig(
    level=logging.INFO,
    format="%(asctime)s - %(name)s - %(levelname)s - %(message)s",
    handlers=[
        logging.FileHandler(log_file_path),
        logging.StreamHandler()
    ]
)
logger = logging.getLogger(__name__)

Base.metadata.create_all(bind=engine)

app = FastAPI()

# Dependency to get the database session
def get_db():
    db = SessionLocal()
    try:
        yield db
    finally:
        db.close()

class InteractionRequest(BaseModel):
    user_id: int
    pig_id: int

@app.get("/recommendations")
def hybrid_recommendations_endpoint(user_id: int = Query(...), db: Session = Depends(get_db)):
    try:
        logger.info(f"Fetching recommendations for user_id: {user_id}")

        # Fetch user-item interactions
        interactions = fetch_user_item_interactions(db)
        if not interactions:
            logger.info("No user-item interactions found. Using content-based filtering only.")
            user_item_matrix = pd.DataFrame()
        else:
            user_item_matrix = create_user_item_matrix(interactions)
            if user_item_matrix.empty:
                logger.info("User-item matrix is empty. Using content-based filtering only.")
                user_item_matrix = pd.DataFrame()

        if not user_item_matrix.empty:
            user_similarities_df = compute_user_similarities(user_item_matrix)
        else:
            user_similarities_df = pd.DataFrame()

        # Fetch item features and user preferences
        pigs = fetch_item_features(db)
        preferences = fetch_user_preferences(user_id, db)
        if not preferences:
            raise HTTPException(status_code=404, detail="Buyer preferences not found")

        # Filter items based on user preferences
        filtered_pigs = filter_items_based_on_preferences(pigs, preferences, db)
        if not filtered_pigs:
            logger.info("No items match the user's preferences.")
            return {"recommended_items": []}

        item_feature_matrix = create_item_feature_matrix(filtered_pigs)
        if item_feature_matrix.empty:
            logger.info("Item feature matrix is empty.")
            return {"recommended_items": []}

        item_similarities_df = compute_item_similarities(item_feature_matrix)

        # Generate hybrid recommendations
        if not user_similarities_df.empty:
            recommended_pigs = hybrid_recommendations(user_id, user_similarities_df, user_item_matrix, item_similarities_df, filtered_pigs)
        else:
            recommended_pigs = content_based_recommendations(item_similarities_df, filtered_pigs)

        logger.info(f"Recommended items for user_id {user_id}: {recommended_pigs}")

        # Fetch detailed information for recommended pigs
        detailed_recommended_pigs = []
        for pig_id in recommended_pigs:
            pig = next((pig for pig in filtered_pigs if pig.pigId == pig_id), None)
            if pig:
                farm_info = db.query(PigFarmInformation).filter(PigFarmInformation.user_id == pig.user_id).first()
                if farm_info:
                    detailed_recommended_pigs.append({
                        "pigId": pig.pigId,
                        "weight": pig.weight,
                        "age_in_months": (datetime.now().year - pig.date_of_birth.year) * 12 + datetime.now().month - pig.date_of_birth.month,
                        "status": pig.status,
                        "image": pig.image if pig.image else "default_image_path.png",  # Set a default image path if image is None
                        "latitude": farm_info.latitude,
                        "longitude": farm_info.longitude,
                        "min_price_per_kilo": farm_info.min_price_per_kilo,
                        "max_price_per_kilo": farm_info.max_price_per_kilo
                    })

        return {"recommended_items": detailed_recommended_pigs}
    except Exception as e:
        logger.error(f"Failed to fetch recommendations: {e}", exc_info=True)
        raise HTTPException(status_code=500, detail="Failed to fetch recommendations")

@app.post("/api/track_interaction")
def track_interaction(interaction: InteractionRequest, db: Session = Depends(get_db)):
    logger.info(f"Tracking interaction for user_id: {interaction.user_id}, pig_id: {interaction.pig_id}")
    try:
        interaction_record = UserInteraction(user_id=interaction.user_id, pig_id=interaction.pig_id)
        db.add(interaction_record)
        db.commit()
        logger.info("Interaction tracked successfully")
        return {"message": "Interaction tracked successfully"}
    except SQLAlchemyError as e:
        logger.error(f"Error tracking interaction: {e}", exc_info=True)
        db.rollback()
        raise HTTPException(status_code=500, detail="Failed to track interaction")

# Collaborative Filtering Functions
def fetch_user_item_interactions(db: Session):
    interactions = db.query(UserInteraction).all()
    return interactions

def create_user_item_matrix(interactions):
    data = [(interaction.user_id, interaction.pig_id) for interaction in interactions]
    df = pd.DataFrame(data, columns=['user_id', 'pig_id'])
    user_item_matrix = df.pivot_table(index='user_id', columns='pig_id', aggfunc='size', fill_value=0)
    return user_item_matrix

def compute_user_similarities(user_item_matrix):
    user_similarities = cosine_similarity(user_item_matrix)
    user_similarities_df = pd.DataFrame(user_similarities, index=user_item_matrix.index, columns=user_item_matrix.index)
    return user_similarities_df

# Content-Based Filtering Functions
def fetch_item_features(db: Session):
    pigs = db.query(Pig).all()
    return pigs

def fetch_user_preferences(user_id, db: Session):
    preferences = db.query(BuyersPreference).filter(BuyersPreference.user_id == user_id).first()
    return preferences

def filter_items_based_on_preferences(pigs, preferences, db: Session):
    filtered_pigs = []
    for pig in pigs:
        logger.info(f"Evaluating Pig ID: {pig.pigId}, Weight: {pig.weight}")
        farm_info = db.query(PigFarmInformation).filter(PigFarmInformation.user_id == pig.user_id).first()
        if not farm_info:
            logger.info(f"Excluding Pig ID: {pig.pigId} because farm information not found")
            continue
        try:
            preferred_price = float(preferences.price_range)
        except ValueError:
            logger.error(f"Invalid price range format: {preferences.price_range}")
            continue
        if not (farm_info.min_price_per_kilo <= preferred_price <= farm_info.max_price_per_kilo):
            logger.info(f"Excluding Pig ID: {pig.pigId} due to price preference (Preferred: {preferred_price}, Min: {farm_info.min_price_per_kilo}, Max: {farm_info.max_price_per_kilo})")
            continue
        filtered_pigs.append(pig)
        logger.info(f"Including Pig ID: {pig.pigId}")
    return filtered_pigs

def create_item_feature_matrix(pigs):
    data = [(pig.pigId, pig.weight, (datetime.now().year - pig.date_of_birth.year) * 12 + datetime.now().month - pig.date_of_birth.month, pig.status) for pig in pigs]
    df = pd.DataFrame(data, columns=['pigId', 'weight', 'age_in_months', 'status'])
    return df

def compute_item_similarities(item_feature_matrix):
    scaler = StandardScaler()
    item_features_scaled = scaler.fit_transform(item_feature_matrix.drop(columns=['pigId', 'status']))
    item_similarities = cosine_similarity(item_features_scaled)
    item_similarities_df = pd.DataFrame(item_similarities, index=item_feature_matrix['pigId'], columns=item_feature_matrix['pigId'])
    return item_similarities_df

# Hybrid Recommendation Function
def hybrid_recommendations(user_id, user_similarities_df, user_item_matrix, item_similarities_df, filtered_pigs, top_n=5):
    if user_id not in user_similarities_df.index:
        logger.info(f"User ID {user_id} not found in user similarities. Using content-based filtering only.")
        return content_based_recommendations(item_similarities_df, filtered_pigs, top_n)

    # Collaborative filtering recommendations
    similar_users = user_similarities_df[user_id].sort_values(ascending=False).index[1:]
    collaborative_recommendations = user_item_matrix.loc[similar_users].sum().sort_values(ascending=False).index[:top_n]

    # Content-based filtering recommendations
    filtered_pig_ids = [pig.pigId for pig in filtered_pigs]
    content_recommendations = pd.Series(dtype='float64')
    for pig_id in filtered_pig_ids:
        similar_items = item_similarities_df[pig_id].sort_values(ascending=False).index[1:top_n+1]
        if not similar_items.empty:
            content_recommendations = pd.concat([content_recommendations, pd.Series(similar_items)])

    content_recommendations = content_recommendations.value_counts().index[:top_n]

    # Combine recommendations
    hybrid_recommendations = pd.concat([pd.Series(collaborative_recommendations), pd.Series(content_recommendations)]).drop_duplicates().tolist()[:top_n]
    logger.info(f"Collaborative Recommendations: {collaborative_recommendations.tolist()}")
    logger.info(f"Content-Based Recommendations: {content_recommendations.tolist()}")
    logger.info(f"Hybrid Recommendations: {hybrid_recommendations}")

    return hybrid_recommendations

# Content-Based Recommendation Function
def content_based_recommendations(item_similarities_df, filtered_pigs, top_n=5):
    # Content-based filtering recommendations
    filtered_pig_ids = [pig.pigId for pig in filtered_pigs]
    content_recommendations = pd.Series(dtype='float64')
    for pig_id in filtered_pig_ids:
        similar_items = item_similarities_df[pig_id].sort_values(ascending=False).index[1:top_n+1]
        if not similar_items.empty:
            content_recommendations = pd.concat([content_recommendations, pd.Series(similar_items)])

    content_recommendations = content_recommendations.value_counts().index[:top_n]
    logger.info(f"Content-Based Recommendations: {content_recommendations.tolist()}")
    return content_recommendations.tolist()