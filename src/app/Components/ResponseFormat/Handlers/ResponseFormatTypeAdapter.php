<?php

declare(strict_types=1);

namespace App\Components\ResponseFormat\Handlers;

use App\Components\ResponseFormat\Configs\ResponseFormatConfig;
use App\Components\ResponseFormat\Exceptions\ResponseFormatExceptions;
use App\Components\ResponseFormat\Interfaces\ResponseFormatTypeInterface;
use App\Components\ResponseFormat\Models\ResponseFormatDto;

/**
 * Class ResponseFormatTypeAdapter
 *
 * @description Адаптер инициализации формата ответа.
 */
class ResponseFormatTypeAdapter
{
    /**
     * Инициализация формирования ответа.
     *
     * @param string $type
     * @param ResponseFormatDto $dto
     *
     * @return ResponseFormatTypeInterface
     *
     * @throws \Throwable
     */
    public static function init(string $type, ResponseFormatDto $dto): ResponseFormatTypeInterface
    {
        $adapter = ResponseFormatConfig::getFormatAdapterByType($type);

        if (empty($adapter)) {
            ResponseFormatExceptions::throwException(ResponseFormatExceptions::UNDEFINED_TYPE);
        }

        return new $adapter($dto);
    }
}
