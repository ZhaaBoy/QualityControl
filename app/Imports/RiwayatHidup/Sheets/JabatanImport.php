<?php

namespace App\Imports\RiwayatHidup\Sheets;

use App\Models\Jabatan;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class JabatanImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        $dataPendidikanUmum = new Jabatan();
        $dataPendidikanUmum->nrp = $row['nrp'];
        $dataPendidikanUmum->jabatan = $row['jabatan'];
        $dataPendidikanUmum->tahun = $row['tahun'];
        $dataPendidikanUmum->daerah = $row['daerah'];
        $dataPendidikanUmum->induk = $row['induk'];
        $dataPendidikanUmum->dks = $row['dks'];
        return null; 
    }
}
