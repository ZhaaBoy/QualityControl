<?php

namespace App\Imports\RiwayatHidup\Sheets;

use App\Models\CiriFisik;
use App\Models\Keluarga;
use App\Models\PendidikanIntel;
use App\Models\PendidikanUmum;
use App\Models\Saudara;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PendidikanIntelImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        $dataPendidikanUmum = new PendidikanIntel();
        $dataPendidikanUmum->nrp = $row['nrp'];
        $dataPendidikanUmum->jendik = $row['jendik'];
        $dataPendidikanUmum->tahun = $row['tahun'];
        $dataPendidikanUmum->tempat = $row['tempat'];

        return null; 
    }
}
