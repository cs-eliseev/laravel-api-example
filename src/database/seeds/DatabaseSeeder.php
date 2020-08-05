<?php

declare(strict_types=1);

use App\Helpers\EnvHelpers;
use Illuminate\Database\Seeder;

final class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        if (!EnvHelpers::isProduction()) {
            $this->call(UserSeeder::class);
            $this->call(ClientSeeder::class);
        }
    }
}
