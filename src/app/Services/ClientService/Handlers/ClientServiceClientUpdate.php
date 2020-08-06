<?php

declare(strict_types=1);

namespace App\Services\ClientService\Handlers;

use App\Models\Client;
use App\Services\ClientService\Models\ClientServiceDto;

/**
 * Class ClientServiceClientUpdate
 *
 * @description Редактирование данных клиента.
 */
final class ClientServiceClientUpdate
{
    /**
     * Запуск процесса.
     *
     * @param Client $client
     * @param ClientServiceDto $dto
     */
    public function run(Client $client, ClientServiceDto $dto): void
    {
        $client->first_name = $dto->getFirstName();
        $client->last_name = $dto->getLastName();
        $client->save();

        $emailsService = new ClientServiceEmailsUpdate();
        $emailsService->run($client, $dto->getEmailsDto());

        $phoneService = new ClientServicePhonesUpdate();
        $phoneService->run($client, $dto->getPhonesDto());
    }
}
