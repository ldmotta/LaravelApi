## Laravel Api - Pastelaria

## Dependencies

* laravel-cors

## Instalation

Access your server root path, and execute the command below to clone the application. (e.g. cd /var/www/html/).

```
cd /server/root/path
git clone https://github.com/ldmotta/LaravelApi.git
```

* If you are familiarized with the ```ls -l``` command, you may want to clone the project in another folder and create a symbolic link form your application to your server root path

```
cd /var/www/html
ls -l ~/full_application_path /var/www/html/laravel_api
```


<!-- Execute o comando de instalação do Laravel 6, executando o comando abaixo no terminal.

```bash
composer create-project --prefer-dist laravel/laravel pastelaria "6.*"
``` -->

To resolve CORS isuers, install the [laravel-cors](https://github.com/spatie/laravel-cors)

```bash
composer require spatie/laravel-cors
```

On the .env file, define your Mail Server settings to test send email, and your db settings to connect to your database.

**Mail settings:**

```
MAIL_DRIVER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_username
MAIL_PASSWORD=yout_password
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="from_email@email.com"
MAIL_FROM_NAME="${APP_NAME}"
```
* If you are using another mail settings instead of mailtrap, basicaly you need to change ```MAIL_HOST, MAIL_PORT, MAIL_USERNAME, MAIL_PASSWORD``` and ```MAIL_FROM_ADDRESS```

**DB settings:**

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_db_username
DB_PASSWORD=your_db_password
```

Execute the migration command to create the tables

```
php artisan migrate
```

To populate default informations on your database, execute the command below
```
php artisan db:seed
```
To execute the server application, run tha command:

```
php artisan serve
```