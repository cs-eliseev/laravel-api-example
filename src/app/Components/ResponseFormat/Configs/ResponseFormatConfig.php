<?php

namespace App\Components\ResponseFormat\Configs;

use App\Components\ResponseFormat\Formats\ResponseFormatJson;

/**
 * Class ResponseFormatConfig
 *
 * @description
 */
final class ResponseFormatConfig
{
    public const JSON = 'json';

    /**
     * Карта форматов ответа.
     *
     * @var array $format_map
     */
    private static array $format_map = [
        self::JSON => ResponseFormatJson::class,
    ];

    /**
     * Получить адаптер
     * @param string $type
     *
     * @return string|null
     */
    public static function getFormatAdapterByType(string $type): ?string
    {
        return self::$format_map[$type] ?? null;
    }
}
