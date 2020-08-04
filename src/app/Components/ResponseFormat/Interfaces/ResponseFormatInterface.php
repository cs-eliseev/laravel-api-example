<?php

declare(strict_types=1);

namespace App\Components\ResponseFormat\Interfaces;

/**
 * Class ResponseFormatInterface
 *
 * @description
 */
interface ResponseFormatInterface
{
    /**
     * Получить данные ответа.
     *
     * @return mixed
     */
    public function getResponseData();
}
