<?php

declare(strict_types=1);

namespace App\Configs;

/**
 * Class ValidationConfig
 *
 * @description Данные валидации.
 */
final class ValidationConfig
{
    public const AUTHORIZATION = [
        'login' => 'required|string|email',
        'password' => 'required|string',
    ];

    public const CLIENT = [
        'first_name' => 'required|string|alpha|between:2,32',
        'last_name' => 'required|string|alpha|between:2,32',
        'emails' => 'required_without_all:phones',
        'emails.*' => 'string|email|between:6,128',
        'phones.*' => 'numeric|regex:/^[0-9]+$/|between:1000000,99999999999999999999999999999999',
    ];
}
