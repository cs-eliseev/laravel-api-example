<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;

/**
 * Class Client
 *
 * @description Клиент.
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 *
 * @property Collection|Email[] $emails
 * @see Client::emails()
 *
 * @property Collection|Phone[] $phones
 * @see Client::phones()
 */
final class Client extends BaseModel
{
    use SoftDeletes;

    /**
     * @var array $fillable
     */
    protected $fillable = [
        'fist_name', 'last_name',
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
        'fist_name'   => 'string',
        'last_name'   => 'string',
    ];

    /**
     * @return HasMany
     */
    public function phones(): HasMany
    {
        return $this->hasMany(Phone::class);
    }

    /**
     * @return HasMany
     */
    public function emails(): HasMany
    {
        return $this->hasMany(Email::class);
    }
}
