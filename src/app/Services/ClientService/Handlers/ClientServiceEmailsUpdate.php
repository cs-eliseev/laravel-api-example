<?php

declare(strict_types=1);

namespace App\Services\ClientService\Handlers;

use App\Models\Client;
use App\Models\Email;
use App\Services\ClientService\Models\ClientServiceEmailsDto;

/**
 * Class ClientServiceEmailsUpdate
 *
 * @description Редактирование списка emails адресов.
 */
final class ClientServiceEmailsUpdate
{
    /**
     * Запуск процесса.
     *
     * @param Client $client
     * @param ClientServiceEmailsDto $emailsDto
     */
    public function run(Client $client, ClientServiceEmailsDto $emailsDto): void
    {
        $delete = new ClientServiceEmailsDelete();
        $delete->run($client, true);

        $create = new ClientServiceEmailsCreate();
        $create->run($client, $emailsDto);
    }
}
