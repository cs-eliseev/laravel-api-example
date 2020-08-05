<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Email
 *
 * @description Email адреса клиента.
 *
 * @property int $id
 * @property string $email
 * @property int $client_id
 *
 * @property Client $client
 * @see Email::client()
 */
final class Email extends BaseModel
{
    use SoftDeletes;

    /**
     * @var array $fillable
     */
    protected $fillable = [
        'email',
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
        'email'   => 'string',
    ];

    /**
     * @return BelongsTo
     */
    public function client(): BelongsTo
    {
        return $this->BelongsTo(Client::class);
    }
}
