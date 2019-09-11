<?php
declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Access\HandlesAuthorization;

class CheckRole
{
    use HandlesAuthorization;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  mixed  ...$role
     * @return mixed
     */
    public function handle(
        $request,
        Closure $next,
        ...$role
    ) {
        if (!$request->user()) {
            throw new AuthenticationException;
        }

        abort_if(!$request->user()->hasRole($role), 403);

        return $next($request);
    }
}
