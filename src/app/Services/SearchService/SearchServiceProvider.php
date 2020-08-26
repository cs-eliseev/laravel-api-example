<?php

declare(strict_types=1);

namespace App\Services\SearchService;

use App\Services\SearchService\Configs\SearchServiceBaseConfig;
use App\Services\SearchService\Handlers\SearchServiceManager;
use App\Services\SearchService\Interfaces\SearchServiceFactory;
use Illuminate\Support\ServiceProvider;

/**
 * Class SearchServiceProvider
 *
 * @description Инициализация сервиса.
 */
final class SearchServiceProvider extends ServiceProvider
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
     * @return SearchServiceProvider
     */
    private function registerConfig(): SearchServiceProvider
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
     * @return SearchServiceProvider
     */
    private function registerAliases(): SearchServiceProvider
    {
        $this->app->alias(SearchService::class, SearchServiceBaseConfig::ALIAS);

        return $this;
    }

    /**
     * Подключение фабрики.
     *
     * @return SearchServiceProvider
     */
    private function registerFactory(): SearchServiceProvider
    {
        $this->app->singleton(SearchServiceFactory::class, function ($app) {
            return new SearchServiceManager($app);
        });

        return $this;
    }
}
