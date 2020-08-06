<?php

declare(strict_types=1);

namespace App\Services\SearchService\Models;

/**
 * Class SearchServiceClientDto
 *
 * @description Модель данных Клиента.
 */
final class SearchServiceClientDto
{
    /**
     * Имя.
     *
     * @var string $firstName
     */
    private string $firstName;

    /**
     * Фамилия.
     *
     * @var string $lastName
     */
    private string $lastName;

    /**
     * Список email адресов.
     *
     * @var SearchServiceEmailsDto $emails
     */
    private SearchServiceEmailsDto $emails;

    /**
     * Список телефонных номеров.
     *
     * @var SearchServicePhonesDto $phones
     */
    private SearchServicePhonesDto $phones;

    /**
     * ClientServiceDto constructor.
     *
     * @param string $firstName
     * @param string $lastName
     * @param SearchServiceEmailsDto $emails
     * @param SearchServicePhonesDto $phones
     */
    public function __construct(
        string $firstName,
        string $lastName,
        SearchServiceEmailsDto $emails,
        SearchServicePhonesDto $phones
    ) {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->emails = $emails;
        $this->phones = $phones;
    }

    /**
     * Получить имя.
     *
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * Получить фамилию.
     *
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * Получить список email адресов.
     *
     * @return array|null
     */
    public function getEmails(): ?array
    {
        return $this->emails->getEmails();
    }

    /**
     * Получить список телефонных номеров.
     *
     * @return array|null
     */
    public function getPhones(): ?array
    {
        return $this->phones->getPhones();
    }

    /**
     * Получить модель данных email адресов.
     *
     * @return SearchServiceEmailsDto
     */
    public function getEmailsDto(): SearchServiceEmailsDto
    {
        return $this->emails;
    }

    /**
     * Получить модель данных телефонных номеров.
     *
     * @return SearchServicePhonesDto
     */
    public function getPhonesDto(): SearchServicePhonesDto
    {
        return $this->phones;
    }

    /**
     * Вернуть ввиде массива.
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
           'first_name' => $this->firstName,
           'last_name' => $this->lastName,
           'emails' => $this->emails->getEmails(),
           'phones' => $this->phones->getPhones(),
        ];
    }
}
