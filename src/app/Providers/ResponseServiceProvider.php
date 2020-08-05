<?php

declare(strict_types=1);

namespace App\Providers;

use App\Components\ResponseFormat\Configs\ResponseFormatConfig;
use App\Components\ResponseFormat\Models\ResponseFormatDto;
use App\Components\ResponseFormat\ResponseFormat;
use Illuminate\Routing\ResponseFactory;
use Illuminate\Support\ServiceProvider;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ResponseServiceProvider
 *
 * @description
 */
final class ResponseServiceProvider extends ServiceProvider
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
