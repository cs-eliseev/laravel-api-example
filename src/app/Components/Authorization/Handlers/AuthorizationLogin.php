<?php

declare(strict_types=1);

namespace App\Components\Authorization\Handlers;

use App\Components\Authorization\Models\AuthorizationDto;
use Illuminate\Support\Facades\Auth;

/**
 * Class AuthorizationLogin
 *
 * @description Обработчик входа.
 */
final class AuthorizationLogin
{
    /**
     * Запуск процесса.
     *
     * @param AuthorizationDto $dto
     *
     * @return string|null
     */
    public function run(AuthorizationDto $dto): ?string
    {
        $token = null;

        $credentials = [
            'email' => $dto->getEmail(),
            'password' => $dto->getPassword(),
        ];

        if(Auth::attempt($credentials)) {
            $token = Auth::user()->createToken(config('app.name'))->accessToken;
        }

        return $token;
    }
}
