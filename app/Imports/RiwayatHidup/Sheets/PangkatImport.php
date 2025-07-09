<?php

namespace App\Imports\RiwayatHidup\Sheets;

use App\Models\CiriFisik;
use App\Models\Keluarga;
use App\Models\KursusLn;
use App\Models\Pangkat;
use App\Models\PendidikanIntel;
use App\Models\PendidikanUmum;
use App\Models\Saudara;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PangkatImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        $dataPendidikanUmum = new Pangkat();
        $dataPendidikanUmum->nrp = $row['nrp'];
        $dataPendidikanUmum->m_pangkat_id = $row['m_pangkat_id'];
        $dataPendidikanUmum->tmt = $row['tmt'];
        $dataPendidikanUmum->dks = $row['dks'];

        return null; 
    }
}
