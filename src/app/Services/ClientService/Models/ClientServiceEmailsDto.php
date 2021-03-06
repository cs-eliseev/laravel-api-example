<?php

declare(strict_types=1);

namespace App\Services\ClientService\Models;

/**
 * Class ClientServiceEmailDto
 *
 * @description Модель данных email адресов.
 */
final class ClientServiceEmailsDto
{
    /**
     * Список email адресов.
     *
     * @var array|null
     */
    private ?array $emails;

    /**
     * ClientServiceEmailsDto constructor.
     *
     * @param array|null $emails
     */
    public function __construct(?array $emails = null)
    {
        $this->emails = $emails;
    }

    /**
     * Получить список email адресов.
     *
     * @return array|null
     */
    public function getEmails(): ?array
    {
        return $this->emails;
    }
}
