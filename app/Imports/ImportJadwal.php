<?php

namespace App\Imports;

use App\Models\JadwalImport;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ImportJadwal implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Pastikan bahwa array $row memiliki indeks yang benar
        if (isset($row['nomor_perkara'], $row['teradu'], $row['majelis'], $row['jadwal'], $row['tempat'])) {
            return new JadwalImport([
                'nomor_perkara' => $row['nomor_perkara'],
                'teradu' => $row['teradu'],
                'majelis' => $row['majelis'],
                'jadwal' => $row['jadwal'],
                'tempat' => $row['tempat'],
            ]);
        }

        // Log error jika data tidak valid
        \Log::error('Invalid data row:', $row);
    }
}
