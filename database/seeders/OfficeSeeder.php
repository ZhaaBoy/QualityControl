<?php

namespace Database\Seeders;

use App\Models\MasterProduk;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class OfficeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        MasterProduk::create([
            'customer' => 'Sofyan',
            'kode_barang' => 'TE32S',
            'nama_produk' => 'Test',
            'bahan' => 'Cotton',
            'tebal_bahan' => '2',
            'gramature_min' => 33,
            'dimensi_panjang' => 32,
        ]);
    }
}
