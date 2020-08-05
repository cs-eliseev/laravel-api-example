<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Components\Authorization\Models\AuthorizationDto;
use App\Components\ResponseFormat\Configs\ResponseFormatConfig;
use App\Components\ResponseFormat\Models\ResponseFormatDto;
use App\Components\ResponseFormat\ResponseFormat;
use App\Configs\ValidationConfig;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;

/**
 * Class AuthorizationRequest
 *
 * @description Обработчик запроса авторизации.
 *
 * @property string $login
 * @property string $password
 */
class AuthorizationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return ValidationConfig::AUTHORIZATION;
    }

    /**
     * Получить модель создания заказа.
     *
     * @return AuthorizationDto
     */
    public function getDto(): AuthorizationDto
    {
        return new AuthorizationDto($this->login, $this->password);
    }

    /**
     * Возврат ошибки валидации.
     *
     * @param Validator $validator
     *
     * @throws \Throwable
     */
    protected function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException(response()->jsonFormat(
            false,
            'Unauthorized',
            $validator->errors()->toArray(),
            Response::HTTP_UNAUTHORIZED
        ));
    }
}
