<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\User;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    public function index()
    {
        $pegawais = Pegawai::latest()->get();
        return view('pegawai.index', compact('pegawais'));
    }

    public function create()
    {
        $users = User::doesntHave('pegawai')->get();
        return view('pegawai.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nip' => 'required|unique:pegawais',
            'nama' => 'required',
            'jabatan' => 'required',
            'divisi' => 'required',
            'status' => 'required',
        ]);

        Pegawai::create([
            'nip' => $request->nip,
            'nama' => $request->nama,
            'jabatan' => $request->jabatan,
            'divisi' => $request->divisi,
            'jatah_cuti' => 12,
            'sisa_cuti' => 12,
            'status' => $request->status,
        ]);

        return redirect()->route('pegawai.index');
    }

    public function edit($id)
    {
        $pegawai = Pegawai::findOrFail($id);
        return view('pegawai.edit', compact('pegawai'));
    }

    public function update(Request $request, $id)
    {
        $pegawai = Pegawai::findOrFail($id);

        $pegawai->update([
            'nip' => $request->nip,
            'nama' => $request->nama,
            'jabatan' => $request->jabatan,
            'divisi' => $request->divisi,
            'status' => $request->status,
            'jatah_cuti' => $request->jatah_cuti
        ]);

        return redirect()->route('pegawai.index');
    }

    public function destroy($id)
    {
        Pegawai::findOrFail($id)->delete();
        return redirect()->route('pegawai.index');
    }
}
