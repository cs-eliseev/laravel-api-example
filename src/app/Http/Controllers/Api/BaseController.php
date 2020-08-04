<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Components\ResponseFormat\Configs\ResponseFormatConfig;
use App\Components\ResponseFormat\Models\ResponseFormatDto;
use App\Components\ResponseFormat\ResponseFormat;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

/**
 * Class BaseController
 *
 * @description Базовый класс для контроллеров.
 */
abstract class BaseController extends Controller
{
    use ValidatesRequests;

    /**
     * Шаблон стандартного ответа.
     *
     * @param mixed $data
     * @param bool $isSuccess
     * @param mixed $errors
     * @param int|null $status
     *
     * @return JsonResponse
     *
     * @throws \Throwable
     */
    protected function response(
        $data,
        bool $isSuccess = true,
        $errors = null,
        int $status = null
    ): JsonResponse {

        $status = $status ?? ($isSuccess ? Response::HTTP_OK : Response::HTTP_INTERNAL_SERVER_ERROR);

        $responseFormat = new ResponseFormat(new ResponseFormatDto($isSuccess, $data, $errors));

        return response()->json(
            $responseFormat->getData(ResponseFormatConfig::JSON),
            $status,
            [
                'Content-Type' => 'application/json;charset=UTF-8',
                'Charset' => 'utf-8'
            ],
            JSON_UNESCAPED_UNICODE
        );
    }
}
