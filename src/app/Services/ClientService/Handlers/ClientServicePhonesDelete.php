<?php

declare(strict_types=1);

namespace App\Services\ClientService\Handlers;

use App\Models\Client;
use App\Models\Phone;

/**
 * Class ClientServicePhonesDelete
 *
 * @description Удаление телефонных номеров.
 */
final class ClientServicePhonesDelete
{
    /**
     * Запуск процесса.
     *
     * @param Client $client
     * @param bool $isForceDelete
     */
    public function run(Client $client, bool $isForceDelete = false): void
    {
        $phones = $client->phones();

        if (!empty($phones)) {
            $phones->each(function (Phone $phone) use ($isForceDelete) {
                if ($isForceDelete) {
                    $phone->forceDelete();
                } else {
                    $phone->delete();
                }
            });
        }
    }
}
