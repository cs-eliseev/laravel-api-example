<?php

declare(strict_types=1);

namespace App\Services\SearchService\Handlers\Query;

use App\Filters\ClientFilter;
use App\Services\SearchService\Handlers\Query\Helpers\SearchServiceQueryHelper;
use App\Services\SearchService\Handlers\Query\Models\SearchServiceQueryDto;
use App\Services\SearchService\Interfaces\SearchServiceDTOInterface;
use App\Services\SearchService\Interfaces\SearchServiceInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * Class SearchServiceQuery
 *
 * @description Сервис поиска клиентов.
 */
final class SearchServiceQuery implements SearchServiceInterface
{
    /**
     * @var ClientFilter $adapter
     */
    private $adapter;

    /**
     * Запуск фильтрации.
     *
     * @param SearchServiceDTOInterface $dto
     *
     * @var SearchServiceQueryDto $dto
     *
     * @return Collection
     */
    public function run(SearchServiceDTOInterface $dto): Collection
    {
        $driver = $dto->getDriver();

        $this->adapter = new $driver($this->transformBuilder($dto->getBuilder()));
        $this->adapter->with();

        $this->buildFilter($dto->getFilters());

        return $this->adapter->apply();
    }

    /**
     * Сборка фильтров.
     *
     * @param $filters
     */
    public function buildFilter($filters): void
    {
        foreach ($filters as $filter => $value) {
            $method = SearchServiceQueryHelper::getFilterMethodNameByField($filter);
            $this->adapter->$method($value);
        }
    }

    /**
     * Превратить в Builder
     *
     * @param string|Model|Builder $builder
     *
     * @return Builder
     */
    private function transformBuilder($builder): Builder
    {
        if (is_string($builder)) {
            return $builder::query();
        }

        if ($builder instanceof Model) {
            return $builder->query();
        }

        return $builder;
    }
}
