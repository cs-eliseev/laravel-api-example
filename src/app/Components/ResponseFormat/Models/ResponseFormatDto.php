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
     * Идентификатор ответа.
     *
     * @var int|null $id
     */
    private ?int $id;

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
     * @param null $data
     * @param null $errors
     * @param int|null $id
     */
    public function __construct(bool $success, $data = null, $errors = null, ?int $id = null)
    {
        $this->success = $success;
        $this->data = $data;
        $this->errors = $errors;
        $this->id = $id;
    }

    /**
     * Установить идентификатор ответа.
     *
     * @param int|null $id
     *
     * @return ResponseFormatDto
     */
    public function setId(?int $id): ResponseFormatDto
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Получить идентификатор ответа.
     *
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
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
     * @return mixed
     */
    public function getErrors()
    {
        return $this->errors;
    }
}
