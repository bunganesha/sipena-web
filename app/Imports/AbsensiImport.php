<?php

namespace App\Imports;

use App\Models\Absensi;
use App\Models\Pegawai;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class AbsensiImport implements ToCollection
{
    private $pegawaiId;
    public function __construct($pegawaiId)
    {
        $this->pegawaiId = $pegawaiId;
    }

    public function collection(Collection $rows)
    {
        // =========================
        // VALIDASI NIP FILE
        // =========================

        $nipText = $rows[7][10] ?? null;

        preg_match('/\d+/', $nipText, $matches);

        $nipFile = $matches[0] ?? null;

        $pegawai = Pegawai::find($this->pegawaiId);

        if (!$pegawai) {
            throw new \Exception('Pegawai tidak ditemukan.');
        }

        if ($pegawai->nip != $nipFile) {
            throw new \Exception(
                'File fingerprint tidak sesuai dengan pegawai yang dipilih.'
            );
        }
        // =========================
        // CUTI BERSAMA PT DTI 2026
        // =========================
        $cutiBersama = [
            '2026-03-19',
            '2026-03-20',
            '2026-03-23',
            '2026-03-24',
            '2026-06-15',
            '2026-08-24',
        ];

        foreach ($rows->slice(10) as $row) {

            if (!isset($row[0]) || !is_numeric($row[0])) {
                continue;
            }

            $tanggal = Date::excelToDateTimeObject($row[0])
                ->format('Y-m-d');

            $carbonTanggal = \Carbon\Carbon::parse($tanggal);

            // =========================
            // SKIP SABTU & MINGGU
            // =========================
            if ($carbonTanggal->isWeekend()) {
                continue;
            }

            // =========================
            // SKIP CUTI BERSAMA
            // =========================
            if (in_array($tanggal, $cutiBersama)) {
                continue;
            }

            $jamMasuk = !empty($row[2])
                ? Date::excelToDateTimeObject($row[2])->format('H:i:s')
                : null;

            $jamKeluar = !empty($row[4])
                ? Date::excelToDateTimeObject($row[4])->format('H:i:s')
                : null;

            $status = 'alpha';

            if (!empty($row[14])) {

                $ket = strtoupper(trim($row[14]));

                if ($ket == 'SAKIT') {
                    $status = 'sakit';
                } elseif ($ket == 'IZIN') {
                    $status = 'izin';
                }
            } elseif ($jamMasuk) {

                $status = 'hadir';
            }

            // =========================
            // CEK DATA LAMA
            // =========================
            $absensi = Absensi::where('pegawai_id', $this->pegawaiId)
                ->where('tanggal', $tanggal)
                ->first();

            // =========================
            // SUDAH ADA IZIN / SAKIT
            // DARI SIPENA
            // =========================
            if ($absensi) {

                if (
                    in_array(
                        $absensi->status_absensi,
                        ['izin', 'sakit', 'cuti']
                    )
                ) {
                    continue;
                }

                $absensi->update([
                    'jam_masuk' => $jamMasuk,
                    'jam_keluar' => $jamKeluar,
                    'status_absensi' => $status,
                    'keterangan' => 'Import FingerX',
                ]);
            } else {

                Absensi::create([

                    'pegawai_id' => $this->pegawaiId,
                    'tanggal' => $tanggal,
                    'jam_masuk' => $jamMasuk,
                    'jam_keluar' => $jamKeluar,
                    'status_absensi' => $status,
                    'keterangan' => 'Import FingerX',

                ]);
            }
        }
    }
}
