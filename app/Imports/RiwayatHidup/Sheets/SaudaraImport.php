<?php

namespace App\Imports\RiwayatHidup\Sheets;

use App\Models\CiriFisik;
use App\Models\Keluarga;
use App\Models\Saudara;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SaudaraImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        $dataSaudara = new Saudara();
        $dataSaudara->nrp = $row['nrp'];
        $dataSaudara->nama = $row['nama'];
        $dataSaudara->jk = $row['jk'];
        $dataSaudara->tmplahir = $row['tmplahir'];
        $dataSaudara->tgl = $row['tgl'];
        $dataSaudara->bln = $row['bln'];
        $dataSaudara->thn = $row['thn'];
        $dataSaudara->alamat = $row['alamat'];

        return null; 
    }
}
