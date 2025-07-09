<?php

namespace App\Imports\RiwayatHidup\Sheets;

use App\Models\Pelanggaran;
use App\Models\Prestasi;
use App\Models\TandaJasa;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PelanggaranImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        $dataPendidikanUmum = new Pelanggaran();
        $dataPendidikanUmum->nrp = $row['nrp'];
        $dataPendidikanUmum->no_skep = $row['no_skep'];
        $dataPendidikanUmum->nama = $row['nama'];
        $dataPendidikanUmum->hukuman = $row['hukuman'];
        $dataPendidikanUmum->sifat_tugas = $row['sifat_tugas'];
        return null; 

    }
}
