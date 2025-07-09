<?php

namespace App\Imports\RiwayatHidup;

use App\Imports\RiwayatHidup\Sheets\AnakImport;
use App\Imports\RiwayatHidup\Sheets\CiriFisikImport;
use App\Imports\RiwayatHidup\Sheets\JabatanImport;
use App\Imports\RiwayatHidup\Sheets\KegemaranImport;
use App\Imports\RiwayatHidup\Sheets\KursusLNImport;
use App\Imports\RiwayatHidup\Sheets\OrangTuaImport;
use App\Imports\RiwayatHidup\Sheets\PangkatImport;
use App\Imports\RiwayatHidup\Sheets\PasanganImport;
use App\Imports\RiwayatHidup\Sheets\PelanggaranImport;
use App\Imports\RiwayatHidup\Sheets\PendidikanIntelImport;
use App\Imports\RiwayatHidup\Sheets\PendidikanMiliterImport;
use App\Imports\RiwayatHidup\Sheets\PendidikanUmumImport;
use App\Imports\RiwayatHidup\Sheets\PengalamanKerjaImport;
use App\Imports\RiwayatHidup\Sheets\PenguasaanBahasaImport;
use App\Imports\RiwayatHidup\Sheets\PrestasiImport;
use App\Imports\RiwayatHidup\Sheets\RHImport;
use App\Imports\RiwayatHidup\Sheets\SaudaraImport;
use App\Imports\RiwayatHidup\Sheets\TandaJasaImport;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class RiwayatHidupImport implements WithMultipleSheets
{
    public function sheets(): array
    {
        return [ 
            'data_rh' => new RHImport(),      
            'data_fisik' => new CiriFisikImport(),      
            'orangtua_wali' => new OrangTuaImport(),      
            'pasangan' => new PasanganImport(),      
            'anak' => new AnakImport(),      
            'saudara' => new SaudaraImport(),      
            'pengalaman_kerja' => new PengalamanKerjaImport(),      
            'kegemaran' => new KegemaranImport(),      
            'penguasaan_bhs' => new PenguasaanBahasaImport(),      
            'pendidikan_umum' => new PendidikanUmumImport(),      
            'pendidikan_militer' => new PendidikanMiliterImport(),      
            'pendidikan_intel' => new PendidikanIntelImport(),      
            'kursus_ln' => new KursusLNImport(),      
            'pangkat' => new PangkatImport(),      
            'jabatan' => new JabatanImport(),      
            'prestasi' => new PrestasiImport(),      
            'tdn_jasa' => new TandaJasaImport(),      
            'pelanggaran' => new PelanggaranImport(),      
        ];
    }
}
