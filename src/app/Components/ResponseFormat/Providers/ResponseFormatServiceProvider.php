<?php

declare(strict_types=1);

namespace App\Components\ResponseFormat\Providers;

use App\Components\ResponseFormat\Configs\ResponseFormatConfig;
use App\Components\ResponseFormat\Models\ResponseFormatDto;
use App\Components\ResponseFormat\ResponseFormat;
use Illuminate\Routing\ResponseFactory;
use Illuminate\Support\ServiceProvider;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ResponseFormatServiceProvider
 *
 * @description Кастомный формат для респонса.
 *
 * @example config/app.php set provider:
 *
 * 'providers' => [
 *     ...
 *     \App\Components\ResponseFormat\Providers\ResponseFormatServiceProvider::class,
 * ]
 *
 * @example response()->jsonFormat(false, 'ERROR', ['Validate error'], 422);
 */
final class ResponseFormatServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @param ResponseFactory $factory
     */
    public function boot(ResponseFactory $factory): void
    {
        $factory->macro('jsonFormat', function (
            bool $success,
            $data = null,
            $errors = null,
            int $status = Response::HTTP_OK
        ) use ($factory) {
            if (empty($data)) $data = Response::$statusTexts[$status] ?? null;

            $dto = new ResponseFormatDto($success, $data, $errors);
            $responseFormat = new ResponseFormat($dto);

            return $factory->json($responseFormat->getData(ResponseFormatConfig::JSON), $status, [
                'Content-Type' => 'application/json;charset=UTF-8',
                'Charset' => 'utf-8'
            ], JSON_UNESCAPED_UNICODE);
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
