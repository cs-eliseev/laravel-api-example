<?php

declare(strict_types=1);

namespace App\Services\SearchService\Handlers\Query\Models;

use App\Services\SearchService\Interfaces\SearchServiceDTOInterface;

/**
 * Class SearchServiceQueryDto
 *
 * @description Модель данных для поиска.
 */
final class SearchServiceQueryDto implements SearchServiceDTOInterface
{
    /**
     * Имя.
     *
     * @var string|null $firstName
     */
    private ?string $firstName;

    /**
     * Фамилия.
     *
     * @var string|null $lastName
     */
    private ?string $lastName;

    /**
     * email адрес.
     *
     * @var string|null $email
     */
    private ?string $email;

    /**
     * Телефонный номер.
     *
     * @var string|null $phones
     */
    private ?string $phone;

    /**
     * SearchServiceQueryDto constructor.
     *
     * @param string|null $firstName
     * @param string|null $lastName
     * @param string|null $email
     * @param string|null $phone
     */
    public function __construct(?string $firstName, ?string $lastName, ?string $email, ?string $phone)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->phone = $phone;
    }

    /**
     * Получить имя.
     *
     * @return string|null
     */
    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    /**
     * Получить фамилию.
     *
     * @return string|null
     */
    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    /**
     * Получить email адрес.
     *
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * Получить телефонный номер.
     *
     * @return string|null
     */
    public function getPhone(): ?string
    {
        return $this->phone;
    }
}
