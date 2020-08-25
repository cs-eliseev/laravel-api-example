<?php

declare(strict_types=1);

namespace App\Services\SearchService\Handlers\Query\Models;

use App\Services\SearchService\Interfaces\SearchServiceDTOInterface;
use Illuminate\Database\Query\Builder;

/**
 * Class SearchServiceQueryDto
 *
 * @description Модель данных для поиска.
 */
final class SearchServiceQueryDto implements SearchServiceDTOInterface
{
    /**
     * Конструктор запросов.
     *
     * @var Builder $builder
     */
    protected $builder;

    /**
     * Модель фильтра.
     *
     * @var string $driver
     */
    protected string $driver;

    /**
     * Параметры фильтрации.
     *
     * @var array $filters
     */
    protected array $filters;

    /**
     * SearchServiceQueryDto constructor.
     *
     * @param Builder $builder
     * @param string $driver
     * @param null|array $filters
     */
    public function __construct($builder, string $driver, ?array $filters = [])
    {
        $this->builder = $builder;
        $this->driver = $driver;
        $this->filters = $filters;
    }

    /**
     * Получить конструктор запросов.
     *
     * @return Builder
     */
    public function getBuilder()
    {
        return $this->builder;
    }

    /**
     * Получить механизм фильтрации.
     *
     * @return string
     */
    public function getDriver(): string
    {
        return $this->driver;
    }

    /**
     * Параметры фильтрации.
     *
     * @return array
     */
    public function getFilters(): array
    {
        return $this->filters;
    }
}
