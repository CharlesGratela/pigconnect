from app.database import SessionLocal
from app.models import User
from app.email_utils import send_email

def get_weather_info():
    # Replace this with actual weather API integration
    return "Today's weather is sunny with a high of 30°C."

def send_weather_update_notifications():
    db = SessionLocal()
    weather_info = get_weather_info()
    users = db.query(User).all()
    for user in users:
        send_email(
            subject="Weather Update",
            body=f"Weather update for today: {weather_info}",
            to_email=user.email
        )
    db.close()

if __name__ == "__main__":
    send_weather_update_notifications()