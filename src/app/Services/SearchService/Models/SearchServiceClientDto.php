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
