<?php

declare(strict_types=1);

namespace App\Components\ActivityLog\Loggers;

use App\Components\ActivityLog\ActivityLogComponent;
use App\Configs\DateConfig;
use Illuminate\Log\Logger;
use Monolog\Formatter\LineFormatter;

/**
 * Class ActivityLogLoggerFormats
 *
 * @description Кастомный формат вывод логов.
 *
 * @examle config/logging.php add "tap":
 *
 * 'stack' => [
 *     'driver' => 'stack',
 *     'tap' => [\App\Components\ActivityLog\Loggers\ActivityLogLoggerFormats::class],
 *     'channels' => ['single'],
 *     'ignore_exceptions' => false,
 * ],
 */
final class ActivityLogLoggerFormats
{
    /**
     * Customize the given logger instance.
     *
     * @param  Logger  $logger
     * @return void
     */
    public function __invoke(Logger $logger): void
    {
        $index = '';
        $model = ActivityLogComponent::getModel();
        if (!empty($model)) {
            $index = "['ActivityLog:{$model->id}']";
        }
        $format = "[%datetime%] %channel%.%level_name%: %message% %context% %extra% {$index}\n";

        foreach ($logger->getHandlers() as $handler) {
            $handler->setFormatter(new LineFormatter($format, DateConfig::FORMAT_DEFAULT_FULL, true, true,));
        }
    }
}
