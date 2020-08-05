<?php

declare(strict_types=1);

namespace App\Helpers;

/**
 * Class EnvHelpers
 *
 * @description Обработчик env файла.
 */
final class EnvHelpers
{
    public const APP_ENV_PRODUCTION = 'production';

    /**
     * isProduction.
     *
     * @return bool
     */
    public static function isProduction(): bool
    {
        return config('app.env') == self::APP_ENV_PRODUCTION;
    }
}
