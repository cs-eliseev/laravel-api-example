<?php

declare(strict_types=1);

namespace App\Components\ActivityLog\Loggers;

use App\Components\ActivityLog\ActivityLogComponent;
use App\Configs\DateConfig;
use Illuminate\Log\LogManager as BaseLogManager;
use Monolog\Formatter\LineFormatter;

/**
 * Class ActivityLogLoggerManager
 *
 * @description Кастомный формат вывод логов.
 *
 * @example \App\Providers\AppServiceProvider@register() add:
 *
 * $this->app->singleton('log', function () {
 *     return new ActivityLogLoggerManager($this->app);
 * });
 */
final class ActivityLogLoggerManager extends BaseLogManager
{
    /**
     * Customize logger format.
     *
     * @return void
     */
        protected function formatter()
    {
        $index = '';
        $model = ActivityLogComponent::getModel();
        if (!empty($model)) {
            $index = "['ActivityLog:{$model->id}']";
        }
        $format = "[%datetime%] %channel%.%level_name%: %message% %context% %extra% {$index}\n";

        return tap(
            new LineFormatter($format, DateConfig::FORMAT_DEFAULT_FULL, true, true),
            function ($formatter) {
                $formatter->includeStacktraces();
            }
        );
    }
}
