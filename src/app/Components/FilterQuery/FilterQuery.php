<?php

declare(strict_types=1);

namespace App\Components\FilterQuery;

use App\Filters\ClientFilterQuery;
use App\Components\FilterQuery\Helpers\FilterQueryHelper;
use App\Components\FilterQuery\Models\FilterQueryDto;
use App\Services\SearchService\Interfaces\SearchServiceDTOInterface;
use App\Services\SearchService\Interfaces\SearchServiceInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * Class FilterQuery
 *
 * @description Сервис поиска клиентов.
 */
final class FilterQuery implements SearchServiceInterface
{
    /**
     * @var ClientFilterQuery $adapter
     */
    private $adapter;

    /**
     * Запуск фильтрации.
     *
     * @param SearchServiceDTOInterface $dto
     *
     * @return Collection
     * @var FilterQueryDto $dto
     *
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
            if (isset($value)) {
                $method = FilterQueryHelper::getFilterMethodNameByField($filter);
                $this->adapter->$method($value);
            }
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
