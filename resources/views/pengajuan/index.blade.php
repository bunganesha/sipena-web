@extends('layouts.index')

@section('title', 'Pengajuan')

@section('page-title', 'Data Pengajuan')

@section('page-action')

<button class="btn btn-primary"
        data-bs-toggle="modal"
        data-bs-target="#modalPengajuan">

    + Buat Pengajuan

</button>

@endsection

@section('content')

<div class="card">

    {{-- HEADER --}}
    <div class="card-body border-bottom py-3">

        <div class="d-flex align-items-center">

            <div class="text-secondary">

                Kelola pengajuan cuti, izin, dan sakit pegawai

            </div>

            <div class="ms-auto text-secondary">

                <div class="input-icon">

                    <input type="text"
                           class="form-control"
                           placeholder="Search pengajuan...">

                </div>

            </div>

        </div>

    </div>


    {{-- TABLE --}}
    <div class="table-responsive">

        <table class="table table-vcenter card-table">

            <thead>

                <tr>

                    <th>ID</th>

                    <th>Pegawai</th>

                    <th>Jenis</th>

                    <th>Tanggal</th>

                    <th>Durasi</th>

                    <th>Status</th>

                    <th>Approval</th>

                    <th class="w-1">
                        Aksi
                    </th>

                </tr>

            </thead>

            <tbody>

                {{-- SAMPLE DATA --}}
                <tr>

                    <td>

                        PGJ001

                    </td>


                    {{-- PEGAWAI --}}
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

                                    IT Division

                                </div>

                            </div>

                        </div>

                    </td>


                    {{-- JENIS --}}
                    <td>

                        <span class="badge bg-warning-lt">

                            Cuti

                        </span>

                    </td>


                    {{-- TANGGAL --}}
                    <td>

                        20 Mei 2026

                    </td>


                    {{-- DURASI --}}
                    <td>

                        2 Hari

                    </td>


                    {{-- STATUS --}}
                    <td>

                        <span class="badge bg-yellow text-white">

                            Pending

                        </span>

                    </td>


                    {{-- APPROVAL --}}
                    <td>

                        <div class="text-secondary">

                            SPV Pending

                        </div>

                    </td>


                    {{-- AKSI --}}
                    <td>

                        <div class="btn-list flex-nowrap">

                            <a href="#"
                               class="btn btn-info btn-sm">

                                Detail

                            </a>

                        </div>

                    </td>

                </tr>


                {{-- SAMPLE DATA --}}
                <tr>

                    <td>

                        PGJ002

                    </td>


                    <td>

                        <div class="d-flex py-1 align-items-center">

                            <span class="avatar me-2 bg-success text-white">

                                S

                            </span>

                            <div class="flex-fill">

                                <div class="font-weight-medium">

                                    Siti Aisyah

                                </div>

                                <div class="text-secondary">

                                    HRD Division

                                </div>

                            </div>

                        </div>

                    </td>


                    <td>

                        <span class="badge bg-danger-lt">

                            Sakit

                        </span>

                    </td>


                    <td>

                        18 Mei 2026

                    </td>


                    <td>

                        1 Hari

                    </td>


                    <td>

                        <span class="badge bg-success text-white">

                            Approved

                        </span>

                    </td>


                    <td>

                        <div class="text-success">

                            HRD Approved

                        </div>

                    </td>


                    <td>

                        <div class="btn-list flex-nowrap">

                            <a href="#"
                               class="btn btn-info btn-sm">

                                Detail

                            </a>

                        </div>

                    </td>

                </tr>

            </tbody>

        </table>

    </div>

</div>


{{-- MODAL TAMBAH PENGAJUAN --}}
<div class="modal modal-blur fade"
     id="modalPengajuan"
     tabindex="-1">

    <div class="modal-dialog modal-lg modal-dialog-centered">

        <div class="modal-content">

            <form action="#"
                  method="POST">

                @csrf

                {{-- HEADER --}}
                <div class="modal-header">

                    <h5 class="modal-title">

                        Buat Pengajuan

                    </h5>

                    <button type="button"
                            class="btn-close"
                            data-bs-dismiss="modal">

                    </button>

                </div>


                {{-- BODY --}}
                <div class="modal-body">

                    <div class="row">

                        {{-- PEGAWAI --}}
                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Pegawai

                            </label>

                            <select name="pegawai"
                                    class="form-select">

                                <option>

                                    Pilih Pegawai

                                </option>

                                <option>

                                    Budi Santoso

                                </option>

                                <option>

                                    Siti Aisyah

                                </option>

                            </select>

                        </div>


                        {{-- JENIS --}}
                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Jenis Pengajuan

                            </label>

                            <select name="jenis_pengajuan"
                                    class="form-select">

                                <option value="Cuti">

                                    Cuti

                                </option>

                                <option value="Izin">

                                    Izin

                                </option>

                                <option value="Sakit">

                                    Sakit

                                </option>

                            </select>

                        </div>


                        {{-- TANGGAL MULAI --}}
                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Tanggal Mulai

                            </label>

                            <input type="date"
                                   name="tanggal_mulai"
                                   class="form-control">

                        </div>


                        {{-- TANGGAL SELESAI --}}
                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Tanggal Selesai

                            </label>

                            <input type="date"
                                   name="tanggal_selesai"
                                   class="form-control">

                        </div>


                        {{-- ALASAN --}}
                        <div class="col-md-12 mb-3">

                            <label class="form-label">

                                Alasan Pengajuan

                            </label>

                            <textarea name="alasan"
                                      rows="4"
                                      class="form-control"
                                      placeholder="Masukkan alasan pengajuan..."></textarea>

                        </div>

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

                        Simpan Pengajuan

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection