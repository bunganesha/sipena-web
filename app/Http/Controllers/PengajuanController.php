<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PengajuanController extends Controller
{
    public function index(Request $request)
    {   
        if (
            session('role') != 'pegawai' &&
            session('role') != 'hrd'
        ) {
            abort(403);
        }

        $search = $request->search;

        $pengajuans = Pengajuan::with('pegawai')
            ->when($search, function ($query) use ($search) {
                $query->where('jenis_pengajuan', 'like', "%{$search}%")
                    ->orWhereHas('pegawai', function ($q) use ($search) {
                        $q->where('nama', 'like', "%{$search}%")
                        ->orWhere('nip', 'like', "%{$search}%");
                    });
            })
            ->latest()
            ->get();

        $pegawais = Pegawai::all();

        return view('pengajuan.index', compact(
            'pengajuans',
            'pegawais'
        ));
    }
    public function create()
    {
        $pegawais = Pegawai::all(); // INI YANG KAMU LUPA

        return view('pengajuan.create', compact('pegawais'));
    }


    // =========================
    // SIMPAN DATA
    // =========================
    public function store(Request $request)
    {
        if (
            session('role') != 'pegawai' &&
            session('role') != 'hrd'
        ) {
            abort(403);
        }

        $request->validate([
            'jenis_pengajuan' => 'required',
            'tanggal_mulai' => 'required',
            'tanggal_selesai' => 'required',
            'alasan' => 'required',
        ]);
        $user = auth()->user();

        $pegawai = Pegawai::where('id_user', $user->id)->first();

        if (!$pegawai) {
            return back()->with('error', 'Data pegawai tidak ditemukan.');
        }

        // Hitung jumlah hari cuti
        $jumlahHari = Carbon::parse($request->tanggal_mulai)
            ->diffInDays(Carbon::parse($request->tanggal_selesai)) + 1;

        // Cek sisa cuti
        if (
            strtolower($request->jenis_pengajuan) == 'cuti' &&
            $jumlahHari > $pegawai->sisa_cuti
        ) {
            return back()->with(
                'error',
                'Sisa cuti tidak mencukupi.'
            );
        }
        Pengajuan::create([
            'pegawai_id' => $pegawai->id,
            'jenis_pengajuan' => $request->jenis_pengajuan,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'alasan' => $request->alasan,
        ]);

        return redirect()
            ->route('pengajuan.index')
            ->with('success', 'Pengajuan berhasil ditambahkan');
    }


    // =========================
    // UPDATE DATA
    // =========================
    public function update(Request $request, $id)
    {
        if (
            session('role') != 'pegawai' &&
            session('role') != 'hrd'
        ) {
            abort(403);
        }

        $pengajuan = Pengajuan::findOrFail($id);

        if (
            $pengajuan->status_spv != 'pending' ||
            $pengajuan->status_manager != 'pending' ||
            $pengajuan->status_hrd != 'pending'
        ) {
            return back()->with(
                'error',
                'Pengajuan yang sudah diproses tidak bisa diedit'
            );
        }

        $user = auth()->user();
        $pegawai = Pegawai::where('id_user', $user->id)->first();

        $pengajuan->update([
            'pegawai_id' => $pegawai->id,
            'jenis_pengajuan' => strtolower($request->jenis_pengajuan),
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'alasan' => $request->alasan,
        ]);

        return redirect()
            ->route('pengajuan.index')
            ->with('success', 'Pengajuan berhasil diupdate');
    }


    // =========================
    // HAPUS DATA
    // =========================
    public function destroy($id)
    {
        if (
            session('role') != 'pegawai' &&
            session('role') != 'hrd'
        ) {
            abort(403);
        }

        Pengajuan::findOrFail($id)->delete();

        return redirect()
            ->route('pengajuan.index')
            ->with('success', 'Pengajuan berhasil dihapus');
    }
}