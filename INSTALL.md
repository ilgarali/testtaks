Clone the project. 
git clone https://github.com/ilgarali/testtaks.git

Create .env file.
Copy everything from the .env.example into .env.

Change these credentials according to your environment

DB_CONNECTION=mysql

DB_HOST=127.0.0.1

DB_PORT=3306

DB_DATABASE=algoritmatask

DB_USERNAME=root

DB_PASSWORD=

Run these command in your project directory: 

composer install

php artisan key:generate

php artisan migrate:fresh --seed

php artisan serve


