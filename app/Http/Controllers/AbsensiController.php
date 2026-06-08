<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absensi;
use App\Models\Pegawai;
use App\Imports\AbsensiImport;
use Maatwebsite\Excel\Facades\Excel;

class AbsensiController extends Controller
{
    // =========================
    // INDEX
    // =========================
    public function index(Request $request)
    {
        $search = $request->search;

        $absensis = Absensi::with('pegawai')

            ->when($search, function ($query) use ($search) {

                $query->whereHas('pegawai',
                    function ($q) use ($search) {

                    $q->where('nama', 'like', "%{$search}%")
                      ->orWhere('nip', 'like', "%{$search}%");

                });

            })

            ->latest()
            ->get();

        $pegawais = Pegawai::all();

        return view('absensi.index', compact(
            'absensis',
            'pegawais'
        ));
    }


    // =========================
    // STORE
    // =========================
    public function store(Request $request)
    {
        $request->validate([
            'pegawai_id' => 'required',
            'tanggal' => 'required',
            'status_absensi' => 'required',
        ]);

        Absensi::create([

            'pegawai_id' => $request->pegawai_id,
            'tanggal' => $request->tanggal,
            'jam_masuk' => $request->jam_masuk,
            'jam_keluar' => $request->jam_keluar,
            'status_absensi' => $request->status_absensi,
            'keterangan' => $request->keterangan,

        ]);

        return redirect('/absensi');
    }


    // =========================
    // EDIT
    // =========================
    public function edit($id)
    {
        $absensi = Absensi::findOrFail($id);

        $pegawais = Pegawai::all();

        return view('absensi.edit', compact(
            'absensi',
            'pegawais'
        ));
    }


    // =========================
    // UPDATE
    // =========================
    public function update(Request $request, $id)
    {
        $absensi = Absensi::findOrFail($id);

        $absensi->update([

            'pegawai_id' => $request->pegawai_id,
            'tanggal' => $request->tanggal,
            'jam_masuk' => $request->jam_masuk,
            'jam_keluar' => $request->jam_keluar,
            'status_absensi' => $request->status_absensi,
            'keterangan' => $request->keterangan,

        ]);

        return redirect('/absensi');
    }


    // =========================
    // DELETE
    // =========================
    public function destroy($id)
    {
        Absensi::findOrFail($id)->delete();

        return redirect('/absensi');
    }


    // =========================
    // IMPORT CSV / EXCEL
    // =========================
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,xlsx,xls'
        ]);

        Excel::import(
            new AbsensiImport,
            $request->file('file')
        );

        return redirect('/absensi');
    }
}