<?php

declare(strict_types=1);

namespace App\Services\SearchService\Models;

/**
 * Class ClientServiceEmailDto
 *
 * @description Модель данных email адресов.
 */
final class SearchServiceEmailsDto
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
    public function __construct(?array $emails)
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
