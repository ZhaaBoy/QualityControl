<?php

namespace App\Imports\RiwayatHidup\Sheets;

use App\Models\Prestasi;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PrestasiImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        $dataPendidikanUmum = new Prestasi();
        $dataPendidikanUmum->nrp = $row['nrp'];
        $dataPendidikanUmum->nama = $row['nama'];
        $dataPendidikanUmum->tahun = $row['tahun'];
        $dataPendidikanUmum->penghargaan = $row['penghargaan'];
        return null; 
    }
}
