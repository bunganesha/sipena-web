<?php

namespace App\Imports;

use App\Models\Absensi;
use App\Models\Pegawai;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class AbsensiImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        // Ambil NIP dari header
        $nipText = $rows[7][10] ?? null;

        preg_match('/\d+/', $nipText, $matches);

        $nip = $matches[0] ?? null;

        if (!$nip) {
            return;
        }

        $pegawai = Pegawai::where('nip', $nip)->first();

        if (!$pegawai) {
            return;
        }

        // Data absensi mulai setelah header
        foreach ($rows->slice(10) as $row) {

            if (!isset($row[0]) || !is_numeric($row[0])) {
                continue;
            }
            // if (!is_numeric($row[0])) {
            //     dump('SKIP', $row->toArray());
            //     continue;
            // }
            $tanggal = Date::excelToDateTimeObject($row[0])
                ->format('Y-m-d');

            $jamMasuk = !empty($row[2])
                ? Date::excelToDateTimeObject($row[2])->format('H:i:s')
                : null;

            $jamKeluar = !empty($row[4])
                ? Date::excelToDateTimeObject($row[4])->format('H:i:s')
                : null;

            $status = 'alpha';

            if (!empty($row[14])) {

                $ketidakhadiran = strtoupper(trim($row[14]));

                if ($ketidakhadiran == 'SAKIT') {
                    $status = 'sakit';
                } elseif ($ketidakhadiran == 'IZIN') {
                    $status = 'izin';
                }
            } elseif ($jamMasuk) {

                $status = 'hadir';
            }

            Absensi::updateOrCreate(
                [
                    'pegawai_id' => $pegawai->id,
                    'tanggal' => $tanggal,
                ],
                [
                    'jam_masuk' => $jamMasuk,
                    'jam_keluar' => $jamKeluar,
                    'status_absensi' => $status,
                    'keterangan' => 'Import FingerX',
                ]
            );
        }
    }
}
