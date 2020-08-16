## Laravel Api - Pastelaria

## Dependencies

* [composer](https://getcomposer.org/)
* [laravel-cors](https://github.com/spatie/laravel-cors)
* PHP 7.3 ou superior

## Instalation

1. Abra o terminal, acesse um diretório qualquer da sua unidade de disco rígido e execute o comando abaixo.

```
git clone https://github.com/ldmotta/LaravelApi.git
```

2. Acesse a raiz da aplicação e execute o comando ```cd LaravelApi/``` e instale a aplicação via composer
```
composer install
```

3. Utilize um editor de sua preferência, e na raíz do projeto, renomeie o arquivo ```.env.example``` para ```.env```

4. No arquivo .env, defina as configurações do servidor de e-mail para testar o envio de e-mail e as configurações de banco de dados para se conectar ao banco de dados da aplicação.

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
5. Crie uma base de dados para a aplicação. Ex. laravel_api e configura no arquivo .env a sessão de variáveis de acesso ao banco. Ex.

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel_api
DB_USERNAME=your_db_username
DB_PASSWORD=your_db_password
```

Acesse o terminal e digite o comando abaixo para criar o link simbólico para acesso as imagens publicas
```
php artisan storage:link
```

Execute o comando de migração para criar as tabela.
```
php artisan migrate
```

Para popular a tabela de produtos, execute o comando abaixo.
```
php artisan db:seed
```

Para resolver problema de CORS, instale o [laravel-cors](https://github.com/spatie/laravel-cors)
```bash
composer require spatie/laravel-cors
```

Para executar o projeto, rode o comando abaixo no terminal:

```
php artisan serve
```

Para testar a aplicação, você pode utilizar o arquivo de collections do Postman (Laravel_Api.postman_collection.json), que está localizado na raíz do projeto.
