<?php

namespace App\Http\Middleware;

// use App\Models\Route;
use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Symfony\Component\HttpFoundation\Response;

class RouteMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $routes = Permission::firstWhere('route', $request->route()?->getName());

        return blank($routes) || $request->user()->can($routes->name)
            ? $next($request)
            : abort(403, 'Anda tidak memiliki izin');
    }
}
