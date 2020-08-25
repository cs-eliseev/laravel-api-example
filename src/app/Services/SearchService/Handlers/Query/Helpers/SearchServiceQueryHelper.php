<?php

declare(strict_types=1);

namespace App\Services\SearchService\Handlers\Query\Helpers;

/**
 * Class SearchServiceQueryHelper
 *
 * @description Базовый помошник.
 */
class SearchServiceQueryHelper
{
    public static function getFilterMethodNameByField(string $field)
    {
        return 'filter' . implode('', array_map(
            'ucfirst',
            explode('_', strtolower($field))
        ));
    }
}
