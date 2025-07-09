<?php

namespace App\Imports\RiwayatHidup\Sheets;

use App\Models\CiriFisik;
use App\Models\Keluarga;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AnakImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        $dataAnak = new Keluarga();
        $dataAnak->nrp = $row['nrp'];
        $dataAnak->hbg = $row['hbg'];
        $dataAnak->nama = $row['nama'];
        $dataAnak->tmplahir = $row['tmplahir'];
        $dataAnak->tgl = $row['tgl'];
        $dataAnak->bln = $row['bln'];
        $dataAnak->thn = $row['thn'];
        $dataAnak->jk = $row['jk'];

        $dataAnak->save();

        return null; 
    }
}
