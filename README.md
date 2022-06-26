#Laravel 9 + Bootstrap 5

Database: MySQL, Local server: Xampp

Installing locally:

Unzip or GIT into a folder of your choice
Command line locate the folder: cd /path/to/project
Make sure Xampp is running (Apache & MySQL)
Create the database in 'phpmyadmin' by the same name as 'DB_DATABASE' in .env.sample
Create the .env environment file based on .env.sample. Check the database, social login credentials, admin email etc.
Create the database tables. Command line: php artisan migrate
Serve the project to localhost. Command line: php artisan serve --port=8001
Open http://127.0.0.1:8001/ in your browser
Packages and dependencies

Laravel 9
Bootstrap 5
Socialite (social logins)
Free admin theme found at https://matrixadmin.wrappixel.com/
Other comments:

Resource controllers for stadardised CRUD
There's admin + user roles managed my middleware
No migration seeds are required for installation.
