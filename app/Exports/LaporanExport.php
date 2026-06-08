<?php

namespace App\Exports;

use App\Models\Absensi;
use Maatwebsite\Excel\Concerns\FromCollection;

class LaporanExport implements FromCollection
{
    public function collection()
    {
        return Absensi::with('pegawai')->get();
    }
}