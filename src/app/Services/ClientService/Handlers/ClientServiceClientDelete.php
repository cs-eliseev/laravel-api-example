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
     * @param bool $isForceDelete
     *
     * @throws \Exception
     */
    public function run(Client $client, bool $isForceDelete = false): void
    {
        if (!empty($client)) {
            $emailsService = new ClientServiceEmailsDelete();
            $emailsService->run($client, $isForceDelete);

            $phoneService = new ClientServicePhonesDelete();
            $phoneService->run($client, $isForceDelete);

            if ($isForceDelete) {
                $client->forceDelete();
            } else {
                $client->delete();
            }
        }
    }
}
