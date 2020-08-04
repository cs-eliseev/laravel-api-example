<?php

declare(strict_types=1);

use App\Models\User;
use Illuminate\Database\Seeder;

/**
 * Class UserSeeder
 *
 * @description Генерация тестовых пользователей.
 */
final class UserSeeder extends Seeder
{
    public function run(): void
    {
        factory(User::class, rand(5, 15))->create();
    }
}
