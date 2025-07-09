<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class RegencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $response = Http::withOptions(['verify' => false])->get('https://api-e-database.kemendagri.go.id/api/data_master_kode_kabupaten_kota?token=51F890E2DF');
        $data = $response->json()['data'];
        foreach ($data as $item) {
            DB::table('regencies')->insert([
                'regency_name' => $item['nama_kabkota'],
                'no_province' => $item['kode_provinsi'],
                'no_regency' => $item['kode_kabkota'],
            ]);
        }
    }
}
