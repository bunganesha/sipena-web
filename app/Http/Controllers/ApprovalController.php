<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use App\Models\Absensi;
use Illuminate\Http\Request;

class ApprovalController extends Controller
{
    // =========================
    // TAMPIL DATA APPROVAL
    // =========================
    public function index(Request $request)
    {
        // ROLE PERMISSION
        if (
            session('role') != 'spv' &&
            session('role') != 'manager' &&
            session('role') != 'hrd'
        ) {
            abort(403);
        }

        // SEARCH
        $search = $request->search;

        $pengajuans = Pengajuan::with('pegawai')
            ->when($search, function ($query) use ($search) {

                $query->where('jenis_pengajuan', 'like', "%{$search}%")
                    ->orWhereHas('pegawai', function ($q) use ($search) {

                    $q->where('nama', 'like', "%$search%")
                        ->orWhere('nip', 'like', "%$search%");
                });
            })
            ->latest()
            ->get();

        return view('approval.index', compact('pengajuans'));
    }


    // =========================
    // UPDATE STATUS APPROVAL
    // =========================
    public function update(Request $request, $id)
    {
        // ROLE PERMISSION
        if (
            session('role') != 'spv' &&
            session('role') != 'manager' &&
            session('role') != 'hrd'
        ) {
            abort(403);
        }

        $pengajuan = Pengajuan::findOrFail($id);

        $role = session('role');

        // =========================
        // APPROVE
        // =========================
        if ($request->status == 'Approved') {

            // SPV
            if ($role == 'spv') {

                $pengajuan->status_spv = 'approved';
            } elseif ($role == 'manager') {

                if ($pengajuan->status_spv == 'approved') {

                    $pengajuan->status_manager = 'approved';

                }
            } elseif ($role == 'hrd') {

                if (
                    $pengajuan->status_spv == 'approved' &&
                    $pengajuan->status_manager == 'approved'
                ) {

                    $pengajuan->status_hrd = 'approved';

                    // ABSENSI MASUK SETELAH SEMUA APPROVE
                    Absensi::firstOrCreate(
                        [
                            'pegawai_id' => $pengajuan->pegawai_id,
                            'tanggal' => $pengajuan->tanggal_mulai,
                        ],
                        [
                            'status_absensi' => $this->mapStatusAbsensi($pengajuan->jenis_pengajuan),
                            'keterangan' => $pengajuan->alasan,
                        ]
                    );
                }

            }
        } else {

            if ($role == 'spv') {

                $pengajuan->status_spv = 'rejected';
            } elseif ($role == 'manager') {

                $pengajuan->status_manager = 'rejected';
            } elseif ($role == 'hrd') {

                $pengajuan->status_hrd = 'rejected';
            }

        }

        // =========================
        // SIMPAN
        // =========================
        $pengajuan->save();

        return redirect('/approval')
            ->with('success', 'Status approval berhasil diupdate');
    }
    private function mapStatusAbsensi($jenis)
    {
        $jenis = strtolower($jenis);

        return match ($jenis) {
            'cuti' => 'izin',
            'izin' => 'izin',
            'sakit' => 'sakit',
            default => 'izin',
        };
    }
}
