## Laravel Api - Pastelaria

## Dependencies

* laravel-cors

## Instalation


Acesse o caminho raiz do seu servidor e execute o comando abaixo para clonar o projeto.

```
cd /server/root/path
git clone https://github.com/ldmotta/LaravelApi.git
```

* Se você estiver utilizando Mac ou Linux, você também pode clonar o projeto em outra pasta do seu computador, e executar o comando ```ls -l``` para criar um link simbólico de seu projeto para o caminho raiz do servidor.

```
cd /var/www/html

ls -l ~/full/application/path /var/www/html/laravel_api
```


<!-- Execute o comando de instalação do Laravel 6, executando o comando abaixo no terminal.

```bash
composer create-project --prefer-dist laravel/laravel pastelaria "6.*"
``` -->

Para resolver problema de CORS, instale o [laravel-cors](https://github.com/spatie/laravel-cors)

```bash
composer require spatie/laravel-cors
```

No arquivo .env, defina as configurações do servidor de e-mail para testar o envio de e-mail e as configurações de banco de dados para se conectar ao banco de dados da aplicação.

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
* Se você estiver usando outro servidor de e-mail em vez de mailtrap, basicamente você precisa mudar ```MAIL_HOST, MAIL_PORT, MAIL_USERNAME, MAIL_PASSWORD``` and ```MAIL_FROM_ADDRESS```

**DB settings:**

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_db_username
DB_PASSWORD=your_db_password
```

Execute o comando de migração para criar as tabela.

```
php artisan migrate
```

Para popular a tabela de produtos, execute o comando abaixo.
```
php artisan db:seed
```

Para executar o projeto, rode o comando abaixo no terminal:

```
php artisan serve
```

Para testar a aplicação, você pode utilizar o arquivo de collections do Postman (Laravel_Api.postman_collection.json), que está localizado na raíz do projeto.