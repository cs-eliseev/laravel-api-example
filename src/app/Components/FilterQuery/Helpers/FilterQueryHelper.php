<?php

declare(strict_types=1);

namespace App\Components\FilterQuery\Helpers;

/**
 * Class FilterQueryHelper
 *
 * @description Базовый помошник.
 */
class FilterQueryHelper
{
    /**
     * Преобразовать в CamelCase
     * @param string $field
     *
     * @return string
     */
    public static function getFilterMethodNameByField(string $field): string
    {
        return 'filter' . implode('', array_map(
            'ucfirst',
            explode('_', strtolower($field))
        ));
    }
}
