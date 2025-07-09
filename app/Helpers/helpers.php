<?php

use PhpOffice\PhpSpreadsheet\Shared\Date;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

if (!function_exists('can')) {
    function can($permissionName, $hakaksesName){
        $user = Auth::user();
        $roleUser = DB::table('role_has_user')->where('user_id', $user->id)->first();
        $roleId = $roleUser->role_id;
        $aksesAllowed = auth()->user()->can($permissionName);
        $results = DB::table('hakakses_permission')
            ->join('permissions', 'hakakses_permission.permission_id', '=', 'permissions.id')
            ->join('hakakses', 'hakakses_permission.hakakses_id', '=', 'hakakses.id')
            ->select('permissions.name as permission_name', 'hakakses.name as hakakses_name')
            ->where('permissions.name', $aksesAllowed ? $permissionName : '')
            ->where('hakakses_permission.role_id', $roleId)
            ->get();
        if ($aksesAllowed && $results->contains('hakakses_name', $hakaksesName)) {
            return true;
        }
        return false;
    }
}

if (!function_exists('convertExcelDate')) {

    function convertExcelDate($dateValue)
    {
        if (is_numeric($dateValue)) {
            return Carbon::instance(Date::excelToDateTimeObject($dateValue))->format('Y-m-d');
        }

        if (strtotime($dateValue)) {
            return Carbon::parse($dateValue)->format('Y-m-d');
        }

        return null;
    }
}
