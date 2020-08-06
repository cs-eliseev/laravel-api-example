English | [Русский](https://github.com/cs-eliseev/laravel-api-example/blob/master/README.ru_RU.md)

LARAVEL API EXAMPLE
=======

## Documentation

[Project documentation](https://github.com/cs-eliseev/laravel-api-example/blob/master/src/README.md)

## Description

Uses a stack PHP, MySQL, Nginx.

## Info

### Project link

* Laravel application: http://localhost:6001

|Service|Port|
|:---|:---:|
|HTTP|6002|
|MySQL|6004|
|XDebug|9000|

### Docker containers

|Service|Container name|
|:---|:---:|
|Aplication|laravel-api-workspace|
|Nginx|laravel-api-nginx|
|PHP-FPM|laravel-api-php-fpm|
|MySQL|laravel-api-mysql|

### Laravel project path

```
./src
```

### Logs path

```
./logs
```

### UnitTest report path

```
./src/coverage_report
```

## Usage

### Install developments tools

* Install [docker](https://docs.docker.com/engine/installation/)
* Install [docker-compose](https://docs.docker.com/compose/install/)

### Build application

1. Import dependency

    ```shell
    git clone https://github.com/laradock/laradock.git docker
    ```

1. Build all Docker containers

    ```shell
    docker-compose up --build
    ```

1. Build dependency

    ```shell
    docker exec laravel-api-workspace bash -c 'composer update && php artisan key:generate && php artisan migrate && php artisan passport:install --force'
    ```

### Create db

1. Migrate table
 
    ```shell
    docker exec laravel-api-workspace php artisan migrate
    ```

### Generate test data

1. Run seeding

    ```shell
    docker exec laravel-api-workspace php artisan db:seed
    ```

> Password from all test user `password`
 
### Use UnitTest

UNIT test services: 

1. Go to container

    ```shell
    docker exec -it laravel-api-workspace bash
    ```

1. Run UnitTest

    ```shell
    phpunit
    ```

1. View code coverage

    ```
   ./src/coverage_report/index.html
   ```

***

> Eliseev AK
