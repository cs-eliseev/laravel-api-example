<?php

declare(strict_types=1);

use App\Models\Client;
use App\Models\Email;
use App\Models\Phone;
use Illuminate\Database\Seeder;

/**
 * Class ClientSeeder
 *
 * @description Генерация тестовых клиентов.
 */
final class ClientSeeder extends Seeder
{
    public function run(): void
    {
        factory(Client::class, rand(20, 40))->create()->each(function(Client $client) {
            $client->phones()->saveMany(factory(Phone::class, rand(0, 4))->make());
            $client->emails()->saveMany(factory(Email::class, rand(0, 3))->make());
        });
    }
}
