<?php

declare(strict_types=1);

namespace App\Components\Authorization\Handlers;

use Illuminate\Support\Facades\Auth;

/**
 * Class AuthorizationLogout
 *
 * @description Обработчик выход.
 */
final class AuthorizationLogout
{
    /**
     * Запуск процесса.
     */
    public function run(): void
    {
        Auth::user()->token()->revoke();
    }
}
