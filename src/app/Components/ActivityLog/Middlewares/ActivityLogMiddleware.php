<?php

declare(strict_types=1);

namespace App\Components\ActivityLog\Middlewares;

use App\Components\ActivityLog\ActivityLogComponent;
use Closure;
use Illuminate\Contracts\Auth\Guard;

/**
 * Class ActivityLogMiddleware
 *
 * @description Обработка входящих запросов.
 */
final class ActivityLogMiddleware
{
    protected $auth;

    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param Closure $next
     * @param mixed $description
     *
     * @return mixed
     */
    public function handle($request, Closure $next, $description = null)
    {
        ActivityLogComponent::handler($description);

        return $next($request);
    }
}
