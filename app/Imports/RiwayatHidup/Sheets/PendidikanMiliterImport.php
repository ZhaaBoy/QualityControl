<?php

namespace App\Imports\RiwayatHidup\Sheets;

use App\Models\CiriFisik;
use App\Models\Keluarga;
use App\Models\PendidikanMiliter;
use App\Models\Saudara;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PendidikanMiliterImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        $dataPendidikanMiliter = new PendidikanMiliter();
        $dataPendidikanMiliter->nrp = $row['nrp'];
        $dataPendidikanMiliter->kategori = $row['kategori'];
        $dataPendidikanMiliter->jendik = $row['jendik'];
        $dataPendidikanMiliter->tahun = $row['tahun'];
        $dataPendidikanMiliter->tempat = $row['tempat'];
        $dataPendidikanMiliter->status = $row['status'];

        return null; 
    }
}
