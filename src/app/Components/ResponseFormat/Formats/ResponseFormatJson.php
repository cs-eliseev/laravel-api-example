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
        $result = [
            'id' => $this->dto->getId(),
            'success' => ResponseStatusConfig::getSuccessCode($this->dto->isSuccess()),
        ];

        $data = $this->dto->getData();

        if (!empty($data)) {
            $result['data'] = is_array($data) ? $data : ['message' => $data];
        }

        return $result;
    }

    /**
     * Формат неудачного ответа.
     *
     * @return array
     */
    public function getErrorData(): array
    {
        $result = [
            'id' => $this->dto->getId(),
            'success' => ResponseStatusConfig::getSuccessCode($this->dto->isSuccess()),
            'message' => $this->dto->getData(),
        ];

        if (!empty($this->dto->getErrors())) {
            $result['errors'] = $this->dto->getErrors();
        }

        return $result;
    }
}
