<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Components\ActivityLog\ActivityLogComponent;
use App\Components\Authorization\Authorization;
use App\Http\Requests\AuthorizationRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

/**
 * Class AuthController
 *
 * @description Обработка подключений пользователя.
 */
final class AuthController extends BaseController
{
    /**
     * Вход в систему.
     *
     * @param AuthorizationRequest $request
     * @param Authorization $authorization
     *
     * @return JsonResponse
     *
     * @throws \Throwable
     */
    public function login(AuthorizationRequest $request, Authorization $authorization): JsonResponse
    {
        $status = Response::HTTP_BAD_REQUEST;
        $isSuccess = false;
        $data = 'Incorrect username or password.';

        if ($authorization->login($request->getDto())) {
            ActivityLogComponent::updateUser();

            $status = Response::HTTP_OK;
            $isSuccess = true;
            $data = [
                'token' => $authorization->getToken(),
            ];
        }

        return $this->response($data, $isSuccess, null, $status);
    }

    /**
     * Выход из системы.
     *
     * @param Authorization $authorization
     *
     * @return JsonResponse
     *
     * @throws \Throwable
     */
    public function logout(Authorization $authorization): JsonResponse
    {
        $isSuccess = $authorization->logout();

        return $this->response(["message" => 'Logged out'], $isSuccess);
    }

    public function test(): JsonResponse
    {
        return $this->response('test');
    }
}
