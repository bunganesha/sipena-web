@extends('layouts.index')

@section('title', 'Dashboard')

@section('page-title', 'Dashboard SIPENA')

@section('content')

{{-- STATISTIC CARDS --}}
<div class="row row-deck row-cards">

    {{-- TOTAL PEGAWAI --}}
    <div class="col-sm-6 col-lg-3">

        <div class="card card-sm">

            <div class="card-body">

                <div class="row align-items-center">

                    <div class="col-auto">

                        <span class="bg-primary text-white avatar">

                            👨‍💼

                        </span>

                    </div>

                    <div class="col">

                        <div class="font-weight-medium">
                            Total Pegawai
                        </div>

                        <div class="text-secondary">
                            Pegawai aktif perusahaan
                        </div>

                    </div>

                </div>

                <div class="h1 mt-3 mb-0">
                    120
                </div>

            </div>

        </div>

    </div>


    {{-- ABSENSI HARI INI --}}
    <div class="col-sm-6 col-lg-3">

        <div class="card card-sm">

            <div class="card-body">

                <div class="row align-items-center">

                    <div class="col-auto">

                        <span class="bg-success text-white avatar">

                            📅

                        </span>

                    </div>

                    <div class="col">

                        <div class="font-weight-medium">
                            Absensi Hari Ini
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


    {{-- PENGAJUAN CUTI --}}
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
                            Pengajuan
                        </div>

                        <div class="text-secondary">
                            Menunggu approval
                        </div>

                    </div>

                </div>

                <div class="h1 mt-3 mb-0 text-warning">
                    {{ $pending }}
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

                            ❌

                        </span>

                    </div>

                    <div class="col">

                        <div class="font-weight-medium">
                            Tidak Hadir
                        </div>

                        <div class="text-secondary">
                            Pegawai alfa hari ini
                        </div>

                    </div>

                </div>

                <div class="h1 mt-3 mb-0 text-danger">
                    {{ $alpha }}
                </div>

            </div>

        </div>

    </div>

</div>


{{-- TABLE ABSENSI --}}
<div class="row mt-4">

    <div class="col-lg-8">

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
                            <th>Nama</th>
                            <th>Divisi</th>
                            <th>Status</th>
                        </tr>

                    </thead>
                    <tbody>
                        @forelse($absensis as $absen)
                        <tr>
                            <td>{{ $absen->pegawai->nip }}</td>
                            <td>{{ $absen->pegawai->nama }}</td>
                            <td>
                                <span class="badge bg-blue-lt">
                                    {{ $absen->pegawai->divisi }}
                                </span>
                            </td>
                            <td>
                                <span class="badge
                    {{ $absen->status_absensi == 'hadir' ? 'bg-success-lt' : '' }}
                    {{ $absen->status_absensi == 'izin' ? 'bg-warning-lt' : '' }}
                    {{ $absen->status_absensi == 'sakit' ? 'bg-info-lt' : '' }}
                    {{ $absen->status_absensi == 'alpa' ? 'bg-danger-lt' : '' }}
                ">
                                    {{ ucfirst($absen->status_absensi) }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center">
                                Tidak ada data absensi hari ini
                            </td>
                        </tr>
                        @endforelse
                    </tbody>

                </table>

            </div>

        </div>

    </div>


    {{-- QUICK MENU --}}
    <div class="col-lg-4">

        <div class="card">

            <div class="card-header">

                <h3 class="card-title">
                    Quick Access
                </h3>

            </div>

            <div class="list-group list-group-flush">

                <a href="/pegawai"
                    class="list-group-item list-group-item-action">

                    👨‍💼 Kelola Pegawai

                </a>

                <a href="/absensi"
                    class="list-group-item list-group-item-action">

                    📅 Data Absensi

                </a>

                <a href="/approval"
                    class="list-group-item list-group-item-action">

                    ✅ Approval Pengajuan

                </a>

                <a href="/laporan"
                    class="list-group-item list-group-item-action">

                    📊 Laporan Absensi

                </a>

            </div>

        </div>

    </div>

</div>

@endsection