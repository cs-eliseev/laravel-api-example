<?php

declare(strict_types=1);

namespace App\Components\Authorization;

use App\Components\Authorization\Models\AuthorizationDto;
use Illuminate\Support\Facades\Auth;

/**
 * Class Authorization
 *
 * @description Авторизация.
 */
final class Authorization
{
    /**
     * @var string|null $token
     */
    private ?string $token = null;

    /**
     * Вход в систему.
     *
     * @param AuthorizationDto $dto
     *
     * @return bool
     */
    public function login(AuthorizationDto $dto): bool
    {
        $credentials = [
            'email' => $dto->getEmail(),
            'password' => $dto->getPassword(),
        ];

        if(!Auth::attempt($credentials)) {
            return false;
        }

        $this->token = Auth::user()->createToken('zserfvgy')->accessToken;

        return true;
    }

    /**
     * Выход из системы.
     *
     * @return bool
     */
    public function logout(): bool
    {
        logger("logout" . (Auth::user()->id ?? 0));
        Auth::user()->token()->revoke();
        $this->token = null;

        return true;
    }

    /**
     * Получить токен.
     *
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }
}
