<?php

namespace App\Imports;

use App\Models\Modules\Master\MasterSeleksi;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsersImport implements ToModel, WithHeadingRow
{  
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        \dd($row);
        $dataRH = new MasterSeleksi();
        $dataRH->seleksi = $row['seleksi'];
        $dataRH->save();
    }
}
