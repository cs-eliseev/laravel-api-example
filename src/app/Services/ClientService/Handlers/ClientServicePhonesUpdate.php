<?php

declare(strict_types=1);

namespace App\Services\ClientService\Handlers;

use App\Models\Client;
use App\Models\Phone;
use App\Services\ClientService\Models\ClientServicePhonesDto;

/**
 * Class ClientServicePhonesUpdate
 *
 * @description Редактирование списка телефонных номеров.
 */
final class ClientServicePhonesUpdate
{
    /**
     * Запуск процесса.
     *
     * @param Client $client
     * @param ClientServicePhonesDto $phonesDto
     */
    public function run(Client $client, ClientServicePhonesDto $phonesDto): void
    {
        $delete = new ClientServicePhonesDelete();
        $delete->run($client, true);

        $create = new ClientServicePhonesCreate();
        $create->run($client, $phonesDto);
    }
}
