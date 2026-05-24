<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use App\Models\Pegawai;
use Illuminate\Http\Request;

class PengajuanController extends Controller
{
    public function index()
    {
        $pengajuans = Pengajuan::with('pegawai')->latest()->get();
        $pegawais = Pegawai::all(); 

        return view('pengajuan.index', compact('pengajuans', 'pegawais'));
    }

    public function create()
    {
        $pegawais = Pegawai::all(); // INI YANG KAMU LUPA

        return view('pengajuan.create', compact('pegawais'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pegawai_id' => 'required|exists:pegawais,id',
            'jenis_pengajuan' => 'required',
            'tanggal_mulai' => 'required',
            'tanggal_selesai' => 'required',
            'alasan' => 'required',
        ]);

        Pengajuan::create([
            'pegawai_id' => $request->pegawai_id,
            'jenis_pengajuan' => $request->jenis_pengajuan,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'alasan' => $request->alasan,
        ]);

        return redirect()->route('pengajuan.index');
    }

    public function edit($id)
    {
        $pengajuan = Pengajuan::findOrFail($id);
        $pegawais = Pegawai::all();

        return view('pengajuan.edit', compact('pengajuan', 'pegawais'));
    }

    public function update(Request $request, $id)
    {
        $pengajuan = Pengajuan::findOrFail($id);

        $pengajuan->update([
            'pegawai_id' => $request->pegawai_id,
            'jenis_pengajuan' => $request->jenis_pengajuan,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'alasan' => $request->alasan,
        ]);

        return redirect()->route('pengajuan.index');
    }

    public function destroy($id)
    {
        Pengajuan::findOrFail($id)->delete();

        return redirect()->route('pengajuan.index');
    }
}
