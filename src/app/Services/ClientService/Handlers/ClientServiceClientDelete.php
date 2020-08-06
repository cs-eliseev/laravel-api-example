<?php

declare(strict_types=1);

namespace App\Services\ClientService\Handlers;

use App\Models\Client;

/**
 * Class ClientServiceClientDelete
 *
 * @description Удаление клиента.
 */
final class ClientServiceClientDelete
{
    /**
     * Запуск процесса.
     *
     * @param Client $client
     *
     * @throws \Exception
     */
    public function run(Client $client): void
    {
        if (!empty($client)) {
            $emailsService = new ClientServiceEmailsDelete();
            $emailsService->run($client);

            $phoneService = new ClientServicePhonesDelete();
            $phoneService->run($client);

            $client->delete();
        }
    }
}
