<?php

namespace App\Imports\RiwayatHidup\Sheets;

use App\Models\CiriFisik;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CiriFisikImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        
        $existingRH = CiriFisik::firstWhere('nrp', $row['nrp']);
        
        if ($existingRH) {
            Session::push('import_errors', "Ciri fisik dengan NRP {$row['nrp']} sudah ada. Pada sheet data_fisik");
            return null; 
        }
        
        $dataFisik = new CiriFisik();
        $dataFisik->nrp = $row['nrp'];
        $dataFisik->tb = $row['tb'];
        $dataFisik->bb = $row['bb'];
        $dataFisik->rambut = $row['rambut'];
        $dataFisik->warna_kulit = $row['warna_kulit'];
        $dataFisik->goldar = $row['goldar'];
        $dataFisik->tanda_khusus = $row['tanda_khusus'];
        $dataFisik->tgl_periksa = convertExcelDate($row['tgl_periksa']);
        $dataFisik->save();
 
        
        return null; 
    }
} 
