<?php

namespace App\Imports\RiwayatHidup\Sheets;

use App\Models\CiriFisik;
use App\Models\PengalamanKerja;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PengalamanKerjaImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        $dataPengalamanKerja = new PengalamanKerja();
        $dataPengalamanKerja->nrp = $row['nrp'];
        $dataPengalamanKerja->tahun = $row['tahun'];
        $dataPengalamanKerja->instansi = $row['instansi'];
        $dataPengalamanKerja->tempat = $row['tempat'];
        $dataPengalamanKerja->status = $row['status'];
        $dataPengalamanKerja->save();

        return null; 
    }
} 
