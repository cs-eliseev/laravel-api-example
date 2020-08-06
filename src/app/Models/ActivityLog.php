<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ActivityLog
 *
 * @package App\Models
 *
 * @description Журнал действуй пользователей.
 *
 * @property int $id
 * @property int $user_id
 * @property string $method
 * @property string $route
 * @property int $status
 * @property array extra
 * @property string $ip
 * @property string $description
 *
 * @property User $user
 * @see ActivityLog::user()
 */
final class ActivityLog extends BaseModel
{
    use SoftDeletes;

    /**
     * @var string $table
     */
    protected $table = 'activity_log';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array $dates
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $casts = [
        'description'   => 'string',
        'user_id'       => 'integer',
        'method'        => 'string',
        'route'         => 'string',
        'status'        => 'integer',
        'extra'         => 'array',
        'ip'            => 'ipAddress',
    ];

    protected static array $rules = [
        'description'   => 'required|string',
        'user_id'       => 'nullable|integer',
        'method'        => 'nullable|string',
        'route'         => 'nullable|url',
        'status'        => 'nullable|integer',
        'extra'         => 'nullable|array',
        'ip'            => 'nullable|ip',
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->BelongsTo(User::class);
    }

    /**
     * Получить список правил валидации.
     *
     * @return array
     */
    public static function getRules(): array
    {
        return self::$rules;
    }
}
