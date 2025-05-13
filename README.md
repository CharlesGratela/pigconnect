-- how to run the system -- 

1. git clone https://github.com/CharlesGratela/pigconnect.git

2. cd pigconnect

3. composer install

4. cp .env.example .env

5. php artisan key:generate

6. php artisan migrate

7. php artisan db:seed

8. python -m venv myenv

9. myenv\Scripts\activate

10. pip install -r requirements.txt

11. uvicorn app.main:app --reload

12. php artisan serve