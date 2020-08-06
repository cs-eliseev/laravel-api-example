<?php

declare(strict_types=1);

namespace App\Services\ClientService\Models;

/**
 * Class ClientServiceDto
 *
 * @description Модель данных Клиента.
 */
final class ClientServiceDto
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
     * @var ClientServiceEmailsDto $emails
     */
    private ClientServiceEmailsDto $emails;

    /**
     * Список телефонных номеров.
     *
     * @var ClientServicePhonesDto $phones
     */
    private ClientServicePhonesDto $phones;

    /**
     * ClientServiceDto constructor.
     *
     * @param string $firstName
     * @param string $lastName
     * @param ClientServiceEmailsDto $emails
     * @param ClientServicePhonesDto $phones
     */
    public function __construct(
        string $firstName,
        string $lastName,
        ClientServiceEmailsDto $emails,
        ClientServicePhonesDto $phones
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
     * @return ClientServiceEmailsDto
     */
    public function getEmailsDto(): ClientServiceEmailsDto
    {
        return $this->emails;
    }

    /**
     * Получить модель данных телефонных номеров.
     *
     * @return ClientServicePhonesDto
     */
    public function getPhonesDto(): ClientServicePhonesDto
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
