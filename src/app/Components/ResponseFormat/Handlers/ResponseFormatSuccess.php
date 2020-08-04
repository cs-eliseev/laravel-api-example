<?php

declare(strict_types=1);

namespace App\Components\ResponseFormat\Handlers;

use App\Components\ResponseFormat\Interfaces\ResponseFormatInterface;
use App\Components\ResponseFormat\Interfaces\ResponseFormatTypeInterface;

/**
 * Class ResponseFormatSuccess
 *
 * @description Обработчик успешного ответа.
 */
final class ResponseFormatSuccess implements ResponseFormatInterface
{
    /**
     * Адаптер.
     *
     * @var ResponseFormatTypeInterface
     */
    private ResponseFormatTypeInterface $adapter;

    /**
     * ResponseFormatError constructor.
     *
     * @param ResponseFormatTypeInterface $adapter
     */
    public function __construct(ResponseFormatTypeInterface $adapter)
    {
        $this->adapter = $adapter;
    }

    /**
     * Получить данные ответа.
     *
     * @return mixed
     */
    public function getResponseData()
    {
        return $this->adapter->getSuccessData();
    }
}
