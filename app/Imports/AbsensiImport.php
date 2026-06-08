<?php

namespace App\Imports;

use App\Models\Absensi;
use App\Models\Pegawai;
use Maatwebsite\Excel\Concerns\ToModel;

class AbsensiImport implements ToModel
{
    public function model(array $row)
    {
        $pegawai = Pegawai::where('nip', $row[0])->first();

        if (!$pegawai) {
            return null;
        }

        return new Absensi([
            'pegawai_id' => $pegawai->id,
            'tanggal' => $row[1],
            'jam_masuk' => $row[2],
            'jam_keluar' => $row[3],
            'status_absensi' => strtolower($row[4]),
            'keterangan' => $row[5] ?? null,
        ]);
    }
}