@extends('layouts.index')

@section('title', 'Tambah Pengajuan')
@section('page-title', 'Tambah Pengajuan')

@section('content')

<div class="card">

    <div class="card-body">

        <form action="{{ route('pengajuan.store') }}" method="POST">
            @csrf

            <div class="row">

                {{-- PEGAWAI --}}
                <div class="col-md-6 mb-3">
                    <label class="form-label">Pegawai</label>
                    <input
                        type="text"
                        class="form-control"
                        value="{{ $pegawai->nama }}"
                        readonly>

                    <input
                        type="hidden"
                        name="pegawai_id"
                        value="{{ $pegawai->id }}">
                </div>

                {{-- JENIS PENGAJUAN --}}
                <div class="col-md-6 mb-3">
                    <label class="form-label">Jenis Pengajuan</label>
                    <select name="jenis_pengajuan" class="form-select" required>
                        <option value="cuti">Cuti</option>
                        <option value="izin">Izin</option>
                        <option value="sakit">Sakit</option>
                    </select>
                </div>

                {{-- TANGGAL MULAI --}}
                <div class="col-md-6 mb-3">
                    <label class="form-label">Tanggal Mulai</label>
                    <input type="date" name="tanggal_mulai" class="form-control" required>
                </div>

                {{-- TANGGAL SELESAI --}}
                <div class="col-md-6 mb-3">
                    <label class="form-label">Tanggal Selesai</label>
                    <input type="date" name="tanggal_selesai" class="form-control" required>
                </div>

                {{-- ALASAN --}}
                <div class="col-md-12 mb-3">
                    <label class="form-label">Alasan</label>
                    <textarea name="alasan" class="form-control" rows="4" required></textarea>
                </div>

            </div>

            {{-- BUTTON --}}
            <div class="d-flex justify-content-end">
                <a href="{{ route('pengajuan.index') }}" class="btn btn-secondary me-2">
                    Kembali
                </a>

                <button class="btn btn-primary">
                    Simpan Pengajuan
                </button>
            </div>

        </form>

    </div>

</div>

@endsection