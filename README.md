# Laravel
Laravel samples

Database: MySQL, Local server: Xampp

Installing locally:
1) Unzip or GIT into a folder of your choice
2) Command line locate the folder: cd /path/to/project
3) Make sure Xampp is running (Apache & MySQL)
4) Create the database in 'phpmyadmin' by the same name as 'DB_DATABASE' in .env.sample
5) Create the .env environment file based on .env.sample. Check the database, social login credentials, admin email etc.
6) Create the database tables. Command line: php artisan migrate
7) Serve the project to localhost. Command line: php artisan serve --port=8001
8) Open http://127.0.0.1:8001/ in your browser


Packages and dependencies
1) Laravel 9
2) Bootstrap 5
3) Socialite (social logins)
4) Free admin theme found at https://matrixadmin.wrappixel.com/


Other comments:
1) Resource controllers for stadardised CRUD
2) There's admin + user roles managed my middleware
3) No migration seeds are quired for installation.
