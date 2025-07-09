<?php

namespace App\Imports\RiwayatHidup\Sheets;

use App\Models\Kegemaran;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class KegemaranImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        $dataKegemaran = new Kegemaran();
        $dataKegemaran->nrp = $row['nrp'];
        $dataKegemaran->kegemaran = $row['kegemaran'];
        $dataKegemaran->save();

        return null; 
    }
} 
