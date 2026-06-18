<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use App\Models\Pegawai;
use Illuminate\Http\Request;

class PengajuanController extends Controller
{
    // =========================
    // TAMPIL DATA PENGAJUAN
    // =========================
    public function index(Request $request)
    {
        // ROLE PERMISSION
        if (
            session('role') != 'pegawai' &&
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

                    $q->where('nama', 'like', "%{$search}%")
                        ->orWhere('nip', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->get();

        $pegawais = Pegawai::all();

        $pegawais = Pegawai::all();

        return view('pengajuan.index', compact('pengajuans', 'pegawais'));
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
            'pegawai_id' => 'required',
            'jenis_pengajuan' => 'required',
            'tanggal_mulai' => 'required',
            'tanggal_selesai' => 'required',
            'alasan' => 'required',
        ]);

        Pengajuan::create([
            'pegawai_id' => $request->pegawai_id,
            'jenis_pengajuan' => strtolower($request->jenis_pengajuan),
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'alasan' => $request->alasan,
            'status_spv' => 'process',
            'status_manager' => 'process',
            'status_hrd' => 'process',
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

        $pengajuan->update([
            'pegawai_id' => $request->pegawai_id,
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