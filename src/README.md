English | [Русский](https://github.com/cs-eliseev/laravel-api-example/blob/master/src/README.ru_RU.md)

LARAVEL API EXAMPLE
=======

## Documentation

* [Laravel documentation](https://laravel.com/docs)
* [Build project](https://github.com/cs-eliseev/laravel-api-example/blob/master/README.md)

## Usage

### API

Current version API 1.0.

Base URL: `/api/v1`

#### Authentication

> POST `/api/v1/auth/login` Get token

__Parameters__ `Body`
```json
{
    "login": "test@example.net",
    "password": "password"
}
```

__Response__ `202`
```json
{
    "id": 1,
     "success": 1,
     "data": {
         "token": "accessToken..."
     }
}
```

__Response__ `400`
```json
{
    "id": 2,
    "success": 0,
    "message": "Incorrect username or password"
}
```

__Response__ `401`
```json
{
    "id": 3,
    "success": 0,
    "message": "Unauthorized",
    "errors": {
        "parameter": [
            "Validation error message text"
        ]
    }
}
```

__Response__ `500`
```json
{
    "id": 4,
    "success": 0,
    "message": "Internal Server Error"
}
```

In the future, you must pass the received `Bearer` token in the `Authorization` key of the request header:
```shell script
curl --location --request GET '/api/v1/api_url' \
--header 'Authorization: Bearer accessToken...' \
--header 'Content-Type: application/json' \
...
```

The token is valid for 15 days.

> GET `/api/v1/auth/logout` Revoke token

__Parameters__ `Header`
```shell script
curl --location --request GET '/api/v1/api_url' \
--header 'Authorization: Bearer accessToken...'
```

__Response__ `204`
```text
NO_CONTENT
```

__Response__ `401`
```json
{
    "id": 5,
    "success": 0,
    "message": "Unauthorized"
}
```

__Response__ `404`
```json
{
    "id": 6,
    "success": 0,
    "message": "Not Found"
}
```

__Response__ `500`
```json
{
    "id": 7,
    "success": 0,
    "message": "Internal Server Error"
}
```

#### Client

> POST `/api/v1/clients` Create client

__Parameters__ `Body`
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

__Response__ `202`
```json
{
    "id": 8,
    "success": 1,
    "data": {
        "id": 100
    }
}
```

__Response__ `422`
```json
{
    "id": 9,
    "success": 0,
    "message": "Unprocessable Entity",
    "errors": {
        "parameter": [
            "Validation error message text"
        ]
    }
}
```

__Response__ `500`
```json
{
    "id": 10,
    "success": 0,
    "message": "Internal Server Error"
}
```

> GET `/api/v1/clients/{id}` Get client info

__Parameters__ `Body`
```json
```

__Response__ `200`
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

__Response__ `404`
```json
{
    "id": 12,
    "success": 0,
    "message": "Not Found"
}
```

__Response__ `500`
```json
{
    "id": 13,
    "success": 0,
    "message": "Internal Server Error"
}
```

> PUT `/api/v1/clients/{id}` Update client

__Parameters__ `Body`
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

__Response__ `204`
```text
NO_CONTENT
```

__Response__ `404`
```json
{
    "id": 14,
    "success": 0,
    "message": "Not Found"
}
```

__Response__ `422`
```json
{
    "id": 15,
    "success": 0,
    "message": "Unprocessable Entity",
    "errors": {
        "parameter": [
            "Validation error message text"
        ]
    }
}
```

__Response__ `500`
```json
{
    "id": 16,
    "success": 0,
    "message": "Internal Server Error"
}
```

> DELETE `/api/v1/clients/{id}` DELETE client

__Parameters__ `Body`
```json
```

__Response__ `204`
```text
NO_CONTENT
```

__Response__ `404`
```json
{
    "id": 17,
    "success": 0,
    "message": "Not Found"
}
```

__Response__ `500`
```json
{
    "id": 18,
    "success": 0,
    "message": "Internal Server Error"
}
```

#### Search clients

> GET `/api/v1/clients/search` Search clients

__Parameters__ `Body`
```json
{
    "first_name": "Ivan",
    "last_name": "Ivanov",
    "email": "ivan@ivanov.com",
    "phones": "4400000"
}
```

__Response__ `200`
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

__Response__ `404`
```json
{
    "id": 20,
    "success": 0,
    "message": "Not Found"
}
```

__Response__ `422`
```json
{
    "id": 21,
    "success": 0,
    "message": "Unprocessable Entity",
    "errors": {
        "parameter": [
            "Validation error message text"
        ]
    }
}
```

__Response__ `500`
```json
{
    "id": 22,
    "success": 0,
    "message": "Internal Server Error"
}
```

## Developers info

### User activity log

View DB table: `activity_log` 

### Logger

Last parameter log is `activity_log_id`.

__Example__
```text
[06.08.2020 05:01:39] local.DEBUG: Emails: ["ivan@ivanov.com","ivan@ivanov.ru"] ['ActivityLog:236']
```

***

> Eliseev AK
