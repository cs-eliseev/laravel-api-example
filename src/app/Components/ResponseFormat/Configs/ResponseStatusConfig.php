<?php

declare(strict_types=1);

namespace App\Components\ResponseFormat\Configs;

/**
 * Class ResponseStatusConfig
 *
 * @description Статусы ответа.
 */
final class ResponseStatusConfig
{
    public const OK = 1;
    public const ERROR = 0;

    /**
     * Получить код статуса ответа.
     *
     * @param bool $isSuccess
     *
     * @return int
     */
    public static function getSuccessCode(bool $isSuccess): int
    {
        return $isSuccess ? self::OK : self::ERROR;
    }
}
