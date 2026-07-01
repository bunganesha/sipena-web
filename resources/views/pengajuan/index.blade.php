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

                @php

                $pemohonRole = strtolower(optional(optional($item->pegawai)->user)->role);

                $statusFinal = 'Process';

                if (
                $item->status_spv == 'rejected' ||
                $item->status_manager == 'rejected' ||
                $item->status_hrd == 'rejected'
                ) {
                $statusFinal = 'Rejected';
                }

                elseif (
                $pemohonRole == 'pegawai' &&
                $item->status_spv == 'approved' &&
                $item->status_manager == 'approved' &&
                $item->status_hrd == 'approved'
                ) {
                $statusFinal = 'Approved';
                }

                elseif (
                $pemohonRole == 'spv' &&
                $item->status_manager == 'approved' &&
                $item->status_hrd == 'approved'
                ) {
                $statusFinal = 'Approved';
                }

                elseif (
                in_array($pemohonRole, ['manager', 'hrd']) &&
                $item->status_hrd == 'approved'
                ) {
                $statusFinal = 'Approved';
                }

                @endphp

                <tr>

                    {{-- ID --}}
                    <td>

                        PNG{{ str_pad($item->id,4,'0',STR_PAD_LEFT) }}

                    </td>

                    {{-- Pegawai --}}
                    <td>

                        <div class="d-flex py-1 align-items-center">

                            <span class="avatar me-2 bg-primary text-white">

                                {{ strtoupper(substr(optional($item->pegawai)->nama ?? 'P',0,1)) }}

                            </span>

                            <div>

                                <div class="fw-bold">

                                    {{ optional($item->pegawai)->nama }}

                                </div>

                                <div class="text-secondary">

                                    {{ optional($item->pegawai)->divisi }}

                                </div>

                            </div>

                        </div>

                    </td>

                    {{-- Jenis --}}
                    <td>

                        <span class="badge bg-primary-lt">

                            {{ ucfirst($item->jenis_pengajuan) }}

                        </span>

                    </td>

                    {{-- Tanggal --}}
                    <td>

                        {{ $item->tanggal_mulai }}

                    </td>

                    <td>

                        {{ $item->tanggal_selesai }}

                    </td>

                    {{-- Alasan --}}
                    <td>

                        {{ $item->alasan }}

                    </td>

                    {{-- Status --}}
                    <td>

                        @if($statusFinal=='Approved')

                        <span class="badge bg-success">

                            Approved

                        </span>

                        @elseif($statusFinal=='Rejected')

                        <span class="badge bg-danger">

                            Rejected

                        </span>

                        @else

                        <span class="badge bg-warning">

                            Process

                        </span>

                        @endif

                    </td>

                    {{-- Aksi --}}
                    <td>

                        <div class="btn-list flex-nowrap">

                            @if(
                            $item->status_spv=='pending' &&
                            $item->status_manager=='pending' &&
                            $item->status_hrd=='pending'
                            )

                            <button
                                class="btn btn-warning btn-sm"
                                data-bs-toggle="modal"
                                data-bs-target="#edit{{ $item->id }}">

                                Edit

                            </button>

                            @endif


                            @if(
                            $item->status_spv=='pending' &&
                            $item->status_manager=='pending' &&
                            $item->status_hrd=='pending'
                            )

                            <form
                                action="/pengajuan/{{ $item->id }}"
                                method="POST"
                                onsubmit="return confirm('Yakin ingin menghapus pengajuan ini?')">

                                @csrf
                                @method('DELETE')

                                <button class="btn btn-danger btn-sm">

                                    Hapus

                                </button>

                            </form>

                            @endif

                            <button
                                class="btn btn-info btn-sm"
                                data-pengajuan='@json($item)'
                                onclick="showDetail(this)">

                                Detail

                            </button>

                        </div>

                    </td>

                </tr>

                {{-- ========================= --}}
                {{-- MODAL EDIT --}}
                {{-- ========================= --}}

                <div class="modal modal-blur fade" id="edit{{ $item->id }}" tabindex="-1">

                    <div class="modal-dialog modal-lg modal-dialog-centered">

                        <div class="modal-content">

                            <form
                                action="/pengajuan/{{ $item->id }}"
                                method="POST"
                                class="form-edit-pengajuan">

                                @csrf
                                @method('PUT')

                                <div class="modal-header">

                                    <h5 class="modal-title">

                                        Edit Pengajuan

                                    </h5>

                                    <button
                                        type="button"
                                        class="btn-close"
                                        data-bs-dismiss="modal">
                                    </button>

                                </div>

                                <div class="modal-body">

                                    <div class="row">

                                        {{-- Jenis --}}
                                        <div class="col-md-6 mb-3">

                                            <label class="form-label">

                                                Jenis Pengajuan

                                            </label>

                                            <select
                                                name="jenis_pengajuan"
                                                class="form-select"
                                                required>

                                                <option value="cuti"
                                                    {{ $item->jenis_pengajuan=='cuti' ? 'selected' : '' }}>

                                                    Cuti

                                                </option>

                                                <option value="izin"
                                                    {{ $item->jenis_pengajuan=='izin' ? 'selected' : '' }}>

                                                    Izin

                                                </option>

                                                <option value="sakit"
                                                    {{ $item->jenis_pengajuan=='sakit' ? 'selected' : '' }}>

                                                    Sakit

                                                </option>

                                            </select>

                                        </div>

                                        {{-- Tanggal Mulai --}}
                                        <div class="col-md-6 mb-3">

                                            <label class="form-label">

                                                Tanggal Mulai

                                            </label>

                                            <input
                                                type="date"
                                                name="tanggal_mulai"
                                                class="form-control"
                                                value="{{ $item->tanggal_mulai }}"
                                                required>

                                        </div>

                                        {{-- Tanggal Selesai --}}
                                        <div class="col-md-6 mb-3">

                                            <label class="form-label">

                                                Tanggal Selesai

                                            </label>

                                            <input
                                                type="date"
                                                name="tanggal_selesai"
                                                class="form-control"
                                                value="{{ $item->tanggal_selesai }}"
                                                required>

                                        </div>

                                        {{-- Alasan --}}
                                        <div class="col-12 mb-3">

                                            <label class="form-label">

                                                Alasan

                                            </label>

                                            <textarea
                                                name="alasan"
                                                class="form-control"
                                                rows="4"
                                                required>{{ $item->alasan }}</textarea>

                                        </div>

                                    </div>

                                </div>

                                <div class="modal-footer">

                                    <button
                                        type="button"
                                        class="btn me-auto"
                                        data-bs-dismiss="modal">

                                        Batal

                                    </button>

                                    <button
                                        type="submit"
                                        class="btn btn-primary">

                                        Update Pengajuan

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


{{-- ========================= --}}
{{-- MODAL TAMBAH --}}
{{-- ========================= --}}

<div class="modal modal-blur fade" id="modalTambah" tabindex="-1">

    <div class="modal-dialog modal-lg modal-dialog-centered">

        <div class="modal-content">

            <form
                action="/pengajuan"
                method="POST"
                id="formTambahPengajuan">

                @csrf

                <div class="modal-header">

                    <h5 class="modal-title">

                        Tambah Pengajuan

                    </h5>

                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal">
                    </button>

                </div>

                <div class="modal-body">

                    <div class="row">

                        {{-- Pegawai --}}
                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Pegawai

                            </label>

                            <input
                                type="text"
                                class="form-control"
                                value="{{ auth()->user()->pegawai->nama ?? session('username') }}"
                                readonly>

                        </div>

                        {{-- Jenis --}}
                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Jenis Pengajuan

                            </label>

                            <select
                                name="jenis_pengajuan"
                                class="form-select"
                                required>

                                <option value="">Pilih Jenis</option>

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

                        {{-- Mulai --}}
                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Tanggal Mulai

                            </label>

                            <input
                                type="date"
                                name="tanggal_mulai"
                                class="form-control"
                                min="{{ date('Y-m-d') }}"
                                required>

                        </div>

                        {{-- Selesai --}}
                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Tanggal Selesai

                            </label>

                            <input
                                type="date"
                                name="tanggal_selesai"
                                class="form-control"
                                min="{{ date('Y-m-d') }}"
                                required>

                        </div>

                        {{-- Alasan --}}
                        <div class="col-12">

                            <label class="form-label">

                                Alasan

                            </label>

                            <textarea
                                name="alasan"
                                rows="4"
                                class="form-control"
                                required></textarea>

                        </div>

                    </div>

                </div>

                <div class="modal-footer">

                    <button
                        type="button"
                        class="btn me-auto"
                        data-bs-dismiss="modal">

                        Batal

                    </button>

                    <button
                        type="submit"
                        class="btn btn-primary">

                        Simpan Pengajuan

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection

@push('scripts')

<script>
    function showDetail(data) {

        document.getElementById('d_nama').innerText =
            data.pegawai?.nama ?? '-';

        document.getElementById('d_nip').innerText =
            data.pegawai?.nip ?? '-';

        document.getElementById('d_jenis').innerText =
            data.jenis_pengajuan ?? '-';

        document.getElementById('d_tanggal').innerText =
            (data.tanggal_mulai ?? '-') +
            ' s/d ' +
            (data.tanggal_selesai ?? '-');

        document.getElementById('d_alasan').innerText =
            data.alasan ?? '-';

        document.getElementById('d_spv').innerText =
            data.status_spv ?? '-';

        document.getElementById('d_manager').innerText =
            data.status_manager ?? '-';

        document.getElementById('d_hrd').innerText =
            data.status_hrd ?? '-';

        new bootstrap.Modal(
            document.getElementById('modalDetail')
        ).show();
    }

    // ============================
    // VALIDASI FORM
    // ============================

    function validasiPengajuan(form) {

        let mulai =
            form.querySelector('[name=tanggal_mulai]').value;

        let selesai =
            form.querySelector('[name=tanggal_selesai]').value;

        let alasan =
            form.querySelector('[name=alasan]').value.trim();

        if (mulai > selesai) {

            alert(
                'Tanggal selesai tidak boleh lebih kecil dari tanggal mulai.'
            );

            return false;

        }

        if (alasan.length < 10) {

            alert(
                'Alasan minimal 10 karakter.'
            );

            return false;

        }

        return confirm(
            'Apakah data sudah benar?'
        );

    }


    // ============================
    // FORM TAMBAH
    // ============================

    document
        .getElementById('formTambahPengajuan')
        .addEventListener('submit', function(e) {

            if (!validasiPengajuan(this)) {

                e.preventDefault();

            }

        });


    // ============================
    // FORM EDIT
    // ============================

    document
        .querySelectorAll('.form-edit-pengajuan')
        .forEach(function(form) {

            form.addEventListener('submit', function(e) {

                if (!validasiPengajuan(this)) {

                    e.preventDefault();

                }

            });

        });


    // ============================
    // OTOMATIS UPDATE MIN TANGGAL
    // ============================

    document
        .querySelectorAll('input[name=tanggal_mulai]')
        .forEach(function(input) {

            input.addEventListener('change', function() {

                let selesai =
                    this.closest('form')
                    .querySelector('input[name=tanggal_selesai]');

                selesai.min = this.value;

            });

        });
</script>

@endpush