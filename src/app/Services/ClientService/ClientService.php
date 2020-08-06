<?php

declare(strict_types=1);

namespace App\Services\ClientService;

use App\Models\Client;
use App\Services\ClientService\Handlers\ClientServiceClientCreate;
use App\Services\ClientService\Handlers\ClientServiceClientDelete;
use App\Services\ClientService\Handlers\ClientServiceClientRead;
use App\Services\ClientService\Handlers\ClientServiceClientUpdate;
use App\Services\ClientService\Models\ClientServiceDto;
use Illuminate\Support\Facades\DB;

/**
 * Class ClientService
 *
 * @description Сервис работы с клиентом.
 */
final class ClientService
{
    /**
     * @var ClientServiceClientCreate $create
     */
    private ClientServiceClientCreate $create;

    /**
     * @var ClientServiceClientRead $read
     */
    private ClientServiceClientRead $read;

    /**
     * @var ClientServiceClientUpdate $update
     */
    private ClientServiceClientUpdate $update;

    /**
     * @var ClientServiceClientDelete $delete
     */
    private ClientServiceClientDelete $delete;

    /**
     * ClientService constructor.
     */
    public function __construct()
    {
        $this->create = new ClientServiceClientCreate();
        $this->read = new ClientServiceClientRead();
        $this->update = new ClientServiceClientUpdate();
        $this->delete = new ClientServiceClientDelete();
    }

    /**
     * Создание клиента.
     *
     * @param ClientServiceDto $dto
     *
     * @return Client
     */
    public function create(ClientServiceDto $dto): Client
    {
        $client = null;

        DB::transaction(function () use (&$client, $dto) {
            $client = $this->create->run($dto);
        });

        return $client;
    }

    /**
     * Получение данных клиента.
     *
     * @param Client $client
     *
     * @return ClientServiceDto
     */
    public function read(Client $client): ClientServiceDto
    {
        return $this->read->run($client);
    }

    /**
     * Обновление данных клиента.
     *
     * @param Client $client
     * @param ClientServiceDto $dto
     */
    public function update(Client $client, ClientServiceDto $dto): void
    {
        DB::transaction(function () use ($client, $dto) {
            $this->update->run($client, $dto);
        });
    }

    /**
     * Удаление клиента.
     *
     * @param Client $client
     */
    public function delete(Client $client): void
    {
        DB::transaction(function () use ($client) {
            $this->delete->run($client);
        });
    }
}
