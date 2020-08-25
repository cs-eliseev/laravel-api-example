<?php

declare(strict_types=1);

namespace App\Services\SearchService;

use App\Services\SearchService\Configs\SearchServiceBaseConfig;
use App\Services\SearchService\Handlers\SearchServiceManager;
use App\Services\SearchService\Interfaces\SearchServiceFactory;
use Illuminate\Support\ServiceProvider;

/**
 * Class SearchServiceServiceProvider
 *
 * @description Инициализация сервиса.
 */
final class SearchServiceServiceProvider extends ServiceProvider
{
    /**
     * Отложенная загрузка.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Регистрация сервиса.
     */
    public function register()
    {
        $this->registerConfig()
            ->registerAliases()
            ->registerFactory();
    }

    /**
     * Привязки контейнера.
     *
     * @return array
     */
    public function provides(): array
    {
        return [
            SearchServiceFactory::class,
        ];
    }

    /**
     * Инициализация конфига.
     *
     * @return SearchServiceServiceProvider
     */
    private function registerConfig(): SearchServiceServiceProvider
    {
        $this->app['config']->set(
            SearchServiceBaseConfig::DEFAULT_KEY,
            array_replace_recursive(
                $this->app['config']->get(SearchServiceBaseConfig::DEFAULT_KEY, []),
                require __DIR__ . '/Configs/search.php'
            )
        );

        return $this;
    }

    /**
     * Устанавливаем псевдоним для вызова.
     *
     * @return SearchServiceServiceProvider
     */
    private function registerAliases(): SearchServiceServiceProvider
    {
        $this->app->alias(SearchService::class, SearchServiceBaseConfig::ALIAS);

        return $this;
    }

    /**
     * Подключение фабрики.
     *
     * @return SearchServiceServiceProvider
     */
    private function registerFactory(): SearchServiceServiceProvider
    {
        $this->app->singleton(SearchServiceFactory::class, function ($app) {
            return new SearchServiceManager($app);
        });

        return $this;
    }
}
