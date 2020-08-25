<?php

declare(strict_types=1);

namespace App\Services\SearchService\Handlers\Query\Interfaces;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

/**
 * Interface SearchServiceQueryFilterInterface
 *
 * @description Интерфейс построителя фильтров.
 */
interface SearchServiceQueryFilterInterface
{
    /**
     * Список отношений.
     *
     * @return Builder
     */
    public function with(): Builder;

    /**
     * Применать фильтрацию.
     *
     * @return Collection
     */
    public function apply(): Collection;
}
