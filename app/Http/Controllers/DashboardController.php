<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\Absensi;
use App\Models\Pengajuan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPegawai = Pegawai::count();

        $hadir = Absensi::where('status_absensi', 'hadir')
            ->whereDate('tanggal', today())
            ->count();

        $izin = Absensi::where('status_absensi', 'izin')
            ->whereDate('tanggal', today())
            ->count();

        $sakit = Absensi::where('status_absensi', 'sakit')
            ->whereDate('tanggal', today())
            ->count();

        $alpha = Absensi::where('status_absensi', 'alpha')
            ->whereDate('tanggal', today())
            ->count();

        $pending = Pengajuan::where(function ($q) {
            $q->where('status_spv', 'pending')
                ->orWhere('status_manager', 'pending')
                ->orWhere('status_hrd', 'pending');
        })->count();

        $role = session('role');

        if ($role == 'pegawai') {

            $pegawai = Pegawai::where('user_id', auth()->id())->first();

            $absensis = Absensi::with('pegawai')
                ->where('pegawai_id', $pegawai->id)
                ->whereDate('tanggal', today())
                ->get();
        } else {

            $absensis = Absensi::with('pegawai')
                ->whereDate('tanggal', today())
                ->get();
        }

        return view('dashboard.index', compact(
            'totalPegawai',
            'hadir',
            'izin',
            'sakit',
            'alpha',
            'pending',
            'absensis'
        ));
    }
}
