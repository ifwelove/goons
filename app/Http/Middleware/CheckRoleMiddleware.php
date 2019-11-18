<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;

class CheckRoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
//        dd(Auth::user());
        if (! Auth::user()->getRoleNames()->contains($role)) {
            abort('401');
        }

        return $next($request);
    }
}
