<?php

declare(strict_types=1);

namespace App\Filters;

use App\Models\Client;
use App\Components\FilterQuery\Interfaces\FilterQueryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

/**
 * Class ClientFilter
 *
 * @description Фильтрация пользователей.
 */
final class ClientFilterQuery implements FilterQueryInterface
{
    /**
     * Конструктор запросов.
     *
     * @var Builder
     */
    protected Builder $builder;

    /**
     * ClientFilter constructor.
     *
     * @param Builder $builder
     */
    public function __construct(Builder $builder)
    {
        $this->builder = $builder;
    }

    /**
     * Список отношений.
     *
     * @return Builder
     */
    public function with(): Builder
    {
        return $this->builder->with([
            'emails',
            'phones',
        ]);
    }

    /**
     * Применить фильтр;
     *
     * @return Collection
     */
    public function apply(): Collection
    {
        $response = new Collection();

        $this->builder->get()->each(function (Client $client) use ($response) {
            $response->push([
                'first_name' => $client->first_name,
                'last_name' => $client->last_name,
                'emails' => $client->emails->pluck('email')->toArray(),
                'phones' => $client->phones->pluck('phone')->toArray(),
            ]);
        });

        return $response;
    }

    /**
     * @param string $firstName
     *
     * @return Builder
     */
    public function filterFirstName(string $firstName): Builder
    {
        return $this->builder->where('first_name', '=', $firstName);
    }

    /**
     * @param string $lastName
     *
     * @return Builder
     */
    public function filterLastName(string $lastName): Builder
    {
        return $this->builder->where('last_name', '=', $lastName);
    }

    /**
     * @param string $email
     *
     * @return Builder
     */
    public function filterEmail(string $email): Builder
    {
        return $this->builder->whereHas('emails', function (Builder $query) use ($email) {
            $query->where('email', '=', $email);
        });
    }

    /**
     * @param string $phone
     *
     * @return Builder
     */
    public function filterPhone(string $phone): Builder
    {
        return $this->builder->whereHas('phones', function (Builder $query) use ($phone) {
            $query->where('phone', '=', $phone);
        });
    }
}
