@extends('layouts.index')

@section('title', 'Data Absensi')

@section('page-title', 'Data Absensi')

@section('page-action')

<button class="btn btn-primary"
    data-bs-toggle="modal"
    data-bs-target="#modalTambah">

    Tambah Absensi

</button>

<button class="btn btn-success"
    data-bs-toggle="modal"
    data-bs-target="#modalImport">

    Import CSV

</button>

@endsection

@section('content')

<div class="card">

    {{-- HEADER --}}
    <div class="card-body border-bottom py-3">

        <form action="/absensi"
            method="GET">

            <div class="d-flex align-items-center">

                <div class="text-secondary">

                    Kelola data absensi pegawai

                </div>

                <div class="ms-auto text-secondary">

                    <div class="input-icon">

                        <input type="text"
                            name="search"
                            class="form-control"
                            placeholder="Search absensi..."
                            value="{{ request('search') }}">

                    </div>

                </div>

            </div>

        </form>

    </div>


    {{-- TABLE --}}
    <div class="table-responsive">

        <table class="table table-vcenter card-table">

            <thead>

                <tr>

                    <th>NIP</th>
                    <th>Nama</th>
                    <th>Tanggal</th>
                    <th>Jam Masuk</th>
                    <th>Jam Keluar</th>
                    <th>Status</th>
                    <th>Keterangan</th>
                    <th class="w-1">Aksi</th>

                </tr>

            </thead>

            <tbody>

                @forelse($absensis as $item)

                <tr>

                    <td>

                        {{ $item->pegawai->nip ?? '-' }}

                    </td>

                    <td>

                        {{ $item->pegawai->nama ?? '-' }}

                    </td>

                    <td>

                        {{ $item->tanggal }}

                    </td>

                    <td>

                        {{ $item->jam_masuk }}

                    </td>

                    <td>

                        {{ $item->jam_keluar }}

                    </td>

                    <td>

                        <span class="badge bg-primary-lt">

                            {{ ucfirst($item->status_absensi) }}

                        </span>

                    </td>

                    <td>

                        {{ $item->keterangan }}

                    </td>

                    <td>

                        <div class="btn-list flex-nowrap">

                            <a href="/absensi/{{ $item->id }}/edit"
                                class="btn btn-warning btn-sm">

                                Edit

                            </a>

                            <form action="/absensi/{{ $item->id }}"
                                method="POST">

                                @csrf
                                @method('DELETE')

                                <button class="btn btn-danger btn-sm">

                                    Hapus

                                </button>

                            </form>

                        </div>

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="8"
                        class="text-center">

                        Data absensi kosong

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>


{{-- MODAL TAMBAH --}}
<div class="modal modal-blur fade"
    id="modalTambah"
    tabindex="-1">

    <div class="modal-dialog modal-lg modal-dialog-centered">

        <div class="modal-content">

            <form action="/absensi"
                method="POST">

                @csrf

                <div class="modal-header">

                    <h5 class="modal-title">

                        Tambah Absensi

                    </h5>

                    <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal">

                    </button>

                </div>


                <div class="modal-body">

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Pegawai

                            </label>

                            <select name="pegawai_id"
                                class="form-select">

                                @foreach($pegawais as $pegawai)

                                <option value="{{ $pegawai->id }}">

                                    {{ $pegawai->nama }}

                                </option>

                                @endforeach

                            </select>

                        </div>


                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Tanggal

                            </label>

                            <input type="date"
                                name="tanggal"
                                class="form-control">

                        </div>


                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Jam Masuk

                            </label>

                            <input type="time"
                                name="jam_masuk"
                                class="form-control">

                        </div>


                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Jam Keluar

                            </label>

                            <input type="time"
                                name="jam_keluar"
                                class="form-control">

                        </div>


                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Status

                            </label>

                            <select name="status_absensi"
                                class="form-select">

                                <option value="hadir">
                                    Hadir
                                </option>

                                <option value="izin">
                                    Izin
                                </option>

                                <option value="sakit">
                                    Sakit
                                </option>

                                <option value="cuti">
                                    Cuti
                                </option>

                                <option value="alpha">
                                    Alpha
                                </option>

                            </select>

                        </div>


                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Keterangan

                            </label>

                            <input type="text"
                                name="keterangan"
                                class="form-control">

                        </div>

                    </div>

                </div>


                <div class="modal-footer">

                    <button type="button"
                        class="btn me-auto"
                        data-bs-dismiss="modal">

                        Batal

                    </button>

                    <button class="btn btn-primary">

                        Simpan

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>


{{-- MODAL IMPORT --}}
<div class="modal modal-blur fade"
    id="modalImport"
    tabindex="-1">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <form action="{{ route('absensi.import') }}"
                method="POST"
                enctype="multipart/form-data">

                @csrf

                <div class="modal-header">

                    <h5 class="modal-title">

                        Import CSV / Excel

                    </h5>

                    <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal">

                    </button>

                </div>


                <div class="modal-body">

                    <div class="mb-3">

                        <label class="form-label">
                            Pegawai
                        </label>

                        <select
                            name="pegawai_id"
                            class="form-select"
                            required>

                            <option value="">
                                -- Pilih Pegawai --
                            </option>

                            @foreach($pegawais as $pegawai)

                            <option value="{{ $pegawai->id }}">

                                {{ $pegawai->nip }}
                                -
                                {{ $pegawai->nama }}

                            </option>

                            @endforeach

                        </select>

                    </div>

                    <div>

                        <label class="form-label">
                            File Fingerprint
                        </label>

                        <input
                            type="file"
                            name="file"
                            class="form-control"
                            required>

                    </div>

                </div>


                <div class="modal-footer">

                    <button type="button"
                        class="btn me-auto"
                        data-bs-dismiss="modal">

                        Batal

                    </button>

                    <button class="btn btn-success">

                        Import

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection