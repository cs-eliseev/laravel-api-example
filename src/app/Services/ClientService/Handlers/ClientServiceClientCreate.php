<?php

declare(strict_types=1);

namespace App\Services\ClientService\Handlers;

use App\Models\Client;
use App\Services\ClientService\Models\ClientServiceDto;

/**
 * Class ClientServiceClientCreate
 *
 * @description Создвание клиента.
 */
final class ClientServiceClientCreate
{
    /**
     * Запуск процесса.
     *
     * @param ClientServiceDto $dto
     *
     * @return Client
     */
    public function run(ClientServiceDto $dto): Client
    {
        $client = new Client();
        $client->first_name = $dto->getFirstName();
        $client->last_name = $dto->getLastName();
        $client->save();

        $emailsService = new ClientServiceEmailsCreate();
        $emailsService->run($client, $dto->getEmailsDto());

        $phoneService = new ClientServicePhonesCreate();
        $phoneService->run($client, $dto->getPhonesDto());

        return $client;
    }
}
