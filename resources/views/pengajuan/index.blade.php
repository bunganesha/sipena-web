@extends('layouts.index')

@section('title', 'Pengajuan')

@section('page-title', 'Pengajuan Pegawai')

@section('page-action')

    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambah">

        Tambah Pengajuan

    </button>

@endsection

@section('content')

    <div class="card">

        {{-- HEADER --}}
        <div class="card-body border-bottom py-3">

            <form action="/pengajuan" method="GET">

                <div class="d-flex align-items-center">

                    <div class="text-secondary">

                        Kelola pengajuan cuti, izin, dan sakit pegawai

                    </div>

                    <div class="ms-auto text-secondary">

                        <div class="input-icon">

                            <input type="text" name="search" class="form-control" placeholder="Search pengajuan..."
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

                        <th>ID</th>
                        <th>Pegawai</th>
                        <th>Jenis</th>
                        <th>Tanggal Mulai</th>
                        <th>Tanggal Selesai</th>
                        <th>Alasan</th>
                        <th>Status</th>
                        <th class="w-1">Aksi</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($pengajuans as $item)

                        <tr>

                            <td>

                                PNG00{{ $item->id }}

                            </td>


                            {{-- PEGAWAI --}}
                            <td>

                                <div class="d-flex py-1 align-items-center">

                                    <span class="avatar me-2 bg-primary text-white">

                                        {{ strtoupper(substr($item->pegawai->nama ?? 'P', 0, 1)) }}

                                    </span>

                                    <div class="flex-fill">

                                        <div class="font-weight-medium">

                                            {{ $item->pegawai->nama ?? '-' }}

                                        </div>

                                        <div class="text-secondary">

                                            {{ $item->pegawai->divisi ?? '-' }}

                                        </div>

                                    </div>

                                </div>

                            </td>


                            {{-- JENIS --}}
                            <td>

                                <span class="badge bg-primary-lt text-primary">

                                    {{ ucfirst($item->jenis_pengajuan) }}

                                </span>

                            </td>


                            {{-- TANGGAL --}}
                            <td>

                                {{ $item->tanggal_mulai }}

                            </td>

                            <td>

                                {{ $item->tanggal_selesai }}

                            </td>


                            {{-- ALASAN --}}
                            <td>

                                {{ $item->alasan }}

                            </td>


                            {{-- STATUS --}}
                            <td>

                                @if ($item->status_spv == 'approved' && $item->status_manager == 'approved' && $item->status_hrd == 'approved')
                                    <span class="badge bg-success">

                                        Approved

                                    </span>
                                @elseif($item->status_spv == 'rejected' || $item->status_manager == 'rejected' || $item->status_hrd == 'rejected')
                                    <span class="badge bg-danger">

                                        Rejected

                                    </span>
                                @else
                                    <span class="badge bg-warning">

                                        Process

                                    </span>
                                @endif

                            </td>


                            {{-- AKSI --}}
                            <td>

                                <div class="btn-list flex-nowrap">

                                    {{-- EDIT --}}
                                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#edit{{ $item->id }}">

                                        Edit

                                    </button>


                                    {{-- DELETE --}}
                                    <form action="/pengajuan/{{ $item->id }}" method="POST">

                                        @csrf
                                        @method('DELETE')

                                        <button class="btn btn-danger btn-sm">

                                            Hapus

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>


                        {{-- MODAL EDIT --}}
                        <div class="modal modal-blur fade" id="edit{{ $item->id }}" tabindex="-1">

                            <div class="modal-dialog modal-lg modal-dialog-centered">

                                <div class="modal-content">

                                    <form action="/pengajuan/{{ $item->id }}" method="POST">

                                        @csrf
                                        @method('PUT')

                                        <div class="modal-header">

                                            <h5 class="modal-title">

                                                Edit Pengajuan

                                            </h5>

                                            <button type="button" class="btn-close" data-bs-dismiss="modal">

                                            </button>

                                        </div>


                                        <div class="modal-body">

                                            <div class="row">

                                                <div class="col-md-6 mb-3">

                                                    <label class="form-label">

                                                        Pegawai

                                                    </label>

                                                    <select name="pegawai_id" class="form-select">

                                                        @foreach ($pegawais as $pegawai)
                                                            <option value="{{ $pegawai->id }}"
                                                                {{ $pegawai->id == $item->pegawai_id ? 'selected' : '' }}>

                                                                {{ $pegawai->nama }}

                                                            </option>
                                                        @endforeach

                                                    </select>

                                                </div>


                                                <div class="col-md-6 mb-3">

                                                    <label class="form-label">

                                                        Jenis Pengajuan

                                                    </label>

                                                    <select name="jenis_pengajuan" class="form-select">

                                                        <option value="cuti">
                                                            Cuti
                                                        </option>

                                                        <option value="izin">
                                                            Izin
                                                        </option>

                                                        <option value="sakit">
                                                            Sakit
                                                        </option>

                                                    </select>

                                                </div>


                                                <div class="col-md-6 mb-3">

                                                    <label class="form-label">

                                                        Tanggal Mulai

                                                    </label>

                                                    <input type="date" name="tanggal_mulai" class="form-control"
                                                        value="{{ $item->tanggal_mulai }}">

                                                </div>


                                                <div class="col-md-6 mb-3">

                                                    <label class="form-label">

                                                        Tanggal Selesai

                                                    </label>

                                                    <input type="date" name="tanggal_selesai" class="form-control"
                                                        value="{{ $item->tanggal_selesai }}">

                                                </div>


                                                <div class="col-12 mb-3">

                                                    <label class="form-label">

                                                        Alasan

                                                    </label>

                                                    <textarea name="alasan" class="form-control" rows="4">{{ $item->alasan }}</textarea>

                                                </div>

                                            </div>

                                        </div>


                                        <div class="modal-footer">

                                            <button type="button" class="btn me-auto" data-bs-dismiss="modal">

                                                Batal

                                            </button>

                                            <button class="btn btn-primary">

                                                Update

                                            </button>

                                        </div>

                                    </form>

                                </div>

                            </div>

                        </div>

                    @empty

                        <tr>

                            <td colspan="8" class="text-center">

                                Data pengajuan kosong

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>


    {{-- MODAL TAMBAH --}}
    <div class="modal modal-blur fade" id="modalTambah" tabindex="-1">

        <div class="modal-dialog modal-lg modal-dialog-centered">

            <div class="modal-content">

                <form action="/pengajuan" method="POST">

                    @csrf

                    <div class="modal-header">

                        <h5 class="modal-title">

                            Tambah Pengajuan

                        </h5>

                        <button type="button" class="btn-close" data-bs-dismiss="modal">

                        </button>

                    </div>


                    <div class="modal-body">

                        <div class="row">

                            <div class="col-md-6 mb-3">

                                <label class="form-label">

                                    Pegawai

                                </label>

                                <select name="pegawai_id" class="form-select">

                                    @foreach ($pegawais as $pegawai)
                                        <option value="{{ $pegawai->id }}">

                                            {{ $pegawai->nama }}

                                        </option>
                                    @endforeach

                                </select>

                            </div>


                            <div class="col-md-6 mb-3">

                                <label class="form-label">

                                    Jenis Pengajuan

                                </label>

                                <select name="jenis_pengajuan" class="form-select">

                                    <option value="cuti">
                                        Cuti
                                    </option>

                                    <option value="izin">
                                        Izin
                                    </option>

                                    <option value="sakit">
                                        Sakit
                                    </option>

                                </select>

                            </div>

                        </div>

                    </div>

                </form>

            </div>

        </div>

    </div>

@endsection
