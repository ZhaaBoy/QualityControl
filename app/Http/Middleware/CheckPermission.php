<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckPermission
{
    public function handle(Request $request, Closure $next, $permission, $access)
    {
        $user = auth()->user();
        $roleUser = DB::table('role_has_user')->where('user_id', $user->id)->first();
        $roleId = $roleUser->role_id;
        $aksesAllowed = $user->can($permission);
        
        $results = DB::table('hakakses_permission')
            ->join('permissions', 'hakakses_permission.permission_id', '=', 'permissions.id')
            ->join('hakakses', 'hakakses_permission.hakakses_id', '=', 'hakakses.id')
            ->select('permissions.name as permission_name', 'hakakses.name as hakakses_name')
            ->where('permissions.name', $aksesAllowed ? $permission : '')
            ->where('hakakses_permission.role_id', $roleId)
            ->get();
        
        if ($aksesAllowed && $results->contains('hakakses_name', $access)) {
            return $next($request);

        }
        abort(403, 'Anda tidak memiliki izin untuk mengakses halaman ini.');
    }
}
