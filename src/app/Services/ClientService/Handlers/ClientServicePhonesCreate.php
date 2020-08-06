<?php

declare(strict_types=1);

namespace App\Services\ClientService\Handlers;

use App\Models\Client;
use App\Models\Phone;
use App\Services\ClientService\Models\ClientServicePhonesDto;

/**
 * Class ClientServicePhonesCreate
 *
 * @description Добавление телефонных номеров.
 */
final class ClientServicePhonesCreate
{
    /**
     * Запуск процесса.
     *
     * @param Client $client
     * @param ClientServicePhonesDto $phonesDto
     */
    public function run(Client $client, ClientServicePhonesDto $phonesDto): void
    {
        $phones = $phonesDto->getPhones();

        if (!empty($phones)) {
            foreach ($phones as $phone) {
                $model = new Phone();
                $model->phone = $phone;
                $model->client()->associate($client);
                $model->save();
            }
        }
    }
}
