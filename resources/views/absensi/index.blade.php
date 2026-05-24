@extends('layouts.index')

@section('title', 'Data Absensi')

@section('page-title', 'Data Absensi')

@section('page-action')

<button class="btn btn-primary"
        data-bs-toggle="modal"
        data-bs-target="#modalImport">

    Import CSV

</button>

@endsection

@section('content')

{{-- CARD SUMMARY --}}
<div class="row row-deck row-cards mb-4">

    {{-- HADIR --}}
    <div class="col-sm-6 col-lg-3">

        <div class="card card-sm">

            <div class="card-body">

                <div class="row align-items-center">

                    <div class="col-auto">

                        <span class="bg-success text-white avatar">

                            ✔

                        </span>

                    </div>

                    <div class="col">

                        <div class="font-weight-medium">
                            Hadir
                        </div>

                        <div class="text-secondary">
                            Pegawai hadir hari ini
                        </div>

                    </div>

                </div>

                <div class="h1 mt-3 mb-0 text-success">
                    98
                </div>

            </div>

        </div>

    </div>


    {{-- CUTI --}}
    <div class="col-sm-6 col-lg-3">

        <div class="card card-sm">

            <div class="card-body">

                <div class="row align-items-center">

                    <div class="col-auto">

                        <span class="bg-warning text-white avatar">

                            📄

                        </span>

                    </div>

                    <div class="col">

                        <div class="font-weight-medium">
                            Cuti
                        </div>

                        <div class="text-secondary">
                            Pegawai cuti
                        </div>

                    </div>

                </div>

                <div class="h1 mt-3 mb-0 text-warning">
                    12
                </div>

            </div>

        </div>

    </div>


    {{-- IZIN --}}
    <div class="col-sm-6 col-lg-3">

        <div class="card card-sm">

            <div class="card-body">

                <div class="row align-items-center">

                    <div class="col-auto">

                        <span class="bg-primary text-white avatar">

                            📨

                        </span>

                    </div>

                    <div class="col">

                        <div class="font-weight-medium">
                            Izin
                        </div>

                        <div class="text-secondary">
                            Pegawai izin
                        </div>

                    </div>

                </div>

                <div class="h1 mt-3 mb-0 text-primary">
                    5
                </div>

            </div>

        </div>

    </div>


    {{-- ALFA --}}
    <div class="col-sm-6 col-lg-3">

        <div class="card card-sm">

            <div class="card-body">

                <div class="row align-items-center">

                    <div class="col-auto">

                        <span class="bg-danger text-white avatar">

                            ✖

                        </span>

                    </div>

                    <div class="col">

                        <div class="font-weight-medium">
                            Alfa
                        </div>

                        <div class="text-secondary">
                            Tidak hadir tanpa keterangan
                        </div>

                    </div>

                </div>

                <div class="h1 mt-3 mb-0 text-danger">
                    3
                </div>

            </div>

        </div>

    </div>

</div>


{{-- TABLE ABSENSI --}}
<div class="card">

    <div class="card-body border-bottom py-3">

        <div class="d-flex align-items-center">

            <div class="text-secondary">

                Rekap absensi pegawai

            </div>

            <div class="ms-auto text-secondary">

                <div class="input-icon">

                    <input type="text"
                           class="form-control"
                           placeholder="Search absensi...">

                </div>

            </div>

        </div>

    </div>


    <div class="table-responsive">

        <table class="table table-vcenter card-table">

            <thead>

                <tr>

                    <th>NIP</th>

                    <th>Nama Pegawai</th>

                    <th>Tanggal</th>

                    <th>Jam Masuk</th>

                    <th>Jam Keluar</th>

                    <th>Status</th>

                    <th>Keterangan</th>

                </tr>

            </thead>

            <tbody>

                {{-- DATA SAMPLE --}}
                <tr>

                    <td>

                        23001

                    </td>


                    <td>

                        <div class="d-flex py-1 align-items-center">

                            <span class="avatar me-2 bg-primary text-white">

                                B

                            </span>

                            <div class="flex-fill">

                                <div class="font-weight-medium">

                                    Budi Santoso

                                </div>

                                <div class="text-secondary">

                                    Divisi IT

                                </div>

                            </div>

                        </div>

                    </td>


                    <td>

                        20 Mei 2026

                    </td>


                    <td>

                        08:00

                    </td>


                    <td>

                        17:00

                    </td>


                    <td>

                        <span class="badge bg-success-lt">

                            Hadir

                        </span>

                    </td>


                    <td>

                        Fingerprint valid

                    </td>

                </tr>


                {{-- DATA SAMPLE --}}
                <tr>

                    <td>

                        23002

                    </td>


                    <td>

                        <div class="d-flex py-1 align-items-center">

                            <span class="avatar me-2 bg-warning text-white">

                                S

                            </span>

                            <div class="flex-fill">

                                <div class="font-weight-medium">

                                    Siti Aisyah

                                </div>

                                <div class="text-secondary">

                                    Divisi HRD

                                </div>

                            </div>

                        </div>

                    </td>


                    <td>

                        20 Mei 2026

                    </td>


                    <td>

                        -

                    </td>


                    <td>

                        -

                    </td>


                    <td>

                        <span class="badge bg-warning-lt">

                            Cuti

                        </span>

                    </td>


                    <td>

                        Pengajuan cuti approved

                    </td>

                </tr>


                {{-- DATA SAMPLE --}}
                <tr>

                    <td>

                        23003

                    </td>


                    <td>

                        <div class="d-flex py-1 align-items-center">

                            <span class="avatar me-2 bg-danger text-white">

                                A

                            </span>

                            <div class="flex-fill">

                                <div class="font-weight-medium">

                                    Andi Saputra

                                </div>

                                <div class="text-secondary">

                                    Divisi Finance

                                </div>

                            </div>

                        </div>

                    </td>


                    <td>

                        20 Mei 2026

                    </td>


                    <td>

                        -

                    </td>


                    <td>

                        -

                    </td>


                    <td>

                        <span class="badge bg-danger-lt">

                            Alfa

                        </span>

                    </td>


                    <td>

                        Tidak ada fingerprint & pengajuan

                    </td>

                </tr>

            </tbody>

        </table>

    </div>

</div>


{{-- MODAL IMPORT CSV --}}
<div class="modal modal-blur fade"
     id="modalImport"
     tabindex="-1">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <form action="#"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf

                {{-- HEADER --}}
                <div class="modal-header">

                    <h5 class="modal-title">

                        Import Absensi CSV

                    </h5>

                    <button type="button"
                            class="btn-close"
                            data-bs-dismiss="modal">

                    </button>

                </div>


                {{-- BODY --}}
                <div class="modal-body">

                    <div class="mb-3">

                        <label class="form-label">

                            Upload File CSV

                        </label>

                        <input type="file"
                               name="file_csv"
                               class="form-control"
                               accept=".csv">

                    </div>

                    <div class="alert alert-info">

                        Format file harus berupa CSV sesuai data fingerprint.

                    </div>

                </div>


                {{-- FOOTER --}}
                <div class="modal-footer">

                    <button type="button"
                            class="btn me-auto"
                            data-bs-dismiss="modal">

                        Batal

                    </button>

                    <button class="btn btn-primary">

                        Import Data

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection