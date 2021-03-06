<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Requests\ClientRequest;
use App\Models\Client;
use App\Services\ClientService\ClientService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

/**
 * Class ClientController
 *
 * @description Управление клиентами.
 */
final class ClientController extends BaseController
{
    /**
     * Создание клиента.
     *
     * @param ClientRequest $request
     * @param ClientService $service
     *
     * @return JsonResponse
     *
     * @throws \Throwable
     */
    public function create(ClientRequest $request, ClientService $service): JsonResponse
    {
        $client = $service->create($request->getDto());

        return $this->response(['id' => $client->id], true, null, Response::HTTP_ACCEPTED);
    }

    /**
     * Получить данные пользователя.
     *
     * @param ClientService $service
     * @param int $id
     *
     * @return JsonResponse
     *
     * @throws \Throwable
     */
    public function read(ClientService $service, int $id): JsonResponse
    {
        $status = Response::HTTP_NOT_FOUND;
        $isSuccess = false;
        $data = null;

        $client = Client::find($id);

        if (!empty($client)) {
            $status = Response::HTTP_OK;
            $isSuccess = true;
            $data = $service->read($client)->toArray();
        }

        return $this->response($data, $isSuccess, null, $status);
    }

    /**
     * Обновить данные пользователя.
     *
     * @param ClientRequest $request
     * @param ClientService $service
     * @param int $id
     *
     * @return JsonResponse
     *
     * @throws \Throwable
     */
    public function update(ClientRequest $request, ClientService $service, int $id): JsonResponse
    {
        $status = Response::HTTP_NOT_FOUND;
        $isSuccess = false;

        $client = Client::find($id);

        if (!empty($client)) {
            $status = Response::HTTP_NO_CONTENT;
            $isSuccess = true;
            $service->update($client, $request->getDto());
        }

        return $this->response(null, $isSuccess, null, $status);
    }

    /**
     * Удаление пользователя.
     *
     * @param ClientService $service
     * @param int $id
     *
     * @return JsonResponse
     *
     * @throws \Throwable
     */
    public function delete(ClientService $service, int $id): JsonResponse
    {
        $status = Response::HTTP_NOT_FOUND;
        $isSuccess = false;

        $client = Client::find($id);

        if (!empty($client)) {
            $status = Response::HTTP_NO_CONTENT;
            $isSuccess = true;
            $service->delete($client);
        }

        return $this->response(null, $isSuccess, null, $status);
    }
}
