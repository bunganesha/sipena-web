@extends('layouts.index')

@section('title', 'Dashboard')

@section('page-title', 'Dashboard')

@section('content')

<div class="row row-deck row-cards">

    {{-- Total Pegawai --}}
    <div class="col-sm-6 col-lg-3">
        <div class="card">
            <div class="card-body">

                <div class="d-flex align-items-center">
                    <div class="subheader">
                        Total Pegawai
                    </div>
                </div>

                <div class="h1 mb-3">
                    120
                </div>

                <div class="d-flex mb-2">
                    <div>
                        Pegawai aktif perusahaan
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- Total Cuti --}}
    <div class="col-sm-6 col-lg-3">
        <div class="card">
            <div class="card-body">

                <div class="d-flex align-items-center">
                    <div class="subheader">
                        Pengajuan Cuti
                    </div>
                </div>

                <div class="h1 mb-3 text-warning">
                    12
                </div>

                <div class="d-flex mb-2">
                    <div>
                        Menunggu approval
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- Total Izin --}}
    <div class="col-sm-6 col-lg-3">
        <div class="card">
            <div class="card-body">

                <div class="d-flex align-items-center">
                    <div class="subheader">
                        Pengajuan Izin
                    </div>
                </div>

                <div class="h1 mb-3 text-primary">
                    5
                </div>

                <div class="d-flex mb-2">
                    <div>
                        Izin hari ini
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- Total Sakit --}}
    <div class="col-sm-6 col-lg-3">
        <div class="card">
            <div class="card-body">

                <div class="d-flex align-items-center">
                    <div class="subheader">
                        Pengajuan Sakit
                    </div>
                </div>

                <div class="h1 mb-3 text-danger">
                    8
                </div>

                <div class="d-flex mb-2">
                    <div>
                        Sakit hari ini
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>

{{-- Table Absensi --}}
<div class="row mt-4">

    <div class="col-12">
        <div class="card">

            <div class="card-header">
                <h3 class="card-title">
                    Data Absensi Hari Ini
                </h3>
            </div>

            <div class="table-responsive">

                <table class="table table-vcenter card-table">

                    <thead>
                        <tr>
                            <th>NIP</th>
                            <th>Nama Pegawai</th>
                            <th>Divisi</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>

                        <tr>
                            <td>23001</td>
                            <td>Budi Santoso</td>
                            <td>IT</td>
                            <td>
                                <span class="badge bg-success">
                                    Hadir
                                </span>
                            </td>
                        </tr>

                        <tr>
                            <td>23002</td>
                            <td>Siti Aisyah</td>
                            <td>HRD</td>
                            <td>
                                <span class="badge bg-warning">
                                    Cuti
                                </span>
                            </td>
                        </tr>

                        <tr>
                            <td>23003</td>
                            <td>Andi Saputra</td>
                            <td>Finance</td>
                            <td>
                                <span class="badge bg-danger">
                                    Alfa
                                </span>
                            </td>
                        </tr>

                    </tbody>

                </table>

            </div>

        </div>
    </div>

</div>

{{-- Informasi Sistem --}}
<div class="row mt-4">

    <div class="col-12">

        <div class="card">

            <div class="card-header">
                <h3 class="card-title">
                    Informasi SIPENA
                </h3>
            </div>

            <div class="card-body">

                <p>
                    SIPENA merupakan sistem pengelolaan absensi dan pengajuan pegawai
                    yang membantu HRD dalam mengelola data absensi, cuti, izin,
                    dan sakit secara terintegrasi.
                </p>

            </div>

        </div>

    </div>

</div>

@endsection