from app.database import SessionLocal
from app.models import User, FeedingSchedule
from app.email_utils import send_email

def send_feeding_notifications():
    db = SessionLocal()
    users = db.query(User).all()
    for user in users:
        # You can customize the message based on FeedingSchedule if needed
        send_email(
            subject="Feeding Reminder",
            body="It's time to feed your pigs! Please check your feeding schedule.",
            to_email=user.email
        )
    db.close()

if __name__ == "__main__":
    send_feeding_notifications()