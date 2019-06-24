# O Teste

Deverá ser criado um sistema simples, totalmente desenvolvido em PHP, onde será possível Criar/Editar/Excluir/Listar usuários. O sistema também deve possuir a possibilidade de associar um perfil (role) ao usuário.

Seguem os atributos para cada entidade:

## - USUÁRIO:
1. Nome;
2. E-mail;
3. Telefone;
4. Data de Nascimento;
5. Cargo;
6. Salário;
7. Foto.

## - PERFIL:
1. Nome do perfil
2. Descrição

A foto será um upload na parte de cadastro de usuário, que aparecerá na tela de cadastro/edição, e na listagem a foto deverá ser  exibida;

## Premissas
1. Dever ter alguma alguma dependência via composer;
2. Passar no php code sniffer com PSR-2: Coding Style Guide;
3. Teste unitário de pelo menos 3 funções;
4. Deploy em um repositório do github ou do bitbucket.

## Flexibilidade
Você poderá utilizar qualquer framework para desenvolver o projeto, lembrando que a arquitetura utilizada, você deverá defendê-la pessoalmente na nossa entrevista (caso passe no teste).

## Prazo
O deadline será até  25/06 (terça-feira), e qualquer dúvida pode enviada respondendo este email.


## Configuração do projeto para execução

### DOCKER
O projeto utiliza Docker e Docker Compose para criação do ambiente de desenvolvimento, caso não tenha instalado, segue o link para instalação:
1. https://docs.docker.com/v17.12/install/
2. https://docs.docker.com/compose/install/

### Build e execução dos containers Docker
Observação: A configuração do docker-compose.yml foi configurado para ser executado 
em uma máquina linux, caso use Windows, talvez tenha que fazer alguns ajustes.

```docker-compose up --build -d```

### Para ver os containers rodando
```docker ps```

```
CONTAINER ID        IMAGE               COMMAND                  CREATED             STATUS              PORTS                               NAMES
28d6118b1b6a        crud_php            "docker-php-entrypoi…"   39 hours ago        Up 15 minutes       0.0.0.0:80->80/tcp, 9000/tcp        constanceteste_php_1
aff4e01cc9e7        mysql:5.7           "docker-entrypoint.s…"   39 hours ago        Up 15 minutes       0.0.0.0:3306->3306/tcp, 33060/tcp   crud_mysql_1
```

### Acessar container PHP para configuração do projeto
```docker exec -it constanceteste_php_1 bash```

### Dar permissão 777 nos seguintes diretórios
1. storage/app/public/upload/img/users
2. storage/logs

### Instalar as dependências do projeto
```composer install -vv```

### Criar as tabelas do banco de dado
```php artisan migrate```

A saída do comando acima deverá ser
```
Migration table created successfully.
Migrating: 2019_06_22_000000_create_profiles_table
Migrated:  2019_06_22_000000_create_profiles_table
Migrating: 2019_06_22_204222_create_users_table
Migrated:  2019_06_22_204222_create_users_table
```

### Executar comando para permitir ao Laravel carregar imagem do diretório storage quando for feito upload
``` php artisan storage:link ```

A  saída do comando acima deverá ser
```
The [public/storage] directory has been linked.
```

### Acessar projeto pelo Browser
```http://localhost```

### Acesso ao banco de dados
* localhost: mysql
* usuário: root
* senha: root
* Porta: 3306
* Nome do Banco: Projeto


### Premissas atendidas

#### 1) Dever ter alguma alguma dependência via composer;

Foi atendida usando a biblioteca: http://image.intervention.io/getting_started/installation ("intervention/image": "2.4")

#### 2) Passar no php code sniffer com PSR-2: Coding Style Guide;

Para validar se os controllers e a Trait estão dentro dentro das definições da psr2,
deve-se acessar o container php e instalar CodeSniffer

1. ```curl -OL https://squizlabs.github.io/PHP_CodeSniffer/phpcs.phar```
2. ```pear install PHP_CodeSniffer```
3. ```composer global require "squizlabs/php_codesniffer=*"```

Agora em seguida vamos validar as classes com os comandos:

1. ```php phpcs.phar --standard=PSR2 app/Http/Controllers/ProfileController.php```
2. ```php phpcs.phar --standard=PSR2 app/Http/Controllers/UserController.php```
3. ```php phpcs.phar --standard=PSR2 app/Http/Traits/PhotoManipulation.php```
4. ```php phpcs.phar --standard=PSR2 app/Http/Requests/Profiles/StoreRequest.php```
5. ```php phpcs.phar --standard=PSR2 app/Http/Requests/Profiles/UpdateRequest.php```
6. ```php phpcs.phar --standard=PSR2 app/Http/Requests/Users/StoreRequest.php```
7. ```php phpcs.phar --standard=PSR2 app/Http/Requests/Users/UpdateRequest.php```


A saída dos comandos acima deverá ser:
```
root@28d6118b1b6a:/var/www/html# php phpcs.phar --standard=PSR2 app/Http/Controllers/ProfileController.php
Xdebug could not open the remote debug file '/var/www/html/logs/sitedocker_xdebug.log'.
root@28d6118b1b6a:/var/www/html# php phpcs.phar --standard=PSR2 app/Http/Controllers/UserController.php
Xdebug could not open the remote debug file '/var/www/html/logs/sitedocker_xdebug.log'.
root@28d6118b1b6a:/var/www/html# php phpcs.phar --standard=PSR2 app/Http/Traits/PhotoManipulation.php
Xdebug could not open the remote debug file '/var/www/html/logs/sitedocker_xdebug.log'.
root@0ae994dfca31:/var/www/html# php phpcs.phar --standard=PSR2 app/Http/Requests/Profiles/StoreRequest.php
Xdebug could not open the remote debug file '/var/www/html/logs/sitedocker_xdebug.log'.
root@0ae994dfca31:/var/www/html# php phpcs.phar --standard=PSR2 app/Http/Requests/Profiles/UpdateRequest.php
Xdebug could not open the remote debug file '/var/www/html/logs/sitedocker_xdebug.log'.
root@0ae994dfca31:/var/www/html# php phpcs.phar --standard=PSR2 app/Http/Requests/Users/StoreRequest.php
Xdebug could not open the remote debug file '/var/www/html/logs/sitedocker_xdebug.log'.
root@0ae994dfca31:/var/www/html# php phpcs.phar --standard=PSR2 app/Http/Requests/Users/UpdateRequest.php
Xdebug could not open the remote debug file '/var/www/html/logs/sitedocker_xdebug.log'.

```

#### 3) Teste unitário de pelo menos 3 funções;

Foi atendido implementado a classe de teste que se encontra em tests/Unit/PhotoManipulationTest.php.
Para executar o teste, execute o comando ```./vendor/bin/phpunit``` dentro do container PHP

```
A saída do comando acima deverá ser:

root@28d6118b1b6a:/var/www/html# ./vendor/bin/phpunit
Xdebug could not open the remote debug file '/var/www/html/logs/sitedocker_xdebug.log'.
PHPUnit 6.5.14 by Sebastian Bergmann and contributors.

........                                                            8 / 8 (100%)

Time: 530 ms, Memory: 16.00MB

OK (8 tests, 8 assertions)
```


#### 4) Deploy em um repositório do github ou do bitbucket;

Foi atendido com código versionado no GitHub: https://github.com/tayron/constance-teste


