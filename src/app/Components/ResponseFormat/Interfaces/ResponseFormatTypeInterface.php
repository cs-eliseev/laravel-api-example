<?php

declare(strict_types=1);

namespace App\Components\ResponseFormat\Interfaces;

/**
 * Interface ResponseFormatTypeInterface
 *
 * @description Интерфейс типов ответа.
 */
interface ResponseFormatTypeInterface
{
    /**
     * Получить данные успешного ответа.
     *
     * @return mixed
     */
    public function getSuccessData();

    /**
     * Получить данные ответа с ошибкой.
     *
     * @return mixed
     */
    public function getErrorData();
}
