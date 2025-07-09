<?php

namespace App\Imports\RiwayatHidup\Sheets;

use App\Models\CiriFisik;
use App\Models\Keluarga;
use App\Models\PendidikanUmum;
use App\Models\Saudara;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PendidikanUmumImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        $dataPendidikanUmum = new PendidikanUmum();
        $dataPendidikanUmum->nrp = $row['nrp'];
        $dataPendidikanUmum->kategori = $row['kategori'];
        $dataPendidikanUmum->jendik = $row['jendik'];
        $dataPendidikanUmum->tahun = $row['tahun'];
        $dataPendidikanUmum->tempat = $row['tempat'];
        $dataPendidikanUmum->status = $row['status'];

        return null; 
    }
}
