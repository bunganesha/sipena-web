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
        $role = auth()->user()->role;
        $pegawai = auth()->user()->pegawai;

        // =========================
        // DATA HRD
        // =========================

        $totalPegawai = Pegawai::count();

        $hadir = Absensi::whereDate('tanggal', today())
            ->where('status_absensi', 'hadir')
            ->count();

        $izin = Absensi::whereDate('tanggal', today())
            ->where('status_absensi', 'izin')
            ->count();

        $sakit = Absensi::whereDate('tanggal', today())
            ->where('status_absensi', 'sakit')
            ->count();

        $cuti = Absensi::whereDate('tanggal', today())
            ->where('status_absensi', 'cuti')
            ->count();

        $alpha = Absensi::whereDate('tanggal', today())
            ->where('status_absensi', 'alpha')
            ->count();



        // =========================
        // HRD
        // =========================

        $pendingHrd = Pengajuan::where('status_spv', 'approved')
            ->where('status_manager', 'approved')
            ->where('status_hrd', 'pending')
            ->count();



        // =========================
        // SPV
        // =========================

        $pendingSpv = Pengajuan::where('status_spv', 'pending')->count();

        $approveSpv = Pengajuan::where('status_spv', 'approved')->count();

        $rejectSpv = Pengajuan::where('status_spv', 'rejected')->count();

        $pengajuanSpv = Pengajuan::with('pegawai')
            ->where('status_spv', 'pending')
            ->latest()
            ->take(10)
            ->get();



        // =========================
        // MANAGER
        // =========================

        $pendingManager = Pengajuan::where('status_spv', 'approved')
            ->where('status_manager', 'pending')
            ->count();

        $approveManager = Pengajuan::where('status_manager', 'approved')
            ->count();

        $rejectManager = Pengajuan::where('status_manager', 'rejected')
            ->count();

        $pengajuanManager = Pengajuan::with('pegawai')
            ->where('status_spv', 'approved')
            ->where('status_manager', 'pending')
            ->latest()
            ->take(10)
            ->get();



        // =========================
        // PEGAWAI
        // =========================

        $pengajuanSaya = 0;
        $sisaCuti = 0;
        $hadirSaya = 0;

        if ($pegawai) {

            $pengajuanSaya = Pengajuan::where(
                'pegawai_id',
                $pegawai->id
            )->count();

            $sisaCuti = $pegawai->sisa_cuti;

            $hadirSaya = Absensi::where(
                'pegawai_id',
                $pegawai->id
            )->where(
                'status_absensi',
                'hadir'
            )->count();
        }



        // =========================
        // TABEL
        // =========================

        if ($role == 'pegawai') {

            $absensis = Absensi::with('pegawai')
                ->where('pegawai_id', $pegawai->id)
                ->latest('tanggal')
                ->take(10)
                ->get();
        } else {

            $absensis = Absensi::with('pegawai')
                ->whereDate('tanggal', today())
                ->latest()
                ->get();
        }



        return view('dashboard.index', compact(

            'role',
            'pegawai',

            'totalPegawai',
            'hadir',
            'izin',
            'sakit',
            'cuti',
            'alpha',

            'pendingHrd',

            'pendingSpv',
            'approveSpv',
            'rejectSpv',
            'pengajuanSpv',

            'pendingManager',
            'approveManager',
            'rejectManager',
            'pengajuanManager',

            'pengajuanSaya',
            'sisaCuti',
            'hadirSaya',

            'absensis'
        ));
    }
}
