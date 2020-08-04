<?php

declare(strict_types=1);

namespace App\Components\ResponseFormat\Exceptions;

use App\Exceptions\BaseExceptionInterface;
use App\Exceptions\BaseExceptionTrait;

/**
 * Class ResponseFormatExceptions
 *
 * @description Обработчик исключений форматов ответа.
 */
class ResponseFormatExceptions implements BaseExceptionInterface
{
    use BaseExceptionTrait;

    public const UNDEFINED_TYPE = 10000;
}
