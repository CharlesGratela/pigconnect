import logging
import re
from fastapi import FastAPI, Depends, HTTPException, Query
from sqlalchemy.orm import Session
from sqlalchemy.exc import SQLAlchemyError
from sqlalchemy import func
from datetime import datetime
from pydantic import BaseModel
from app.database import SessionLocal, engine, Base
from app.models import BuyersPreference, PigFarmInformation, Pig, UserInteraction, User, BuyerInformation
import pandas as pd
from sklearn.metrics.pairwise import cosine_similarity
from sklearn.preprocessing import StandardScaler
import os
import openai


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

# Set OpenAI API key
openai.api_key = os.getenv("OPENAI_API_KEY")

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

        # Fetch user preferences
        preferences = fetch_user_preferences(user_id, db)
        if not preferences:
            logger.warning(f"No preferences found for user_id: {user_id}")
            preferences = None

        logger.info(f"Fetched user preferences: {preferences}")

        # Fetch user interactions
        interactions = fetch_user_item_interactions(db, user_id)
        logger.info(f"Fetched {len(interactions)} user-item interactions.")

        # Fetch all pigs
        pigs = fetch_pigs(db)
        logger.info(f"Fetched {len(pigs)} pigs from the database.")

        # Generate recommendations using OpenAI
        recommendations = get_openai_recommendations(user_id, preferences, pigs)
        logger.info(f"Recommendations fetched from OpenAI: {recommendations}")

        return {"recommendations": recommendations}
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

def fetch_user_preferences(user_id, db: Session):
    preferences = db.query(BuyersPreference).filter(BuyersPreference.user_id == user_id).first()
    buyer_info = db.query(BuyerInformation).filter(BuyerInformation.user_id == user_id).first()
    logger.info(f"Fetched buyer info: {buyer_info}")
    if preferences and buyer_info:
        preferences.latitude = buyer_info.latitude
        preferences.longitude = buyer_info.longitude

    logger.info(f"Fetched user preferences: {preferences}")
    return preferences

def fetch_user_item_interactions(db: Session, user_id: int):
    interactions = db.query(
        UserInteraction.pig_id,
        func.count(UserInteraction.id).label('interaction_count')
    ).filter(UserInteraction.user_id == user_id).group_by(UserInteraction.pig_id).all()
    
    logger.info(f"Fetched {len(interactions)} user-item interactions from the database.")
    return interactions

def fetch_pigs(db: Session):
    pigs = db.query(
        Pig.pigId,
        Pig.weight,
        Pig.date_of_birth,
        Pig.status,
        Pig.image,
        Pig.breed,
        Pig.price_per_kilo,
        Pig.user_id,
        PigFarmInformation.latitude,
        PigFarmInformation.longitude
    ).join(PigFarmInformation, Pig.user_id == PigFarmInformation.user_id).filter(Pig.status == 'healthy').all()

    pig_list = [
        {
            "pigId": pig[0],
            "weight": pig[1],
            "date_of_birth": pig[2],
            "status": pig[3],
            "image": pig[4],
            "breed": pig[5],
            "price_per_kilo": pig[6],
            "latitude": pig[8],
            "longitude": pig[9]
        }
        for pig in pigs
    ]

    logger.info(f"Fetched all healthy pigs with farm information: {pig_list}")
    return pig_list

def get_openai_recommendations(user_id, preferences, pigs):
    prompt = generate_prompt(user_id, preferences, pigs)
    try:
        response = openai.ChatCompletion.create(
            model="gpt-4o",
            messages=[
                {"role": "system", "content": "You are a helpful assistant."},
                {"role": "user", "content": prompt}
            ]
        )
    except openai.error.OpenAIError as e:
        logger.error(f"OpenAI API error: {e}")
        raise HTTPException(status_code=500, detail=f"OpenAI API error: {e}")

    recommendations = response.choices[0].message['content'].strip()
    
    # Log the decoded recommendation response
    logger.info(f"Decoded recommendation response: {recommendations}")

    # Extract pig IDs from the recommendations text
    pig_ids = re.findall(r'- pigId: (\d+)', recommendations)
    logger.info(f"Extracted pig IDs from the response: {pig_ids}")

    # Format the response to match the required format

    return pig_ids

def generate_prompt(user_id, preferences, pigs):
    pig_details = [
        {
            "pigId": pig["pigId"],
            "weight": pig["weight"],
            "date_of_birth": pig["date_of_birth"].strftime("%Y-%m-%d"),
            "price_per_kilo": pig["price_per_kilo"],
            "status": pig["status"],
            "breed": pig["breed"]
        }
        for pig in pigs
    ]
    current_date = datetime.now().strftime("%Y-%m-%d")
    prompt = f"Generate pig recommendations for user ID: {user_id} based on the following preferences as of {current_date}:\n"
    
    if preferences:
        prompt += "Preferences:\n"
        prompt += f"  Preferred Age: {preferences.age_of_pigs}\n"
        prompt += f"  Weight Range: {preferences.preferred_weight}\n"
        prompt += f"  Preferred Price: {preferences.price_range}\n"
        if preferences.breed:
            prompt += f"  Preferred Breed: {preferences.breed}\n"
        if preferences.prefer_nearby:
            prompt += f"  Prefer Nearby: Yes\n"
            prompt += f"  Latitude: {preferences.latitude}\n"
            prompt += f"  Longitude: {preferences.longitude}\n"
        else:
            prompt += "  Prefer Nearby: No\n"
        prompt += f"Pigs: {pig_details}\n"
        prompt += f"Filter them based on preferred age then sort them weight and price. Just provide only the pig IDs in the recommendations and set them as pigId and return with a format like this:\n"
        prompt += "- pigId: 1234 and with explanation after giving the recommendations\n"
    else:
        prompt += "Preferences: None\n"
        prompt += f"Pigs: {pig_details}\n"
        prompt += "Just random sort the pigs. Just provide only the pig IDs in the recommendations and set them as pigId and return with a format like this:\n"
        prompt += "- pigId: 1432 and with no explanation\n"
    
    logger.info(f"Generated prompt: {prompt}")
    return prompt