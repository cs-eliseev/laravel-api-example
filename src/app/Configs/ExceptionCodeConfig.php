<?php

declare(strict_types=1);

namespace App\Configs;

use App\Components\ResponseFormat\Exceptions\ResponseFormatExceptions;

/**
 * Class ExceptionCodeConfig
 *
 * @description Коды ошибок.
 */
final class ExceptionCodeConfig
{
    public const UNKNOWN_ERROR                  = 0;

    public const RESPONSE_FORMAT_UNDEFINED_TYPE = ResponseFormatExceptions::UNDEFINED_TYPE;
}
