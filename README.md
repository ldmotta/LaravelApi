## Laravel Api - Pastelaria

## Dependencies

* laravel-cors

## Instalation

Execute the command below to clone the application.

```
git clone https://github.com/ldmotta/LaravelApi.git
```

<!-- Execute o comando de instalação do Laravel 6, executando o comando abaixo no terminal.

```bash
composer create-project --prefer-dist laravel/laravel pastelaria "6.*"
``` -->

To resolve CORS isuers, install the [laravel-cors](https://github.com/spatie/laravel-cors)

```bash
composer require spatie/laravel-cors
```

On the .env file, define your Mail Server settings to test send email, and your db settings to connect.

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
* If you are using another mail settings instead of mailtrap, basicaly, you need to change ```MAIL_HOST, MAIL_PORT, MAIL_USERNAME, MAIL_PASSWORD``` and ```MAIL_FROM_ADDRESS```

**DB settings:**

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel_api
DB_USERNAME=db_user
DB_PASSWORD=db_pass
```