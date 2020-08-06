[English](https://github.com/cs-eliseev/laravel-api-example/blob/master/src/README.md) | Русский

LARAVEL API EXAMPLE
=======

## Документация

* [Документация Laravel](https://laravel.com/docs)
* [Сборка проетка](https://github.com/cs-eliseev/laravel-api-example/blob/master/README.ru_RU.md)

## Использование

### API

Текущая версия API 1.0.

Базовый URL: `/api/v1`

#### Аутентификация

> POST `/api/v1/auth/login` Получение токена

__Парамерты__ `Body`
```json
{
    "login": "test@example.net",
    "password": "password"
}
```

__Ответ__ `202`
```json
{
    "id": 1,
     "success": 1,
     "data": {
         "token": "accessToken..."
     }
}
```

__Ответ__ `400`
```json
{
    "id": 2,
    "success": 0,
    "message": "Incorrect username or password"
}
```

__Ответ__ `401`
```json
{
    "id": 3,
    "success": 0,
    "message": "Unauthorized",
    "errors": {
        "parameter": [
            "Текст сообщение ошибки валидации"
        ]
    }
}
```

__Ответ__ `500`
```json
{
    "id": 4,
    "success": 0,
    "message": "Internal Server Error"
}
```

В дальнейшем вы должны передать полученный токен `Bearer` в ключе `Authorization` заголовка запроса:
```shell script
curl --location --request GET '/api/v1/api_url' \
--header 'Authorization: Bearer accessToken...' \
--header 'Content-Type: application/json' \
...
```

Токен действителен в течении 15 дней.

> GET `/api/v1/auth/logout` Аннулирование токена

__Парамерты__ `Header`
```shell script
curl --location --request GET '/api/v1/api_url' \
--header 'Authorization: Bearer accessToken...'
```

__Ответ__ `204`
```text
NO_CONTENT
```

__Ответ__ `401`
```json
{
    "id": 5,
    "success": 0,
    "message": "Unauthorized"
}
```

__Ответ__ `404`
```json
{
    "id": 6,
    "success": 0,
    "message": "Not Found"
}
```

__Ответ__ `500`
```json
{
    "id": 7,
    "success": 0,
    "message": "Internal Server Error"
}
```

#### Клиент

> POST `/api/v1/clients` Создание клиента

__Парамерты__ `Body`
```json
{
    "first_name": "Ivan",
    "last_name": "Ivanov",
    "emails": [
        "ivan@ivanov.com", "ivan@ivanov.ru"
    ],
    "phones": [
        "4400000", "88004400000"
    ]
}
```

__Ответ__ `202`
```json
{
    "id": 8,
    "success": 1,
    "data": {
        "id": 100
    }
}
```

__Ответ__ `422`
```json
{
    "id": 9,
    "success": 0,
    "message": "Unprocessable Entity",
    "errors": {
        "parameter": [
            "Текст сообщение ошибки валидации"
        ]
    }
}
```

__Ответ__ `500`
```json
{
    "id": 10,
    "success": 0,
    "message": "Internal Server Error"
}
```

> GET `/api/v1/clients/{id}` Получение информации о клиенте

__Парамерты__ `Body`
```json
```

__Ответ__ `200`
```json
{
    "id": 11,
    "success": 1,
    "data": {
        "first_name": "Ivan",
        "last_name": "Ivanov",
        "emails": [
            "ivan@ivanov.com",
            "ivan@ivanov.ru"
        ],
        "phones": [
            "4400000",
            "88004400000"
        ]
    }
}
```

__Ответ__ `404`
```json
{
    "id": 12,
    "success": 0,
    "message": "Not Found"
}
```

__Ответ__ `500`
```json
{
    "id": 13,
    "success": 0,
    "message": "Internal Server Error"
}
```

> PUT `/api/v1/clients/{id}` Обновление данных клиента

__Парамерты__ `Body`
```json
{
    "first_name": "Ivan",
    "last_name": "Ivanov",
    "emails": [
        "ivan@ivanov.com", "ivan@ivanov.ru"
    ],
    "phones": [
        "4400000", "88004400000"
    ]
}
```

__Ответ__ `204`
```text
NO_CONTENT
```

__Ответ__ `404`
```json
{
    "id": 14,
    "success": 0,
    "message": "Not Found"
}
```

__Ответ__ `422`
```json
{
    "id": 15,
    "success": 0,
    "message": "Unprocessable Entity",
    "errors": {
        "parameter": [
            "Текст сообщение ошибки валидации"
        ]
    }
}
```

__Ответ__ `500`
```json
{
    "id": 16,
    "success": 0,
    "message": "Internal Server Error"
}
```

> DELETE `/api/v1/clients/{id}` Удаление клиента

__Парамерты__ `Body`
```json
```

__Ответ__ `204`
```text
NO_CONTENT
```

__Ответ__ `404`
```json
{
    "id": 17,
    "success": 0,
    "message": "Not Found"
}
```

__Ответ__ `500`
```json
{
    "id": 18,
    "success": 0,
    "message": "Internal Server Error"
}
```

#### Поиск клиентов

> GET `/api/v1/clients/search` Поиск клиентов

__Парамерты__ `Body`
```json
{
    "first_name": "Ivan",
    "last_name": "Ivanov",
    "email": "ivan@ivanov.com",
    "phones": "4400000"
}
```

__Ответ__ `200`
```json
{
    "id": 19,
    "success": 1,
    "data": [
        {
            "first_name": "Ivan",
            "last_name": "Ivanov",
            "emails": [
                "ivan@ivanov.com",
                "ivan@ivanov.ru"
            ],
            "phones": [
                "4400000",
                "88004400000"
            ]
        }
    ]
}
```

__Ответ__ `404`
```json
{
    "id": 20,
    "success": 0,
    "message": "Not Found"
}
```

__Ответ__ `422`
```json
{
    "id": 21,
    "success": 0,
    "message": "Unprocessable Entity",
    "errors": {
        "parameter": [
            "Текст сообщение ошибки валидации"
        ]
    }
}
```

__Ответ__ `500`
```json
{
    "id": 22,
    "success": 0,
    "message": "Internal Server Error"
}
```

## Информация для разработчиков

### Логирование пользовательчких действий

Информация доступна в таблице: `activity_log` 

### Логирование

В последнем параметре логов отображается `activity_log_id`.

__Пример__
```text
[06.08.2020 05:01:39] local.DEBUG: Emails: ["ivan@ivanov.com","ivan@ivanov.ru"] ['ActivityLog:236']
```

***

> Елисеев АК
