<?php

namespace App\Imports\RiwayatHidup\Sheets;

use App\Models\Prestasi;
use App\Models\TandaJasa;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class TandaJasaImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        $dataPendidikanUmum = new TandaJasa();
        $dataPendidikanUmum->nrp = $row['nrp'];
        $dataPendidikanUmum->nama = $row['nama'];
        $dataPendidikanUmum->tugas = $row['tugas'];
        $dataPendidikanUmum->tahun = $row['tahun'];
        return null; 
    }
}
