<?php

declare(strict_types=1);

use App\Services\SearchService\Configs\SearchServiceDriversConfig;

return [
    SearchServiceDriversConfig::QUERY => \App\Components\FilterQuery\FilterQuery::class,
];
