from datetime import datetime, timedelta
from app.database import SessionLocal
from app.models import User, Pig
from app.email_utils import send_email

def send_weight_update_notifications():
    db = SessionLocal()
    one_month_ago = datetime.now() - timedelta(days=30)
    pigs = db.query(Pig).filter(Pig.last_weight_update < one_month_ago).all()
    notified_users = set()
    for pig in pigs:
        user = db.query(User).filter(User.id == pig.owner_id).first()
        if user and user.email not in notified_users:
            send_email(
                subject="Pig Weight Update Reminder",
                body="Please update the weight of your pigs for this month.",
                to_email=user.email
            )
            notified_users.add(user.email)
    db.close()

if __name__ == "__main__":
    send_weight_update_notifications()