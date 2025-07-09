<?php

namespace App\Imports\RiwayatHidup\Sheets;

use App\Models\Keluarga;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PasanganImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        $dataKeluarga = new Keluarga();
        $dataKeluarga->nrp = $row['nrp'];
        $dataKeluarga->hbg = $row['hbg'];
        $dataKeluarga->nama = $row['nama'];
        $dataKeluarga->tmplahir = $row['tmplahir'];
        $dataKeluarga->tgl = $row['tgl'];
        $dataKeluarga->bln = $row['bln'];
        $dataKeluarga->thn = $row['thn'];
        $dataKeluarga->pekerjaan = $row['pekerjaan'];
        $dataKeluarga->agama = $row['agama'];
        $dataKeluarga->sb = $row['sb'];
        $dataKeluarga->goldar = $row['goldar'];
        $dataKeluarga->alamat = $row['alamat'];
        $dataKeluarga->tgl_kawin = convertExcelDate($row['tgl_kawin']);
        $dataKeluarga->tmp_kawin = $row['tmp_kawin'];
        $dataKeluarga->no_srt_kawin = $row['no_srt_kawin'];

        $dataKeluarga->save();

        return null; 
    }
}
