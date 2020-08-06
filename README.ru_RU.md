[English](https://github.com/cs-eliseev/laravel-api-example/blob/master/README.md) | Русский

LARAVEL API EXAMPLE
=======

## Документация

[Документация по проекту](https://github.com/cs-eliseev/laravel-api-example/blob/master/src/README.ru_RU.md)

## Описание

Используемый стек: PHP, MySQL, Nginx.

## Информация

### Порты

* Приложение Laravel доступно: http://localhost:6001

|Сервис|Порт|
|:---|:---:|
|HTTP|6002|
|MySQL|6004|
|XDebug|9000|

### Docker контейнеры

|Сервис|Имя контейнера|
|:---|:---:|
|Aplication|laravel-api-workspace|
|Nginx|laravel-api-nginx|
|PHP-FPM|laravel-api-php-fpm|
|MySQL|laravel-api-mysql|

### Путь к проекту

```
./src
```

### Путь к логам

```
./logs
```

### Путь к отчету к UnitTest

```
./src/coverage_report
```

## Использование

### Установка окружения для разработчиков

* Install [docker](https://docs.docker.com/engine/installation/)
* Install [docker-compose](https://docs.docker.com/compose/install/)

### Сборка проекта

1. Импорт зависимостей

    ```shell
    git clone https://github.com/laradock/laradock.git docker
    ```

1. Сборка Docker контейнеров

    ```shell
    docker-compose up --build
    ```

1. Сборка зависимостей

    ```shell
    docker exec laravel-api-workspace bash -c 'composer update && php artisan key:generate && php artisan migrate && php artisan passport:install --force'
    ```

 ### Создание базы данных
 
 1. Миграция таблиц
 
    ```shell
    docker exec laravel-api-workspace php artisan migrate
    ```

 ### Генерация тестовых данных
 
 1. Запуск сидов

    ```shell
    docker exec laravel-api-workspace php artisan db:seed
    ```    

> Тестовый пароль у всех пользователей `password`
 
### Использование UnitTest

UnitTest для сервисов:

1. Перейти в контейнер

    ```shell
    docker exec -it laravel-api-workspace bash
    ```

1. Запустить UnitTest

    ```shell
    phpunit
    ```

1. Просмотр покрытия тестоми

    ```
   ./src/coverage_report/index.html
   ```

## Настройки

### MySQL конфиг

```text
MYSQL_DATABASE=laravel_db
MYSQL_USER=laravel_user
MYSQL_PASSWORD=123456
MYSQL_PORT=6004
```

***

> Елисеев АК
