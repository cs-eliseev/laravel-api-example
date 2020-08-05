<?php

declare(strict_types=1);

namespace App\Components\ActivityLog\Helpers;

use App\Configs\LangConfig;
use Illuminate\Http\Request;

/**
 * Class ActivityLogLangHelper
 *
 * @description Обработчик запросов языкового пакетов.
 */
final class ActivityLogLangHelper
{
    /**
     * Получить описание по умолчанию.
     *
     * @param string $method
     *
     * @return string
     */
    public static function getDefaultDescriptionByMethod(string $method = ''): string
    {
        switch (strtoupper($method)) {
            case Request::METHOD_GET:
            case Request::METHOD_POST:
            case Request::METHOD_PUT:
            case Request::METHOD_DELETE:
                break;

            case Request::METHOD_PATCH:
                $method = Request::METHOD_PUT;
                break;

            default:
                $method = Request::METHOD_GET;
                break;
        }

        return trans("active_log.description.{$method}", [], LangConfig::EN);
    }
}
