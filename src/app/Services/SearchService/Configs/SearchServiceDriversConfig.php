<?php

declare(strict_types=1);

namespace App\Services\SearchService\Configs;

/**
 * Class SearchServiceDriversConfig
 *
 * @description Псевдонимы реализаций поиска.
 */
final class SearchServiceDriversConfig
{
    public const DEFAULT = self::QUERY;
    public const QUERY = 'query';
}
