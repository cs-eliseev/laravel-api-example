<?php

declare(strict_types=1);

namespace App\Services\SearchService\Handlers\Query\Models;

/**
 * Class SearchServicePhonesDto
 *
 * @description Модель данных телефонных номеров.
 */
final class SearchServicePhonesDto
{
    /**
     * @var array|null
     */
    private ?array $phones;

    /**
     * ClientServicePhonesDto constructor.
     *
     * @param array|null $phones
     */
    public function __construct(?array $phones)
    {
        $this->phones = $phones;
    }

    /**
     * Получить список телефонных номеров.
     *
     * @return array|null
     */
    public function getPhones(): ?array
    {
        return $this->phones;
    }
}
