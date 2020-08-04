<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Components\ActivityLog\ActivityLogComponent;
use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

/**
 * Class ActivityLogMiddleware
 *
 * @description Обработка входящих запросов.
 */
class ActivityLogMiddleware extends Middleware
{
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
