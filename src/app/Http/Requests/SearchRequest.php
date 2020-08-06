<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Configs\ValidationConfig;
use App\Services\SearchService\Models\SearchServiceDto;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class SearchRequest
 *
 * @description Обработчик запроса для клиента.
 *
 * @property string|null $first_name
 * @property string|null $last_name
 * @property string|null $email
 * @property string|null $phone
 */
class SearchRequest extends FormRequest
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
        return ValidationConfig::SEARCH;
    }

    /**
     * Получить модель создания заказа.
     *
     * @return SearchServiceDto
     */
    public function getDto(): SearchServiceDto
    {
        return new SearchServiceDto(
            $this->first_name,
            $this->last_name,
            $this->email,
            $this->phone
        );
    }
}
