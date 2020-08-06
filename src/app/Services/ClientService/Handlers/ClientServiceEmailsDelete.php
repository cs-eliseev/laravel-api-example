<?php

declare(strict_types=1);

namespace App\Services\ClientService\Handlers;

use App\Models\Client;
use App\Models\Email;

/**
 * Class ClientServiceEmailsDelete
 *
 * @description Удаление emails адресов.
 */
final class ClientServiceEmailsDelete
{
    /**
     * Запуск процесса.
     *
     * @param Client $client
     * @param bool $isForceDelete
     */
    public function run(Client $client, bool $isForceDelete = false): void
    {
        $emails = $client->emails();

        if (!empty($emails)) {
            $emails->each(function (Email $email) use ($isForceDelete) {
                if ($isForceDelete) {
                    $email->forceDelete();
                } else {
                    $email->delete();
                }
            });
        }
    }
}
