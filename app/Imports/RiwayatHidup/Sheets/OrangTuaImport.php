<?php

namespace App\Imports\RiwayatHidup\Sheets;

use App\Models\OrangTua;
use App\Models\Rh;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class OrangTuaImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        if (!is_numeric($row['umur'])) {
            Session::push('import_errors', "Umur harus berupa angka. Kesalahan pada sheet: orangtua_wali {$row['umur']}");
            return null; 
        }

        $orangTua = new OrangTua();
        $orangTua->nrp = $row['nrp'];
        $orangTua->nama = $row['nama'];
        $orangTua->umur = $row['umur'];
        $orangTua->tmplahir = $row['tmplahir'];
        $orangTua->tgl = $row['tgl'];
        $orangTua->bln = $row['bln'];
        $orangTua->thn = $row['thn'];
        $orangTua->agama = $row['agama'];
        $orangTua->sb = $row['sb'];
        $orangTua->pekerjaan = $row['pekerjaan'];
        $orangTua->alamat = $row['alamat'];
        $orangTua->kondisi = $row['kondisi'];
        $orangTua->hbg = $row['hbg'];
        $orangTua->save();

        return null;
    }
}
