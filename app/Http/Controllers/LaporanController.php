<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pegawai;
use App\Models\Absensi;
use App\Exports\LaporanExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;


class LaporanController extends Controller
{
    // =========================
    // HALAMAN LAPORAN
    // =========================
    public function index(Request $request)
    {
        // SEARCH
        $search = $request->search;

        // FILTER DIVISI
        $divisi = $request->divisi;

        // FILTER STATUS
        $status = $request->status;

        // QUERY
        $pegawais = Pegawai::with('absensis')

            // SEARCH
            ->when($search, function ($query) use ($search) {

                $query->where('nama', 'like', "%{$search}%")
                    ->orWhere('nip', 'like', "%{$search}%");

            })

            // FILTER DIVISI
            ->when($divisi && $divisi != 'Semua Divisi',
                function ($query) use ($divisi) {

                    $query->where('divisi', $divisi);

                })

            ->get();

        // FILTER STATUS
        if ($status && $status != 'Semua Status') {

            $pegawais = $pegawais->filter(function ($pegawai)
                use ($status) {

                return $pegawai->absensis
                    ->where('status_absensi',
                        strtolower($status))
                    ->count() > 0;
            });
        }

        // STATISTIK
        $hadir = Absensi::where(
            'status_absensi',
            'hadir'
        )->count();

        $izin = Absensi::where(
            'status_absensi',
            'izin'
        )->count();

        $sakit = Absensi::where(
            'status_absensi',
            'sakit'
        )->count();

        $cuti = Absensi::where(
            'status_absensi',
            'cuti'
        )->count();

        $alpha = Absensi::where(
            'status_absensi',
            'alpha'
        )->count();

        return view('laporan.index', compact(
            'pegawais',
            'hadir',
            'izin',
            'sakit',
            'cuti',
            'alpha'
        ));
    }


    // =========================
    // EXPORT EXCEL
    // =========================
    public function export()
    {
        return Excel::download(
            new LaporanExport,
            'laporan-absensi.xlsx'
        );
    }


    // =========================
    // EXPORT PDF
    // =========================
    public function exportPdf()
{
    $laporan = Absensi::all();

    $pdf = Pdf::loadView('laporan.pdf', compact('laporan'));

    return $pdf->download('laporan-absensi.pdf');
}
}