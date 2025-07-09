<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use App\Models\Regency;
use App\Models\Village;
use App\Models\District;
use Illuminate\Database\Seeder;
use Database\Seeders\RegencySeeder;
use Database\Seeders\ProvinceSeeder;
use Illuminate\Support\Facades\File;
use Database\Seeders\RuangSidangSeeder;
use Database\Seeders\MasterMajelisSeeder;
use App\Models\Master\MasterJenisPemilihan;
use Database\Seeders\UserSeederTableSeeder;
use Database\Seeders\SettingSeederTableSeeder;
use Database\Seeders\PermissionManagementDatabaseSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call(UserSeederTableSeeder::class);
        $this->call(PermissionManagementDatabaseSeeder::class);
        $this->call(SettingSeederTableSeeder::class);
        $this->call(OfficeSeeder::class);
    }
}
