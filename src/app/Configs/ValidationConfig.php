<?php

declare(strict_types=1);

namespace App\Configs;

/**
 * Class ValidationConfig
 *
 * @description
 */
final class ValidationConfig
{
    public const AUTHORIZATION = [
        'login' => 'required|string|email',
        'password' => 'required|string',
    ];
}
