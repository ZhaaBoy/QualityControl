<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeederTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Model::unguard();

        // BUAT ROLE
        $admin_qc = Role::create(['name' => 'admin_qc']);
        $pimpinan = Role::create(['name' => 'pimpinan']);
        $qc_inline = Role::create(['name' => 'qc_inline']);

        // BUAT PERMISSION
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        $data = [
            [
                'name' => 'create',
            ],
            [
                'name' => 'read',
            ],
            [
                'name' => 'update',
            ],
            [
                'name' => 'delete',
            ],
        ];

        foreach ($data as $item) {
            DB::table('hakakses')->insert($item);
        }

        // berikan "default" untuk route yang belum didaftarkan di web.php
        $permissi = [
            [
                'name' => 'Dashboard',
                'description' => 'Dashboard',
                'icon' => 'fa-solid fa-chart-line', // ikon statistik/dashboard
                'guard_name' => 'web',
                'type' => 'static',
                'level' => 1,
                'position' => 1,
                'route' => 'dashboard',
                'group' => 1
            ],
            [
                'name' => 'Master Produk',
                'description' => 'Master Produk',
                'icon' => 'fa-solid fa-boxes-stacked', // ikon produk
                'guard_name' => 'web',
                'type' => 'static',
                'level' => 1,
                'position' => 2,
                'route' => 'master_produk',
                'group' => 1
            ],
            [
                'name' => 'Data Hasil Produksi',
                'description' => 'Data Hasil Produk',
                'icon' => 'fa-solid fa-industry', // ikon pabrik/produksi
                'guard_name' => 'web',
                'type' => 'static',
                'level' => 1,
                'position' => 3,
                'route' => 'data_hasil_produksi',
                'group' => 1
            ],
            [
                'name' => 'Data Hasil QC',
                'description' => 'Data Hasil QC',
                'icon' => 'fa-solid fa-check-circle', // ikon QC/validasi
                'guard_name' => 'web',
                'type' => 'static',
                'level' => 1,
                'position' => 4,
                'route' => 'data_hasil_qc',
                'group' => 1
            ],
            [
                'name' => 'Laporan Hasil Produksi',
                'description' => 'Laporan Hasil Produk',
                'icon' => 'fa-solid fa-file-lines', // ikon laporan
                'guard_name' => 'web',
                'type' => 'static',
                'level' => 1,
                'position' => 5,
                'route' => 'laporan_hasil_produksi',
                'group' => 1
            ],
            [
                'name' => 'Kelola Permasalahan',
                'description' => 'Kelola Permasalahan',
                'icon' => 'fa-solid fa-triangle-exclamation', // ikon warning/permasalahan
                'guard_name' => 'web',
                'type' => 'static',
                'level' => 1,
                'position' => 6,
                'route' => 'kelola_permasalahan',
                'group' => 1
            ],
            [
                'name' => 'Settings',
                'description' => 'settings',
                'icon' => 'fa-solid fa-bars',
                'guard_name' => 'web',
                'type' => 'dropdown',
                'level' => 1,
                'position' => 100,
                'route' => 'settings',
                'group' => 100
            ],
            [
                'name' => 'User Management',
                'description' => 'User Management',
                'icon' => 'ri-file-user-line',
                'guard_name' => 'web',
                'type' => 'static',
                'level' => 2,
                'position' => 1,
                'route' => 'settings.user',
                'group' => 100
            ],
            [
                'name' => 'Role Management',
                'description' => 'Role Management',
                'icon' => 'ri-shield-user-line',
                'guard_name' => 'web',
                'type' => 'static',
                'level' => 2,
                'position' => 2,
                'route' => 'settings.role',
                'group' => 100
            ],
            [
                'name' => 'Menu Management',
                'description' => 'Menu Management',
                'icon' => 'ri-shield-star-line',
                'guard_name' => 'web',
                'type' => 'static',
                'level' => 2,
                'position' => 3,
                'route' => 'settings.permission',
                'group' => 100,
            ],
        ];

        // ASSIGN ROLE TO PERMISSION

        $permission = DB::table('permissions')->insert($permissi);
        $permissions = Permission::all();
        $hakaksesIds = DB::table('hakakses')->pluck('id');
        foreach ($permissions as $permission) {
            $admin_qc->givePermissionTo($permission->name);

            foreach ($hakaksesIds as $hakaksesId) {
                DB::table('hakakses_permission')->insert([
                    'permission_id' => $permission->id,
                    'hakakses_id' => $hakaksesId,
                    'role_id' => $admin_qc->id,
                ]);
            }
        }


        $qc_inline_permissions = [
            'Master Produk',
            'Settings',
            'User Management',
            'Role Management',
        ];
        $permissions_qc_inline = Permission::whereNotIn('name', $qc_inline_permissions)->get();
        foreach ($permissions_qc_inline as $permission_qc_inline) {
            $qc_inline->givePermissionTo($permission_qc_inline->name);

            foreach ($hakaksesIds as $hakaksesId) {
                DB::table('hakakses_permission')->insert([
                    'permission_id' => $permission_qc_inline->id,
                    'hakakses_id' => $hakaksesId,
                    'role_id' => $qc_inline->id,
                ]);
            }
        }

        
        $pimpinan_permissions = [
            'Master Produk',
            'Settings',
            'User Management',
            'Role Management',
        ];
        $pimpinanHakAkses = DB::table('hakakses')->where('name', 'read')->pluck('id');
        $permissions_pimpinan = Permission::whereNotIn('name', $pimpinan_permissions)->get();
        foreach ($permissions_pimpinan as $permission_pimpinan) {
            $pimpinan->givePermissionTo($permission_pimpinan->name);

            foreach ($pimpinanHakAkses as $hakaksesId) {
                DB::table('hakakses_permission')->insert([
                    'permission_id' => $permission_pimpinan->id,
                    'hakakses_id' => $hakaksesId,
                    'role_id' => $pimpinan->id,
                ]);
            }
        }

        $adminQCUser = User::firstWhere('email', 'admin_qc@gmail.com');
        $pimpinanUser = User::firstWhere('email', 'pimpinan@gmail.com');
        $qc_inlineUser = User::firstWhere('email', 'qc_inline@gmail.com');

        $adminQCUser->syncRoles([$admin_qc->id]);
        $pimpinanUser->syncRoles([$pimpinan->id]);
        $qc_inlineUser->syncRoles([$qc_inline->id]);
    }
}
