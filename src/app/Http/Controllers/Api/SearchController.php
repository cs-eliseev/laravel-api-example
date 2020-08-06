<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Requests\SearchRequest;
use App\Models\Client;
use App\Services\SearchService\SearchService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

/**
 * Class SearchController
 *
 * @description Поиск клиентов.
 */
final class SearchController extends BaseController
{
    /**
     * Поиск.
     *
     * @param SearchRequest $request
     * @param SearchService $service
     *
     * @return JsonResponse
     *
     * @throws \Throwable
     */
    public function index(SearchRequest $request, SearchService $service): JsonResponse
    {
        $status = Response::HTTP_OK;
        $isSuccess = true;
        $data = $data = $service->run($request->getDto())->toArray();

        if (empty($data)) {
            $status = Response::HTTP_NOT_FOUND;
            $isSuccess = false;
        }

        return $this->response($data, $isSuccess, null, $status);
    }
}
