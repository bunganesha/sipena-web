<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PengajuanController extends Controller
{
    // =========================
    // TAMPIL DATA PENGAJUAN
    // =========================
    public function index(Request $request)
    {
        if (!in_array(session('role'), ['pegawai', 'spv', 'manager', 'hrd'])) {
            abort(403);
        }

        $pegawai = Pegawai::where('user_id', auth()->id())->firstOrFail();

        $search = $request->search;

        $pengajuans = Pengajuan::with('pegawai')
            ->where('pegawai_id', $pegawai->id)
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('jenis_pengajuan', 'like', "%{$search}%")
                        ->orWhere('alasan', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->get();

        return view('pengajuan.index', compact('pengajuans'));
    }

    // =========================
    // FORM CREATE
    // =========================
    public function create()
    {
        if (!in_array(session('role'), ['pegawai', 'spv', 'manager', 'hrd'])) {
            abort(403);
        }

        $pegawai = Pegawai::where('user_id', auth()->id())->firstOrFail();

        return view('pengajuan.create', compact('pegawai'));
    }

    // =========================
    // SIMPAN DATA
    // =========================
    public function store(Request $request)
    {
        if (!in_array(session('role'), ['pegawai', 'spv', 'manager', 'hrd'])) {
            abort(403);
        }

        $request->validate([
            'jenis_pengajuan' => 'required|in:cuti,izin,sakit',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'alasan' => 'required|string|max:1000',
        ]);

        $pegawai = Pegawai::where('user_id', auth()->id())->firstOrFail();

        $jumlahHari = Carbon::parse($request->tanggal_mulai)
            ->diffInDays(Carbon::parse($request->tanggal_selesai)) + 1;

        if (
            strtolower($request->jenis_pengajuan) == 'cuti' &&
            $jumlahHari > $pegawai->sisa_cuti
        ) {
            return back()
                ->withInput()
                ->with('error', 'Sisa cuti Anda tidak mencukupi.');
        }

        Pengajuan::create([
            'pegawai_id'       => $pegawai->id,
            'jenis_pengajuan'  => strtolower($request->jenis_pengajuan),
            'tanggal_mulai'    => $request->tanggal_mulai,
            'tanggal_selesai'  => $request->tanggal_selesai,
            'alasan'           => $request->alasan,
        ]);

        return redirect()
            ->route('pengajuan.index')
            ->with('success', 'Pengajuan berhasil dikirim.');
    }

    // =========================
    // UPDATE DATA
    // =========================
    public function update(Request $request, $id)
    {
        if (!in_array(session('role'), ['pegawai', 'spv', 'manager', 'hrd'])) {
            abort(403);
        }

        $request->validate([
            'jenis_pengajuan' => 'required|in:cuti,izin,sakit',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'alasan' => 'required|string|max:1000',
        ]);

        $pegawai = Pegawai::where('user_id', auth()->id())->firstOrFail();

        $pengajuan = Pengajuan::findOrFail($id);

        // Pastikan hanya pemilik yang bisa edit
        if ($pengajuan->pegawai_id != $pegawai->id) {
            abort(403);
        }

        // Sudah diproses tidak boleh diedit
        if (
            $pengajuan->status_spv != 'pending' ||
            $pengajuan->status_manager != 'pending' ||
            $pengajuan->status_hrd != 'pending'
        ) {
            return back()->with(
                'error',
                'Pengajuan yang sudah diproses tidak dapat diedit.'
            );
        }

        $jumlahHari = Carbon::parse($request->tanggal_mulai)
            ->diffInDays(Carbon::parse($request->tanggal_selesai)) + 1;

        if (
            strtolower($request->jenis_pengajuan) == 'cuti' &&
            $jumlahHari > $pegawai->sisa_cuti
        ) {
            return back()
                ->withInput()
                ->with('error', 'Sisa cuti Anda tidak mencukupi.');
        }

        $pengajuan->update([
            'jenis_pengajuan' => strtolower($request->jenis_pengajuan),
            'tanggal_mulai'   => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'alasan'          => $request->alasan,
        ]);

        return redirect()
            ->route('pengajuan.index')
            ->with('success', 'Pengajuan berhasil diperbarui.');
    }

    // =========================
    // HAPUS DATA
    // =========================
    public function destroy($id)
    {
        if (!in_array(session('role'), ['pegawai', 'spv', 'manager', 'hrd'])) {
            abort(403);
        }

        $pegawai = Pegawai::where('user_id', auth()->id())->firstOrFail();

        $pengajuan = Pengajuan::findOrFail($id);

        // Pastikan hanya pemilik yang bisa hapus
        if ($pengajuan->pegawai_id != $pegawai->id) {
            abort(403);
        }

        // Sudah diproses tidak boleh dihapus
        if (
            $pengajuan->status_spv != 'pending' ||
            $pengajuan->status_manager != 'pending' ||
            $pengajuan->status_hrd != 'pending'
        ) {
            return back()->with(
                'error',
                'Pengajuan yang sudah diproses tidak dapat dihapus.'
            );
        }

        $pengajuan->delete();

        return redirect()
            ->route('pengajuan.index')
            ->with('success', 'Pengajuan berhasil dihapus.');
    }
}