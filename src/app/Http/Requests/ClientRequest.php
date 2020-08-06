<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Configs\ValidationConfig;
use App\Services\ClientService\Models\ClientServiceDto;
use App\Services\ClientService\Models\ClientServiceEmailsDto;
use App\Services\ClientService\Models\ClientServicePhonesDto;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ClientRequest
 *
 * @description Обработчик запроса для клиента.
 *
 * @property string $first_name
 * @property string $last_name
 * @property array $emails
 * @property array $phones
 */
class ClientRequest extends FormRequest
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
        return ValidationConfig::CLIENT;
    }

    /**
     * Получить модель создания заказа.
     *
     * @return ClientServiceDto
     */
    public function getDto(): ClientServiceDto
    {
        return new ClientServiceDto(
            $this->first_name,
            $this->last_name,
            new ClientServiceEmailsDto($this->emails ?? null),
            new ClientServicePhonesDto($this->phones ?? null)
        );
    }
}
