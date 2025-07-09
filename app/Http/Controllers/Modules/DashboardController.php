<?php

namespace App\Http\Controllers\Modules;

use App\Http\Controllers\Controller;
use App\Models\DataHasilProduksi;
use App\Models\DataHasilQc;
use App\Models\KelolaPermasalahan;
use App\Models\LaporanHasilProduksi;
use Auth;


class DashboardController extends Controller
{
    public function index()
    {
        $role = Auth::user()->getRoleNames()[0];
        if($role == "admin_qc") {
            $master_produk = DataHasilProduksi::count();
        } else {
            $master_produk = 'nothing';
        }

        return view('modules.dashboard.index', [
            'data_hasil_produksi' => DataHasilProduksi::count(),
            'data_hasil_qc' => DataHasilQc::count(),
            'laporan_hasil_produksi' => LaporanHasilProduksi::count(),
            'kelola_permasalahan' => KelolaPermasalahan::count(),
            'master_produk' => $master_produk,
        ]);
    }
}