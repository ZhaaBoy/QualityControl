<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class RedirectIfHasPencarian
{
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $route_get = User::GetFirstRoute()->first();

        if (!$route_get) {
            abort(404, 'Route not found');
        }

        $guards = empty($guards) ? [null] : $guards;
        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                $user = Auth::guard($guard)->user();

                if (!$user->privilage('Pencarian', 'read')) {
                    return redirect()->route($route_get->route);
                }

                return $next($request);
            }
        }

        return redirect()->route($route_get->route);
    }
}