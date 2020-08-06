<?php

declare(strict_types=1);

namespace App\Services\SearchService;

use App\Models\Client;
use App\Services\SearchService\Models\SearchServiceClientDto;
use App\Services\SearchService\Models\SearchServiceDto;
use App\Services\SearchService\Models\SearchServiceEmailsDto;
use App\Services\SearchService\Models\SearchServicePhonesDto;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class SearchService
 *
 * @description Сервис поиска клиентов.
 */
final class SearchService
{
    /**
     * Запуск фильтрации.
     *
     * @param SearchServiceDto $dto
     *
     * @return Collection
     */
    public function run(SearchServiceDto $dto): Collection
    {
        $clients = Client::query()->with(['emails', 'phones',]);

        if (!empty($dto->getFirstName())) {
            $clients->where('first_name', '=', $dto->getFirstName());
        }

        if (!empty($dto->getLastName())) {
            $clients->where('last_name', '=', $dto->getLastName());
        }

        if (!empty($dto->getEmail())) {
            $clients->whereHas('emails', function (Builder $query) use ($dto) {
                $query->where('email', '=', $dto->getEmail());
            });
        }

        if (!empty($dto->getPhone())) {
            $clients->whereHas('phones', function (Builder $query) use ($dto) {
                $query->where('phone', '=', $dto->getPhone());
            });
        }

        $response = new Collection();

        $clients->get()->each(function (Client $client) use ($response) {
            $response->push((new SearchServiceClientDto(
                $client->first_name,
                $client->last_name,
                new SearchServiceEmailsDto($client->emails->pluck('email')->toArray()),
                new SearchServicePhonesDto($client->phones->pluck('phone')->toArray())
            ))->toArray());
        });

        return $response;
    }
}
