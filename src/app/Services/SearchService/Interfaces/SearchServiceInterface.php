<?php

declare(strict_types=1);

namespace App\Services\SearchService\Interfaces;

use Illuminate\Support\Collection;

/**
 * Interface SearchServiceInterface
 *
 * @description Интерфейс реализации поиска.
 */
interface SearchServiceInterface
{
    /**
     * Запуск поиска.
     *
     * @param SearchServiceDTOInterface $dto
     *
     * @return Collection
     */
    public function run(SearchServiceDTOInterface $dto): Collection;
}
