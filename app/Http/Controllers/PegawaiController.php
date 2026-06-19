<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\User;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    // =========================
    // TAMPIL DATA PEGAWAI
    // =========================
    public function index(Request $request)
    {
        // ROLE PERMISSION
        if (session('role') != 'hrd') {
            abort(403);
        }

        // SEARCH
        $search = $request->search;

        $pegawais = Pegawai::when($search, function ($query) use ($search) {

            $query->where('nama', 'like', "%{$search}%")
                ->orWhere('nip', 'like', "%{$search}%")
                ->orWhere('divisi', 'like', "%{$search}%");

        })
        ->latest()
        ->get();

        // HITUNG SISA CUTI
        foreach ($pegawais as $pegawai) {

            $jumlahCuti = \App\Models\Absensi::where(
                'pegawai_id',
                $pegawai->id
            )
            ->where('status_absensi', 'cuti')
            ->count();

            $pegawai->sisa_cuti =
                $pegawai->jatah_cuti - $jumlahCuti;
        }

        $users = User::doesntHave('pegawai')->get();

        return view('pegawai.index', compact(
            'pegawais',
            'users'
        ));
    }


    // =========================
    // FORM CREATE
    // =========================
    public function create()
    {
        if (session('role') != 'hrd') {
            abort(403);
        }

        $users = User::doesntHave('pegawai')->get();

        return view('pegawai.create', compact('users'));
    }


    // =========================
    // SIMPAN DATA
    // =========================
    public function store(Request $request)
    {
        if (session('role') != 'hrd') {
            abort(403);
        }

        $request->validate([
            'id_user' => 'required|exists:users,id',
            'nip' => 'required|unique:pegawais',
            'nama' => 'required',
            'jabatan' => 'required',
            'divisi' => 'required',
            'status' => 'required',
            'jatah_cuti' => 'required|numeric|min:0',
        ]);

        Pegawai::create([
            'id_user' => $request->id_user,
            'nip' => $request->nip,
            'nama' => $request->nama,
            'jabatan' => $request->jabatan,
            'divisi' => $request->divisi,
            'jatah_cuti' => $request->jatah_cuti,
            'sisa_cuti' => $request->jatah_cuti,
            'status' => $request->status,
        ]);

        return redirect()
            ->route('pegawai.index')
            ->with('success', 'Data pegawai berhasil ditambahkan');
    }


    // =========================
    // FORM EDIT
    // =========================
    public function edit($id)
    {
        if (session('role') != 'hrd') {
            abort(403);
        }

        $pegawai = Pegawai::findOrFail($id);

        return view('pegawai.edit', compact('pegawai'));
    }


    // =========================
    // UPDATE DATA
    // =========================
    public function update(Request $request, $id)
    {
        if (session('role') != 'hrd') {
            abort(403);
        }

        $pegawai = Pegawai::findOrFail($id);

        $pegawai->update([
            'nip' => $request->nip,
            'nama' => $request->nama,
            'jabatan' => $request->jabatan,
            'divisi' => $request->divisi,
            'status' => $request->status,
            'jatah_cuti' => $request->jatah_cuti
        ]);

        return redirect()
            ->route('pegawai.index')
            ->with('success', 'Data pegawai berhasil diupdate');
    }


    // =========================
    // HAPUS DATA
    // =========================
    public function destroy($id)
    {
        if (session('role') != 'hrd') {
            abort(403);
        }

        Pegawai::findOrFail($id)->delete();

        return redirect()
            ->route('pegawai.index')
            ->with('success', 'Data pegawai berhasil dihapus');
    }
}