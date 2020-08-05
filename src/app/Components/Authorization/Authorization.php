<?php

declare(strict_types=1);

namespace App\Components\Authorization;

use App\Components\Authorization\Handlers\AuthorizationLogin;
use App\Components\Authorization\Handlers\AuthorizationLogout;
use App\Components\Authorization\Models\AuthorizationDto;

/**
 * Class Authorization
 *
 * @description Авторизация.
 */
final class Authorization
{
    /**
     * @var AuthorizationLogin $login
     */
    private AuthorizationLogin $login;

    /**
     * @var AuthorizationLogout $logout
     */
    private AuthorizationLogout $logout;

    /**
     * @var string|null $token
     */
    private ?string $token = null;

    public function __construct()
    {
        $this->login = new AuthorizationLogin();
        $this->logout = new AuthorizationLogout();
    }

    /**
     * Вход в систему.
     *
     * @param AuthorizationDto $dto
     *
     * @return bool
     */
    public function login(AuthorizationDto $dto): bool
    {
        $this->token = $this->login->run($dto);

        return !is_null($this->token);
    }

    /**
     * Выход из системы.
     *
     * @return bool
     */
    public function logout(): bool
    {
        $this->logout->run();
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
