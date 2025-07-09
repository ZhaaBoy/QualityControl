<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class MenuController extends Controller
{
    public function getMenuItems()
    {
        $menus = Permission::orderBy('position', 'ASC')
            ->where('level', 1)
            ->get();

        $data = [];
        foreach ($menus as $menu) {
            $nama_menu = str_replace(' ', '', $menu->name);
            $submenus = Permission::orderBy('position', 'ASC')
                ->where('level', 2)
                ->where('group', $menu->group)
                ->get();

            $data[] = [
                'name' => $menu->name,
                'route' => $menu->route,
                'icon' => $menu->icon,
                'type' => $menu->type,
                'nama_menu' => $nama_menu,
                'submenus' => $submenus,
            ];
        }

        return response()->json($data);
    }
}
