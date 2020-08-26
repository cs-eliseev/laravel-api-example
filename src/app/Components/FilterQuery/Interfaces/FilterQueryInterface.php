<?php

declare(strict_types=1);

namespace App\Components\FilterQuery\Interfaces;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

/**
 * Interface FilterQueryInterface
 *
 * @description Интерфейс построителя фильтров.
 */
interface FilterQueryInterface
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
