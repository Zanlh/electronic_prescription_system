
# Install xampp
    we need the web server apache and database mysql inorder to run this.
    
# download and setup composer
    well download composer and follow the steps. it will ask for php.exe which can be found in the xampp folder.
   
 # download this repo and place it inside xampp\htdocs.
 also make sure you have some form of git control as it helps with push, pull, merge and commit. simpel googling will help you with how to use it.
 
 # open XAMPP and start mySql and apache
 
 # create a database
 start mySql and apache and open the mysql admin page. there create a new database called laravel.
  
# open the repository that you have downloaded which is inside htdocs and install npm using cmd or terminal if you are using linux
    npm install

# install composer the same way you installed npm
    composer install
    
if you get any errors because of version issue add/edit **"php": "^7.3|8.1.2",** to your composer.json


### create a .env file Copy .env.example file to .env on the root folder. 
if you are using windows, you can type ```copy .env.example .env``` or ```cp .env.example .env``` if using Ubuntu

### install laravel passport
    php artisan passport:install


#### Run php artisan key:generate
if you get any errors because of version issue add/edit **"php": "^7.3|8.1.2",** to your composer.json
#### Run php artisan migrate
you might have isse because you dont have a database table for this create a database table named laravel(this can be anything but make sure that you edit it in the .env file)
Open your .env file and change the database name (DB_DATABASE) to whatever you have, username (DB_USERNAME) and password (DB_PASSWORD) field correspond to your configuration.


#### Run php artisan serve

#### Go to http://localhost:8000/


## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:
Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
