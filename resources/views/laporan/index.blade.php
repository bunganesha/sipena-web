@extends('layouts.index')

@section('title', 'Laporan Absensi')

@section('page-title', 'Laporan Absensi')

@section('page-action')

<button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalExport">

    Export Laporan

</button>

@endsection

@section('content')

{{-- FILTER --}}
<div class="card mb-4">

    <div class="card-body">

        <form action="/laporan" method="GET">

            <div class="row">

                {{-- SEARCH --}}
                <div class="col-md-3 mb-3">

                    <label class="form-label">
                        Search
                    </label>

                    <input type="text" name="search" class="form-control" placeholder="Cari pegawai..."
                        value="{{ request('search') }}">

                </div>


                {{-- FILTER DIVISI --}}
                <div class="col-md-3 mb-3">

                    <label class="form-label">
                        Divisi
                    </label>

                    <select class="form-select" name="divisi">

                        <option>Semua Divisi</option>

                        <option value="IT">
                            IT
                        </option>

                        <option value="HRD">
                            HRD
                        </option>

                        <option value="Finance">
                            Finance
                        </option>

                    </select>

                </div>


                {{-- FILTER STATUS --}}
                <div class="col-md-3 mb-3">

                    <label class="form-label">
                        Status Kehadiran
                    </label>

                    <select class="form-select" name="status">

                        <option>Semua Status</option>

                        <option value="Hadir">
                            Hadir
                        </option>

                        <option value="Cuti">
                            Cuti
                        </option>

                        <option value="Izin">
                            Izin
                        </option>

                        <option value="Sakit">
                            Sakit
                        </option>

                        <option value="Alpha">
                            Alpha
                        </option>

                    </select>

                </div>

                <div class="col-md-2 mb-3">

                    <label class="form-label">

                        Bulan

                    </label>

                    <select
                        class="form-select"
                        name="bulan">

                        <option value="">Semua</option>

                        @for($i=1;$i<=12;$i++)

                            <option
                            value="{{ $i }}"
                            {{ request('bulan')==$i?'selected':'' }}>

                            {{ DateTime::createFromFormat('!m',$i)->format('F') }}

                            </option>

                            @endfor

                    </select>

                </div>
                {{-- BUTTON --}}
                <div class="col-md-3 d-flex align-items-end mb-3">

                    <button class="btn btn-primary w-100">

                        Tampilkan Laporan

                    </button>

                </div>

            </div>

        </form>

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

                    </div>

                </div>

                <div class="h1 mt-3 mb-0 text-success">
                    {{ $hadir }}
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

                    </div>

                </div>

                <div class="h1 mt-3 mb-0 text-warning">
                    {{ $cuti }}
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

                    </div>

                </div>

                <div class="h1 mt-3 mb-0 text-primary">
                    {{ $izin }}
                </div>

            </div>

        </div>

    </div>


    {{-- ALPHA --}}
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
                            Total Alpha
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


{{-- TABLE --}}
<div class="card">

    <div class="table-responsive">

        <table class="table table-vcenter card-table">

            <thead>

                <tr>

                    <th>NIP</th>
                    <th>Nama Pegawai</th>
                    <th>Divisi</th>
                    <th>Hadir</th>
                    <th>Izin</th>
                    <th>Sakit</th>
                    <th>Cuti</th>
                    <th>Alpha</th>
                    <th>Aksi</th>

                </tr>

            </thead>

            <tbody>

                @forelse($pegawais as $pegawai)

                <tr>

                    <td>
                        {{ $pegawai->nip }}
                    </td>

                    <td>
                        {{ $pegawai->nama }}
                    </td>

                    <td>
                        {{ $pegawai->divisi }}
                    </td>

                    <td>

                        {{ $pegawai->absensis->where('status_absensi','hadir')->count() }}

                    </td>

                    <td>

                        {{ $pegawai->absensis->where('status_absensi','izin')->count() }}

                    </td>

                    <td>

                        {{ $pegawai->absensis->where('status_absensi','sakit')->count() }}

                    </td>

                    <td>

                        {{ $pegawai->absensis->where('status_absensi','cuti')->count() }}

                    </td>

                    <td>

                        {{ $pegawai->absensis->where('status_absensi','alpha')->count() }}

                    </td>

                    <td>

                        <a
                            href="{{ route('laporan.pdf.pegawai',$pegawai->id) }}?bulan={{ request('bulan') }}"
                            class="btn btn-danger btn-sm">

                            PDF

                        </a>

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="4" class="text-center">

                        Data tidak ditemukan

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>


{{-- MODAL EXPORT --}}
<div class="modal modal-blur fade" id="modalExport" tabindex="-1">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title">

                    Export Laporan

                </h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal">

                </button>

            </div>


            <div class="modal-body">

                <form action="{{ route('laporan.export') }}" method="POST" class="mb-3">

                    @csrf

                    <button class="btn btn-success w-100">

                        Export Excel

                    </button>

                </form>


                <form action="{{ route('laporan.export.pdf') }}" method="POST">

                    @csrf

                    <button class="btn btn-danger w-100">

                        Export PDF

                    </button>

                </form>

            </div>

        </div>

    </div>

</div>

@endsection