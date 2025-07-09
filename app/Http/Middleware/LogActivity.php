<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\LogUser;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class LogActivity
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        if (Auth::check() && $request->route()->getName()) {
            $log = [
                'user_id' => Auth::id(),
                'action' => $request->method(),
                'table_name' => $request->route()->parameter('table_name', 'unknown'),
                'record_id' => $request->route()->parameter('record_id', 0),
                'no_registrasi' => $request->input('no_registrasi'),
                'no_pengaduan' => $request->input('no_pengaduan'),
                'no_perkara' => $request->input('no_perkara'),
            ];

            LogUser::create($log);
        }

        return $response;
    }
}
