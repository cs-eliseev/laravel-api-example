<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Phone
 *
 * @description Телефоны клиента.
 *
 * @property int $id
 * @property string $phone
 * @property int $client_id
 *
 * @property Client $client
 * @see Phone::client()
 */
final class Phone extends BaseModel
{
    use SoftDeletes;

    /**
     * @var array $fillable
     */
    protected $fillable = [
        'phone',
    ];

    /**
     * @var array $dates
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * @var array $casts
     */
    protected $casts = [
        'phone'   => 'string',
    ];

    /**
     * @return BelongsTo
     */
    public function client(): BelongsTo
    {
        return $this->BelongsTo(Client::class);
    }
}
