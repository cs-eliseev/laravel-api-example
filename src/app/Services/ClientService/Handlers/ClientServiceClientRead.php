<?php

declare(strict_types=1);

namespace App\Services\ClientService\Handlers;

use App\Models\Client;
use App\Services\ClientService\Models\ClientServiceDto;
use App\Services\ClientService\Models\ClientServiceEmailsDto;
use App\Services\ClientService\Models\ClientServicePhonesDto;

/**
 * Class ClientServiceClientRead
 *
 * @description Просмотр информации о клиенте.
 */
final class ClientServiceClientRead
{
    /**
     * Запуск процесса.
     *
     * @param Client $client
     *
     * @return ClientServiceDto
     */
    public function run(Client $client): ClientServiceDto
    {
        return new ClientServiceDto(
            $client->first_name,
            $client->last_name,
            new ClientServiceEmailsDto($client->emails->pluck('email')->toArray()),
            new ClientServicePhonesDto($client->phones->pluck('phone')->toArray())
        );
    }
}
