<?php

namespace App\Imports\RiwayatHidup\Sheets;

use App\Models\PenguasaanBahasa;
use App\Models\Saudara;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PenguasaanBahasaImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        $dataSaudara = new PenguasaanBahasa();
        $dataSaudara->nrp = $row['nrp'];
        $dataSaudara->kategori = $row['kategori'];
        $dataSaudara->bahasa = $row['bahasa'];
        $dataSaudara->status = $row['status'];

        return null; 
    }
}
