<?php

declare(strict_types=1);

namespace App\Components\ResponseFormat\Models;

/**
 * Class ResponseFormatDto
 *
 * @description Модель данных ответа.
 */
final class ResponseFormatDto
{
    /**
     * Статус ответа.
     *
     * @var bool $success
     */
    private bool $success;

    /**
     * Данные ответа.
     *
     * @var mixed $data
     */
    private $data;

    /**
     * Ошибки ответа.
     *
     * @var mixed $errors
     */
    private $errors;

    /**
     * ResponseFormatDto constructor.
     *
     * @param bool $success
     * @param mixed $data
     * @param mixed $errors
     */
    public function __construct(bool $success, $data = null, $errors = null)
    {
        $this->success = $success;
        $this->data = $data;
        $this->errors = $errors;
    }

    /**
     * Узнать статус ответа.
     *
     * @return bool
     */
    public function isSuccess(): bool
    {
        return $this->success;
    }

    /**
     * Получить данные ответа.
     *
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Получить ошибки ответа.
     *
     * @return string
     */
    public function getErrors(): ?string
    {
        return $this->errors;
    }
}
