## Laravel Api - Pastelaria

## Dependencies

* [composer](https://getcomposer.org/)
* [laravel-cors](https://github.com/spatie/laravel-cors)
* [docker-composer](https://docs.docker.com/compose/)
* PHP 7.3 ou superior

## Instalation

1. Abra o terminal, acesse um diretório qualquer da sua unidade de disco rígido e execute o comando abaixo.

```
git clone https://github.com/ldmotta/LaravelApi.git
```

2. Acesse a raiz da aplicação e execute o comando ```cd LaravelApi/```, em seguida, utilize a imagem do composer para montar os diretórios que você precisará para seu projeto Laravel e evite os custos de instalar o Composer globalmente:

```
cd LaravelApi

sudo docker run --rm -v $(pwd):/app composer install
```

3. Defina as permissões no diretório do projeto para que ele seja propriedade do seu usuário não root:
```
sudo chown -R $USER:$USER ~/DiretorioDaPlicacao/LaravelApi
```

4. Após finalizar a instalação renomeie o arquivo ```.env.example``` localizado na raiz do projeto, para ```.env```

5. Utilizando um editor de sua preferência, abra o arquivo .env, e defina as configurações do servidor de e-mail para testar o envio de e-mail.

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

6. Crie uma base de dados para a aplicação. Ex. laravel_api e configure no arquivo .env a sessão de variáveis de acesso ao banco. Ex.

```
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=your_db_username
DB_PASSWORD=your_db_password
```

Para executar o projeto, acesse o container e rode o comando abaixo no terminal:
```
docker-compose up -d
```

* Neste momento você já pode acessar a sua aplicação na url http://localhost

Crie um usuário para o MySql
```
docker-compose exec db bash

root@6b2a39b018af:/# mysql -u root -p
```

* Você será solicitado a inserir a senha que você definiu para a conta root do MySQL durante a instalação no seu arquivo docker-compose.

```
mysql> GRANT ALL ON laravel.* TO 'laraveluser'@'%' IDENTIFIED BY 'your_laravel_db_password';
```

Reinicie os privilégios para notificar o servidor MySQL das alterações:
```
mysql> FLUSH PRIVILEGES;
```

Saindo do MySql
```
mysql> EXIT;
```

Saia do contêiner:
```
root@6b2a39b018af:/# exit
```

Este comando gerará uma chave e a copiará para seu arquivo .env, garantindo que as sessões do seu usuário e os dados criptografados permaneçam seguros:
```
docker-compose exec app php artisan key:generate
```

Você tem agora as configurações de ambiente necessárias para executar seu aplicativo. Para colocar essas configurações em um arquivo de cache, que irá aumentar a velocidade de carregamento do seu aplicativo, execute:
```
docker-compose exec app php artisan config:cache
```

Acesse o terminal e digite o comando abaixo para criar o link simbólico para acesso as imagens publicas
```
docker-compose exec app php artisan storage:link
```

Execute o comando de migração para criar as tabela.
```
docker-compose exec app php artisan migrate
```

Para popular a tabela de produtos, execute o comando abaixo.
```
docker-compose exec app php artisan db:seed
```

Para resolver problema de CORS, instale o [laravel-cors](https://github.com/spatie/laravel-cors)
```bash
docker-compose exec app composer require spatie/laravel-cors
```
Para testar a aplicação, você pode utilizar o arquivo de collections do Postman (Laravel_Api.postman_collection.json), que está localizado na raíz do projeto.
