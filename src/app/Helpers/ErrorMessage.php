<?php

declare(strict_types=1);

namespace App\Helpers;

use App\Configs\ErrorConfig;
use App\Configs\ExceptionCodeConfig;
use App\Exceptions\BaseExceptionInterface;
use Illuminate\Support\Collection;
use Throwable;

/**
 * Class ErrorMessage
 *
 * @description Дополнительный функционал для обработки ошибок.
 */
final class ErrorMessage
{
    /**
     * Получить сообщение об ошибки для фронта.
     *
     * @param Throwable $e
     *
     * @return Collection
     */
    public static function getResponseMessage(Throwable $e): Collection
    {
        $code = ExceptionCodeConfig::UNKNOWN_ERROR;
        $params = [];

        if ($e instanceof BaseExceptionInterface) {
            $code = $e->getCode();
            $params = $e->getMsgParams();
        }

        $msg = trans("error_code.{$code}", $params, ErrorConfig::LOCAL_FRONT);

        return collect([
           'code' => $e->getCode(),
           'message' => $msg,
        ]);
    }

    /**
     * Получить сообщение об ошибке.
     *
     * @param int $code
     * @param array $params
     * @param string $local
     *
     * @return string
     */
    public static function geExceptionMsg(int $code, array $params = [], string $local = ErrorConfig::LOCAL_BACK): string
    {
        return trans("error_code.{$code}", $params, $local) ?? trans('error_code.' . ExceptionCodeConfig::UNKNOWN_ERROR, [], $local);
    }

    /**
     * Получить отладочную информаицб из исключения.
     *
     * @param Throwable $exception
     *
     * @return string
     */
    public static function getDebugInfoByException(Throwable $exception): string
    {
        return "Exception message: [{$exception->getCode()}] {$exception->getMessage()}" . PHP_EOL . $exception->getTraceAsString();
    }

    /**
     * Обработка сообщений об ошибке от валидатора.
     *
     * @param $errors
     * @param $data
     *
     * @return string
     */
    public static function prepareValidateErrorMessage($errors, $data)
    {
        $errors = JsonHelper::decode(JsonHelper::encode($errors));
        array_walk($errors, function (&$value, $key) use ($data) {
            array_push($value, "Value: $data[$key]");
        });

        return JsonHelper::encode($errors);
    }
}
