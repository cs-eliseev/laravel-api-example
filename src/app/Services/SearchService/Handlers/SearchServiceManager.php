<?php

declare(strict_types=1);

namespace App\Services\SearchService\Handlers;

use App\Services\SearchService\Configs\SearchServiceBaseConfig;
use App\Services\SearchService\Interfaces\SearchServiceFactory;
use Illuminate\Support\Manager;
use Illuminate\Support\Str;
use InvalidArgumentException;

/**
 * Class SearchServiceManager
 *
 * @description Фабрика для получения поискового инстанса.
 */
final class SearchServiceManager extends Manager implements SearchServiceFactory
{
    /**
     * Данные по уолчанию.
     *
     * @throws \InvalidArgumentException
     *
     * @return string
     */
    public function getDefaultDriver(): string
    {
        return \App\Services\SearchService\Configs\SearchServiceDriversConfig::DEFAULT;
    }

    /**
     * Создание нового инстанса для поиска.
     *
     * @param  string  $driver
     * @return mixed
     *
     * @throws \InvalidArgumentException
     *
     * @Overload
     */
    protected function createDriver($driver)
    {
        // First, we will determine if a custom driver creator exists for the given driver and
        // if it does not we will check for a creator method for the driver. Custom creator
        // callbacks allow developers to build their own "drivers" easily using Closures.
        if (isset($this->customCreators[$driver])) {
            return $this->callCustomCreator($driver);
        } else {
            $method = 'create'.Str::studly($driver).'Driver';

            if (method_exists($this, $method)) {
                return $this->$method();
            }

            $provider = $this->getProviderInstance($driver);
            if (isset($provider)) {
                return new $provider();
            }
        }

        throw new InvalidArgumentException("Driver [$driver] not supported.");
    }

    /**
     * Получить драйвер из конфига.
     *
     * @param string $driver
     *
     * @return string|null
     */
    private function getProviderInstance(string $driver): ?string
    {
        return $this->config->get(SearchServiceBaseConfig::DEFAULT_KEY)[$driver] ?? null;
    }
}
