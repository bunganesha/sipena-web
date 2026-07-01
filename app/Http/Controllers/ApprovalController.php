<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use App\Models\Pegawai;
use App\Models\Absensi;
use App\Models\ApprovalLog;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ApprovalController extends Controller
{

    // ===================================================
    // LIST APPROVAL
    // ===================================================

    public function index(Request $request)
    {
        abort_if(
            !in_array(session('role'), ['spv', 'manager', 'hrd']),
            403
        );

        $role = session('role');
        $search = $request->search;

        $pengajuans = Pengajuan::with([
            'pegawai',
            'pegawai.user'
        ])
            ->when($search, function ($query) use ($search) {

                $query->where('jenis_pengajuan', 'like', "%{$search}%")
                    ->orWhereHas('pegawai', function ($q) use ($search) {

                        $q->where('nama', 'like', "%{$search}%")
                            ->orWhere('nip', 'like', "%{$search}%");
                    });
            })
            ->get()

            ->filter(function ($item) use ($role) {

                $pemohonRole = strtolower(
                    optional(optional($item->pegawai)->user)->role
                );

                // =============================
                // SPV
                // =============================
                if ($role == 'spv') {

                    return
                        $pemohonRole == 'pegawai'
                        &&
                        $item->status_spv == 'pending';
                }

                // =============================
                // MANAGER
                // =============================
                if ($role == 'manager') {

                    return (

                        (
                            $pemohonRole == 'pegawai'
                            &&
                            $item->status_spv == 'approved'
                            &&
                            $item->status_manager == 'pending'
                        )

                        ||

                        (
                            $pemohonRole == 'spv'
                            &&
                            $item->status_manager == 'pending'
                        )

                    );
                }

                // =============================
                // HRD
                // =============================
                if ($role == 'hrd') {

                    return (

                        (
                            $pemohonRole == 'pegawai'
                            &&
                            $item->status_spv == 'approved'
                            &&
                            $item->status_manager == 'approved'
                            &&
                            $item->status_hrd == 'pending'
                        )

                        ||

                        (
                            $pemohonRole == 'spv'
                            &&
                            $item->status_manager == 'approved'
                            &&
                            $item->status_hrd == 'pending'
                        )

                        ||

                        (
                            $pemohonRole == 'manager'
                            &&
                            $item->status_hrd == 'pending'
                        )

                        ||

                        (
                            $pemohonRole == 'hrd'
                            &&
                            $item->status_hrd == 'pending'
                        )

                    );
                } // <- ini yang sebelumnya hilang

                return false;
            })

            ->values();

        return view(
            'approval.index',
            compact('pengajuans')
        );
    }
    // ===================================================
    // ROLE PEMOHON
    // ===================================================

    private function getPemohonRole(Pengajuan $pengajuan)
    {
        return strtolower(
            optional(optional($pengajuan->pegawai)->user)->role
        );
    }

    // ===================================================
    // FINAL APPROVAL
    // ===================================================

    private function prosesFinalApproval(Pengajuan $pengajuan)
    {
        if (strtolower($pengajuan->jenis_pengajuan) == 'cuti') {

            $pegawai = $pengajuan->pegawai;

            $jumlahHari =

                Carbon::parse($pengajuan->tanggal_mulai)

                ->diffInDays(

                    Carbon::parse($pengajuan->tanggal_selesai)

                ) + 1;

            if ($pegawai) {

                if ($pegawai->sisa_cuti < $jumlahHari) {

                    throw new \Exception(
                        'Sisa cuti pegawai tidak mencukupi.'
                    );
                }

                $pegawai->decrement(
                    'sisa_cuti',
                    $jumlahHari
                );
            }
        }

        Absensi::firstOrCreate(

            [

                'pegawai_id' => $pengajuan->pegawai_id,

                'tanggal' => $pengajuan->tanggal_mulai,

            ],

            [

                'status_absensi' => $this->mapStatusAbsensi(
                    $pengajuan->jenis_pengajuan
                ),

                'keterangan' => $pengajuan->alasan

            ]

        );
    }

    public function update(Request $request, $id)
    {
        if (
            session('role') != 'spv' &&
            session('role') != 'manager' &&
            session('role') != 'hrd'
        ) {
            abort(403);
        }

        $request->validate([
            'status' => 'required|in:Approved,Rejected',
            'alasan' => 'nullable|string'
        ]);

        $pengajuan = Pengajuan::with('pegawai')->findOrFail($id);

        $role = session('role');
        $status = strtolower($request->status);

        $pemohonRole = $this->getPemohonRole($pengajuan);

        /*
    ======================================================
    CEK HAK APPROVAL
    ======================================================
    */

        if ($role == 'spv') {

            if (
                $pemohonRole != 'pegawai' ||
                $pengajuan->status_spv != 'pending'
            ) {
                return back()->with('error', 'Pengajuan ini tidak dapat diproses oleh SPV.');
            }
        } elseif ($role == 'manager') {

            if ($pemohonRole == 'pegawai') {

                if (
                    $pengajuan->status_spv != 'approved' ||
                    $pengajuan->status_manager != 'pending'
                ) {
                    return back()->with('error', 'Pengajuan belum dapat diproses Manager.');
                }
            } elseif ($pemohonRole == 'spv') {

                if ($pengajuan->status_manager != 'pending') {
                    return back()->with('error', 'Pengajuan sudah diproses.');
                }
            } else {

                return back()->with('error', 'Manager tidak dapat memproses pengajuan ini.');
            }
        } elseif ($role == 'hrd') {

            if ($pemohonRole == 'pegawai') {

                if (
                    $pengajuan->status_spv != 'approved' ||
                    $pengajuan->status_manager != 'approved' ||
                    $pengajuan->status_hrd != 'pending'
                ) {
                    return back()->with('error', 'Belum sampai tahap HRD.');
                }
            } elseif ($pemohonRole == 'spv') {

                if (
                    $pengajuan->status_manager != 'approved' ||
                    $pengajuan->status_hrd != 'pending'
                ) {
                    return back()->with('error', 'Belum sampai tahap HRD.');
                }
            } elseif (
                $pemohonRole == 'manager' ||
                $pemohonRole == 'hrd'
            ) {

                if ($pengajuan->status_hrd != 'pending') {

                    return back()->with('error', 'Pengajuan sudah diproses.');
                }
            }
        }

        /*
    ======================================================
    SIMPAN LOG
    ======================================================
    */

        ApprovalLog::create([
            'pengajuan_id' => $pengajuan->id,
            'role' => $role,
            'status' => $status,
            'alasan' => $request->alasan
        ]);

        /*
    ======================================================
    UPDATE STATUS
    ======================================================
    */

        if ($status == 'approved') {

            if ($role == 'spv') {

                $pengajuan->status_spv = 'approved';
            } elseif ($role == 'manager') {

                $pengajuan->status_manager = 'approved';
            } elseif ($role == 'hrd') {

                $pengajuan->status_hrd = 'approved';

                /*
            =====================================
            FINAL APPROVAL
            =====================================
            */

                if (strtolower($pengajuan->jenis_pengajuan) == 'cuti') {

                    $pegawai = $pengajuan->pegawai;

                    $jumlahHari =
                        Carbon::parse($pengajuan->tanggal_mulai)
                        ->diffInDays(Carbon::parse($pengajuan->tanggal_selesai))
                        + 1;

                    if ($pegawai->sisa_cuti < $jumlahHari) {

                        return back()->with(
                            'error',
                            'Sisa cuti pegawai tidak mencukupi.'
                        );
                    }

                    $pegawai->decrement(
                        'sisa_cuti',
                        $jumlahHari
                    );
                }

                Absensi::firstOrCreate(

                    [
                        'pegawai_id' => $pengajuan->pegawai_id,
                        'tanggal' => $pengajuan->tanggal_mulai
                    ],

                    [
                        'status_absensi' =>
                        $this->mapStatusAbsensi(
                            $pengajuan->jenis_pengajuan
                        ),

                        'keterangan' =>
                        $pengajuan->alasan
                    ]

                );
            }
        }

        /*
    ======================================================
    REJECT
    ======================================================
    */ else {

            if ($role == 'spv') {

                $pengajuan->status_spv = 'rejected';
            } elseif ($role == 'manager') {

                $pengajuan->status_manager = 'rejected';
            } elseif ($role == 'hrd') {

                $pengajuan->status_hrd = 'rejected';
            }
        }

        $pengajuan->save();

        return redirect()
            ->route('approval.index')
            ->with(
                'success',
                'Approval berhasil diproses.'
            );
    }
    // =========================
    // DETAIL APPROVAL
    // =========================
    public function detail($id)
    {
        $pengajuan = Pengajuan::with([
            'pegawai',
            'logs' => function ($query) {
                $query->latest();
            }
        ])->findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $pengajuan
        ]);
    }
    // =========================
    // MAPPING STATUS ABSENSI
    // =========================
    private function mapStatusAbsensi($jenis)
    {
        return match (strtolower($jenis)) {

            'cuti' => 'izin',

            'izin' => 'izin',

            'sakit' => 'sakit',

            default => 'izin',
        };
    }
    // =========================
    // CEK FINAL APPROVAL
    // =========================
    private function isFinalApproval($pemohonRole, $pengajuan)
    {
        $pemohonRole = strtolower($pemohonRole);

        return match ($pemohonRole) {

            'pegawai' =>
            $pengajuan->status_spv == 'approved'
                &&
                $pengajuan->status_manager == 'approved'
                &&
                $pengajuan->status_hrd == 'approved',

            'spv' =>
            $pengajuan->status_manager == 'approved'
                &&
                $pengajuan->status_hrd == 'approved',

            'manager' =>
            $pengajuan->status_hrd == 'approved',

            'hrd' =>
            $pengajuan->status_hrd == 'approved',

            default => false,
        };
    }
}
