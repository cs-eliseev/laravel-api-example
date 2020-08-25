<?php

declare(strict_types=1);

namespace App\Services\SearchService\Handlers\Query;

use App\Models\Client;
use App\Services\SearchService\Handlers\Query\Models\SearchServiceClientDto;
use App\Services\SearchService\Handlers\Query\Models\SearchServiceQueryDto;
use App\Services\SearchService\Handlers\Query\Models\SearchServiceEmailsDto;
use App\Services\SearchService\Handlers\Query\Models\SearchServicePhonesDto;
use App\Services\SearchService\Interfaces\SearchServiceDTOInterface;
use App\Services\SearchService\Interfaces\SearchServiceInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class SearchServiceQuery
 *
 * @description Сервис поиска клиентов.
 */
final class SearchServiceQuery implements SearchServiceInterface
{
    /**
     * Запуск фильтрации.
     *
     * @param SearchServiceDTOInterface $dto
     *
     * @var SearchServiceQueryDto $dto
     *
     * @return Collection
     */
    public function run(SearchServiceDTOInterface $dto): Collection
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
