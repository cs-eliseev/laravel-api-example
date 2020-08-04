<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

/**
 * Class UserController
 *
 * @description Обработка опереаций калькулятора.
 */
class UserController extends BaseController
{
    /**
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function login()
    {
        return $this->response('авторизация не прошла', false);
    }
}
