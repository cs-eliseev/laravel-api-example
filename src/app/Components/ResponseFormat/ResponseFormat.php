<?php

declare(strict_types=1);

namespace App\Components\ResponseFormat;

use App\Components\ActivityLog\ActivityLogComponent;
use App\Components\ResponseFormat\Handlers\ResponseFormatError;
use App\Components\ResponseFormat\Handlers\ResponseFormatSuccess;
use App\Components\ResponseFormat\Handlers\ResponseFormatTypeAdapter;
use App\Components\ResponseFormat\Interfaces\ResponseFormatInterface;
use App\Components\ResponseFormat\Models\ResponseFormatDto;

/**
 * Class ResponseFormat
 *
 * @description формат ответа.
 */
final class ResponseFormat
{
    /**
     * @var ResponseFormatDto $dto
     */
    private ResponseFormatDto $dto;

    /**
     * ResponseFormat constructor.
     *
     * @param ResponseFormatDto $dto
     *
     * @throws \Throwable
     */
    public function __construct(ResponseFormatDto $dto)
    {
        $this->dto = $dto;

        if (empty($this->dto->getId())) {

            $activityLog = ActivityLogComponent::getModel();
            $this->dto->setId(!empty($activityLog) ? $activityLog->id : 0);
        }
    }

    /**
     * Получить данные для ответа.
     *
     * @param string $type
     *
     * @return mixed
     *
     * @throws \Throwable
     */
    public function getData(string $type)
    {
        return $this->init($type, $this->dto->isSuccess())->getResponseData();
    }

    /**
     * Получение данных успешного ответа.
     *
     * @param string $type
     *
     * @return mixed
     *
     * @throws \Throwable
     */
    public function getSuccessData(string $type)
    {
        return $this->init($type, true)->getResponseData();
    }

    /**
     * Получение данных неудачно ответа.
     *
     * @param string $type
     *
     * @return mixed
     *
     * @throws \Throwable
     */
    public function getErrorData(string $type)
    {
        return $this->init($type, false)->getResponseData();
    }

    /**
     * Инициализация адаптера.
     *
     * @param string $type
     * @param bool $isSuccess
     *
     * @return ResponseFormatInterface
     *
     * @throws \Throwable
     */
    private function init(string $type, bool $isSuccess): ResponseFormatInterface
    {
        $adapter = ResponseFormatTypeAdapter::init($type, $this->dto);

        return $isSuccess ? new ResponseFormatSuccess($adapter) : new ResponseFormatError($adapter);
    }
}
