@extends('layouts.index')

@section('title', 'Laporan Absensi')

@section('page-title', 'Laporan Absensi')

@section('page-action')

<button class="btn btn-success"
        data-bs-toggle="modal"
        data-bs-target="#modalExport">

    Export Laporan

</button>

@endsection

@section('content')

{{-- FILTER --}}
<div class="card mb-4">

    <div class="card-body">

        <div class="row">

            {{-- FILTER BULAN --}}
            <div class="col-md-3 mb-3">

                <label class="form-label">

                    Bulan

                </label>

                <select class="form-select">

                    <option>Mei 2026</option>
                    <option>April 2026</option>
                    <option>Maret 2026</option>

                </select>

            </div>


            {{-- FILTER DIVISI --}}
            <div class="col-md-3 mb-3">

                <label class="form-label">

                    Divisi

                </label>

                <select class="form-select">

                    <option>Semua Divisi</option>
                    <option>IT</option>
                    <option>HRD</option>
                    <option>Finance</option>

                </select>

            </div>


            {{-- FILTER STATUS --}}
            <div class="col-md-3 mb-3">

                <label class="form-label">

                    Status Kehadiran

                </label>

                <select class="form-select">

                    <option>Semua Status</option>
                    <option>Hadir</option>
                    <option>Cuti</option>
                    <option>Izin</option>
                    <option>Sakit</option>
                    <option>Alfa</option>

                </select>

            </div>


            {{-- BUTTON --}}
            <div class="col-md-3 d-flex align-items-end mb-3">

                <button class="btn btn-primary w-100">

                    Tampilkan Laporan

                </button>

            </div>

        </div>

    </div>

</div>


{{-- SUMMARY --}}
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
                            Total Hadir
                        </div>

                        <div class="text-secondary">
                            Pegawai hadir
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
                            Total Cuti
                        </div>

                        <div class="text-secondary">
                            Pengajuan cuti
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
                            Total Izin
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
                            Total Alfa
                        </div>

                        <div class="text-secondary">
                            Tanpa keterangan
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


{{-- TABLE LAPORAN --}}
<div class="card">

    <div class="card-body border-bottom py-3">

        <div class="d-flex align-items-center">

            <div class="text-secondary">

                Rekap laporan absensi pegawai

            </div>

            <div class="ms-auto text-secondary">

                <div class="input-icon">

                    <input type="text"
                           class="form-control"
                           placeholder="Search laporan...">

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

                    <th>Divisi</th>

                    <th>Hadir</th>

                    <th>Cuti</th>

                    <th>Izin</th>

                    <th>Sakit</th>

                    <th>Alfa</th>

                    <th>Total Kehadiran</th>

                </tr>

            </thead>

            <tbody>

                {{-- SAMPLE DATA --}}
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

                                    Melaty

                                </div>

                            </div>

                        </div>

                    </td>


                    <td>

                        <span class="badge bg-blue-lt">

                            IT

                        </span>

                    </td>


                    <td>

                        <span class="badge bg-success-lt">

                            22

                        </span>

                    </td>


                    <td>

                        <span class="badge bg-warning-lt">

                            2

                        </span>

                    </td>


                    <td>

                        <span class="badge bg-primary-lt">

                            1

                        </span>

                    </td>


                    <td>

                        <span class="badge bg-danger-lt">

                            0

                        </span>

                    </td>


                    <td>

                        <span class="badge bg-dark-lt">

                            0

                        </span>

                    </td>


                    <td>

                        <span class="badge bg-success text-white">

                            25 Hari

                        </span>

                    </td>

                </tr>


                {{-- SAMPLE DATA --}}
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

                            </div>

                        </div>

                    </td>


                    <td>

                        <span class="badge bg-purple-lt">

                            HRD

                        </span>

                    </td>


                    <td>

                        <span class="badge bg-success-lt">

                            20

                        </span>

                    </td>


                    <td>

                        <span class="badge bg-warning-lt">

                            3

                        </span>

                    </td>


                    <td>

                        <span class="badge bg-primary-lt">

                            0

                        </span>

                    </td>


                    <td>

                        <span class="badge bg-danger-lt">

                            1

                        </span>

                    </td>


                    <td>

                        <span class="badge bg-dark-lt">

                            1

                        </span>

                    </td>


                    <td>

                        <span class="badge bg-success text-white">

                            24 Hari

                        </span>

                    </td>

                </tr>

            </tbody>

        </table>

    </div>

</div>


{{-- MODAL EXPORT --}}
<div class="modal modal-blur fade"
     id="modalExport"
     tabindex="-1">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <form action="#"
                  method="POST">

                @csrf

                {{-- HEADER --}}
                <div class="modal-header">

                    <h5 class="modal-title">

                        Export Laporan

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

                            Format Export

                        </label>

                        <select class="form-select">

                            <option>PDF</option>
                            <option>Excel</option>

                        </select>

                    </div>

                    <div class="alert alert-info">

                        Laporan akan diunduh sesuai filter yang dipilih.

                    </div>

                </div>


                {{-- FOOTER --}}
                <div class="modal-footer">

                    <button type="button"
                            class="btn me-auto"
                            data-bs-dismiss="modal">

                        Batal

                    </button>

                    <button class="btn btn-success">

                        Export Sekarang

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection