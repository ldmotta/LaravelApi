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

In the .env file, configure your mailtrap account settings or another Mail Server application to test send email.

```
MAIL_DRIVER=smtp
MAIL_HOST=**smtp.mailtrap.io**
MAIL_PORT=2525
MAIL_USERNAME=**your_username**
MAIL_PASSWORD=**yout_password**
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=**"from_email@email.com"**
MAIL_FROM_NAME="${APP_NAME}"
```

