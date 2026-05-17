<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pegawai;

class PegawaiController extends Controller
{
    public function index()
    {
        $pegawai = Pegawai::all();

        return view('pegawai.index', compact('pegawai'));
    }

    public function store(Request $request)
{
    Pegawai::create([
        'id_user' => 1,
        'nip' => $request->nip,
        'nama' => $request->nama,
        'jabatan' => $request->jabatan,
        'divisi' => $request->divisi,
        'jatah_cuti' => $request->jatah_cuti,
    ]);

        return redirect('/pegawai');
    }
}