<?php

declare(strict_types=1);

namespace App\Services\SearchService\Interfaces;

/**
 * Interface SearchServiceFactory
 *
 * @description Адаптер получения реализации поиска.
 */
interface SearchServiceFactory
{
    /**
     * Получение реализации поиска.
     *
     * @param $driver
     *
     * @return SearchServiceInterface
     */
    public function driver($driver = null);
}
