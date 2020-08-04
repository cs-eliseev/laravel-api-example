<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Class BaseModel
 *
 * @method static BaseModel find(int $id)
 *
 * @method static Builder|static query() For scopes PHPDoc
 */
abstract class BaseModel extends Model
{
}
