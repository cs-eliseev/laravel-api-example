<?php

declare(strict_types=1);

namespace App\Components\Authorization\Models;

/**
 * Class AuthorizationDto
 *
 * @description Модель авторизации.
 */
final class AuthorizationDto
{
    /**
     * @var string $email
     */
    private string $email;

    /**
     * @var string $password
     */
    private string $password;

    /**
     * AuthorizationDto constructor.
     *
     * @param string $email
     * @param string $password
     */
    public function __construct(string $email, string $password)
    {
        $this->email = $email;
        $this->password = $password;
    }

    /**
     * Получить email.
     *
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * Получить пароль.
     *
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }
}
