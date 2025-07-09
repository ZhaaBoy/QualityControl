<?php

namespace App\Imports\RiwayatHidup\Sheets;

use App\Models\Rh;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class RHImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    
    public function model(array $row)
    {
        /*
        $existingRH = Rh::firstWhere('nrp', $row['nrp']);
        
        if ($existingRH) {
            Session::push('import_errors', "Data RH dengan NRP {$row['nrp']} sudah ada. Pada sheet data_rh");
            return null; 
        }

        $dataRH = new Rh();
        $dataRH->nama = $row['nama'];
        $dataRH->nrp = $row['nrp'];
        $dataRH->tmplahir = $row['tmplahir'];
        $dataRH->tgl = $row['tgl'];
        $dataRH->bln = $row['bln'];
        $dataRH->thn = $row['thn'];
        $dataRH->agama = $row['agama'];
        $dataRH->sb = $row['sb'];
        $dataRH->angk = $row['angk'];
        $dataRH->jk = $row['jk'];
        $dataRH->save();

        return null; 
        
        */

        $existingRH = Rh::where('nrp', $row['nrp'])
                        ->where('is_deleted', false)
                        ->first();
//    dd($existingRH);

        if ($existingRH) {
            Session::push('import_errors', "Data RH dengan NRP {$row['nrp']} sudah ada. Pada sheet data_rh");
            return null; 
        }

        return new Rh([
            'nama' => $row['nama'],
            'nrp' => $row['nrp'],
            'tmplahir' => $row['tmplahir'],
            'tgl' => $row['tgl'],
            'bln' => $row['bln'],
            'thn' => $row['thn'],
            'agama' => $row['agama'],
            'sb' => $row['sb'],
            'angk' => $row['angk'],
            'jk' => $row['jk'],
        ]);
    }
}
