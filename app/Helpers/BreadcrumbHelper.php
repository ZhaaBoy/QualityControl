<?php

namespace App\Helpers;

use Spatie\Permission\Models\Permission;

class BreadcrumbHelper
{
    public static function getLevel($id, $level)
    {
        return $level = Permission::where('level', $level)->where('first_group', $id)->select('name', 'route', 'first_group')->first();
        
    }
}
