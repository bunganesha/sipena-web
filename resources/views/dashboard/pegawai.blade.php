{{-- ========================= --}}
{{-- PROFILE --}}
{{-- ========================= --}}

<div class="card mb-4">

    <div class="card-body">

        <div class="row align-items-center">

            <div class="col-md-8">

                <h2 class="mb-1">
                    Halo, {{ $pegawai->nama }}
                </h2>

                <div class="text-secondary">
                    {{ ucfirst(session('role')) }} • {{ $pegawai->divisi }}
                </div>

                <div class="mt-3">

                    <span class="badge bg-primary-lt">
                        NIP : {{ $pegawai->nip }}
                    </span>

                </div>

            </div>

            <div class="col-md-4">

                <div class="row text-center">

                    <div class="col-6">

                        <div class="text-secondary small">

                            Sisa Cuti

                        </div>

                        <div class="h1 text-success">

                            {{ $pegawai->sisa_cuti }}

                        </div>

                        <small>Hari</small>

                    </div>

                    <div class="col-6">

                        <div class="text-secondary small">

                            Kehadiran

                        </div>

                        <div class="h1 text-primary">

                            {{ $hadirSaya }}

                        </div>

                        <small>Hari</small>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>


{{-- ========================= --}}
{{-- SUMMARY --}}
{{-- ========================= --}}

<div class="row row-deck row-cards mb-4">

    <div class="col-sm-6 col-lg-3">

        <div class="card card-sm">

            <div class="card-body">

                <div class="d-flex align-items-center">

                    <span class="avatar bg-warning text-white me-3">

                        <i class="ti ti-hourglass"></i>

                    </span>

                    <div>

                        <div class="text-secondary">

                            Approval Pending

                        </div>

                        <div class="fs-1 fw-bold text-warning">

                            {{ $pendingManager }}

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <div class="col-sm-6 col-lg-3">

        <div class="card card-sm">

            <div class="card-body">

                <div class="d-flex align-items-center">

                    <span class="avatar bg-success text-white me-3">

                        <i class="ti ti-check"></i>

                    </span>

                    <div>

                        <div class="text-secondary">

                            Pengajuan Saya

                        </div>

                        <div class="fs-1 fw-bold text-success">

                            {{ $pengajuanSaya }}

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <div class="col-sm-6 col-lg-3">

        <div class="card card-sm">

            <div class="card-body">

                <div class="d-flex align-items-center">

                    <span class="avatar bg-primary text-white me-3">

                        <i class="ti ti-calendar"></i>

                    </span>

                    <div>

                        <div class="text-secondary">

                            Sisa Cuti

                        </div>

                        <div class="fs-1 fw-bold text-primary">

                            {{ $pegawai->sisa_cuti }}

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <div class="col-sm-6 col-lg-3">

        <div class="card card-sm">

            <div class="card-body">

                <div class="d-flex align-items-center">

                    <span class="avatar bg-info text-white me-3">

                        <i class="ti ti-calendar-check"></i>

                    </span>

                    <div>

                        <div class="text-secondary">

                            Kehadiran

                        </div>

                        <div class="fs-1 fw-bold text-info">

                            {{ $hadirSaya }}

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>


<div class="row">

    {{-- PROFIL --}}
    <div class="col-lg-4">

        <div class="card">

            <div class="card-body text-center">

                <span class="avatar avatar-xl bg-primary text-white mb-3">
                    {{ strtoupper(substr($pegawai->nama,0,1)) }}
                </span>

                <h3 class="mb-1">{{ $pegawai->nama }}</h3>

                <div class="text-secondary">
                    {{ $pegawai->jabatan }}
                </div>

                <div class="text-secondary">
                    {{ $pegawai->divisi }}
                </div>

                <hr>

                <div class="row">

                    <div class="col-6">

                        <div class="h2 text-success">
                            {{ $sisaCuti }}
                        </div>

                        <small class="text-secondary">
                            Sisa Cuti
                        </small>

                    </div>

                    <div class="col-6">

                        <div class="h2 text-primary">
                            {{ $hadirSaya }}
                        </div>

                        <small class="text-secondary">
                            Hadir
                        </small>

                    </div>

                </div>

            </div>

        </div>

    </div>



    {{-- PENGAJUAN --}}
    <div class="col-lg-8">

        <div class="card">

            <div class="card-header d-flex justify-content-between">

                <h3 class="card-title">

                    Pengajuan Saya

                </h3>

                <button
                    class="btn btn-primary btn-sm"
                    data-bs-toggle="modal"
                    data-bs-target="#modalTambah">

                    + Ajukan

                </button>

            </div>

            <div class="table-responsive">

                <table class="table table-vcenter">

                    <thead>

                        <tr>

                            <th>Jenis</th>
                            <th>Tanggal</th>
                            <th>Status</th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($pegawai->pengajuans as $item)

                        @php

                        if($item->status_hrd=='approved'){
                        $status='Approved';
                        $badge='success';
                        }
                        elseif(
                        $item->status_spv=='rejected' ||
                        $item->status_manager=='rejected' ||
                        $item->status_hrd=='rejected'
                        ){
                        $status='Rejected';
                        $badge='danger';
                        }
                        else{
                        $status='Pending';
                        $badge='warning';
                        }

                        @endphp

                        <tr>

                            <td>{{ ucfirst($item->jenis_pengajuan) }}</td>

                            <td>

                                {{ $item->tanggal_mulai }}

                                @if($item->tanggal_mulai != $item->tanggal_selesai)

                                <br>

                                <small class="text-secondary">

                                    s/d {{ $item->tanggal_selesai }}

                                </small>

                                @endif

                            </td>

                            <td>

                                <span class="badge bg-{{ $badge }}">

                                    {{ $status }}

                                </span>

                            </td>

                        </tr>

                        @empty

                        <tr>

                            <td colspan="3" class="text-center">

                                Belum ada pengajuan.

                            </td>

                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

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