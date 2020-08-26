<?php

declare(strict_types=1);

namespace App\Services\SearchService;

use App\Services\SearchService\Interfaces\SearchServiceFactory;
use Illuminate\Support\Facades\Facade;

/**
 * Class SearchService
 *
 * @description Фасад для удобной работы сервиса.
 */
final class SearchService extends Facade
{
    /**
     * Получение имени компонента.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return SearchServiceFactory::class;
    }
}
