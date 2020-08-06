<?php

declare(strict_types=1);

namespace App\Services\ClientService\Handlers;

use App\Models\Client;
use App\Models\Email;
use App\Services\ClientService\Models\ClientServiceEmailsDto;

/**
 * Class ClientServiceEmailCreate
 *
 * @description Добавление emails адресов.
 */
final class ClientServiceEmailsCreate
{
    /**
     * Запуск процесса.
     *
     * @param Client $client
     * @param ClientServiceEmailsDto $emailsDto
     */
    public function run(Client $client, ClientServiceEmailsDto $emailsDto): void
    {
        $emails = $emailsDto->getEmails();

        if (!empty($emails)) {
            foreach ($emails as $email) {
                $model = new Email();
                $model->email = $email;
                $model->client()->associate($client);
                $model->save();
            }
        }
    }
}
