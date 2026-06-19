<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use App\Models\Absensi;
use App\Models\ApprovalLog;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ApprovalController extends Controller
{
    // =========================
    // TAMPIL DATA APPROVAL
    // =========================
    public function index(Request $request)
    {
        if (
            session('role') != 'spv' &&
            session('role') != 'manager' &&
            session('role') != 'hrd'
        ) {
            abort(403);
        }

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
        if (
            session('role') != 'spv' &&
            session('role') != 'manager' &&
            session('role') != 'hrd'
        ) {
            abort(403);
        }

        $pengajuan = Pengajuan::findOrFail($id);
        $role = session('role');
        $status = strtolower($request->status); // approved / rejected

        // =========================
        // 1. SIMPAN LOG APPROVAL
        // =========================
        ApprovalLog::create([
            'pengajuan_id' => $pengajuan->id,
            'role' => $role,
            'status' => $status,
            'alasan' => $request->alasan,
        ]);

        // =========================
        // 2. UPDATE STATUS BERJENJANG
        // =========================
        if ($status == 'approved') {

            if ($role == 'spv') {
                $pengajuan->status_spv = 'approved';
            }

            elseif ($role == 'manager' && $pengajuan->status_spv == 'approved') {
                $pengajuan->status_manager = 'approved';
            }

            elseif ($role == 'hrd' && $pengajuan->status_manager == 'approved') {
                $pengajuan->status_hrd = 'approved';
                
                // =========================
                // FINAL APPROVAL LOGIC
                // =========================

                // Kurangi sisa cuti jika cuti
                if (strtolower($pengajuan->jenis_pengajuan) == 'cuti') {

                    $pegawai = $pengajuan->pegawai;

                    $jumlahHari = Carbon::parse($pengajuan->tanggal_mulai)
                        ->diffInDays(Carbon::parse($pengajuan->tanggal_selesai)) + 1;


                    if ($pegawai) {

                        if ($pegawai->sisa_cuti < $jumlahHari) {
                            return back()->with(
                                'error',
                                'Sisa cuti pegawai tidak mencukupi.'
                            );
                        }

                        $pegawai->decrement('sisa_cuti', $jumlahHari);

                        $pegawai->refresh();

                        

                        
                    }
                }

                // Tetap seperti semula
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

        } else {
            // REJECT FLOW
            if ($role == 'spv') {
                $pengajuan->status_spv = 'rejected';
            } elseif ($role == 'manager') {
                $pengajuan->status_manager = 'rejected';
            } elseif ($role == 'hrd') {
                $pengajuan->status_hrd = 'rejected';
            }
        }

        $pengajuan->save();

        return redirect('/approval')
            ->with('success', 'Status approval berhasil diupdate');
    }

    // =========================
    // DETAIL APPROVAL (BARU DARI INCOMING)
    // =========================
    public function detail($id)
    {
        $pengajuan = Pengajuan::with('logs', 'pegawai')->findOrFail($id);

        return response()->json([
            'data' => $pengajuan
        ]);
    }

    // =========================
    // MAPPING ABSENSI
    // =========================
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