<?php

declare(strict_types=1);

namespace App\Components\ResponseFormat\Formats;

use App\Components\ResponseFormat\Configs\ResponseStatusConfig;
use App\Components\ResponseFormat\Interfaces\ResponseFormatTypeInterface;
use App\Components\ResponseFormat\Models\ResponseFormatDto;

/**
 * Class ResponseFormatJson
 *
 * @description Обарботчик JSON формата ответа.
 */
final class ResponseFormatJson implements ResponseFormatTypeInterface
{
    /**
     * Модель данных.
     *
     * @var ResponseFormatDto
     */
    private ResponseFormatDto $dto;

    /**
     * ResponseFormatJson constructor.
     *
     * @param ResponseFormatDto $dto
     */
    public function __construct(ResponseFormatDto $dto)
    {
        $this->dto = $dto;
    }

    /**
     * Формат успешного ответа.
     *
     * @return array
     */
    public function getSuccessData(): array
    {
        $data = [
            'success' => ResponseStatusConfig::getSuccessCode($this->dto->isSuccess()),
        ];

        if (!empty($this->dto->getData())) {
            $data['data'] = $this->dto->getData();
        }

        return $data;
    }

    /**
     * Формат неудачного ответа.
     *
     * @return array
     */
    public function getErrorData(): array
    {
        $data = [
            'success' => ResponseStatusConfig::getSuccessCode($this->dto->isSuccess()),
            'message' => $this->dto->getData(),
        ];

        if (!empty($this->dto->getErrors())) {
            $data['errors'] = $this->dto->getErrors();
        }

        return $data;
    }
}
