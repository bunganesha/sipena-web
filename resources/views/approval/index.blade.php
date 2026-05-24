@extends('layouts.index')

@section('title', 'Approval Pengajuan')

@section('page-title', 'Approval Pengajuan')

@section('content')

<div class="card">

    {{-- HEADER --}}
    <div class="card-body border-bottom py-3">

        <div class="d-flex align-items-center">

            <div class="text-secondary">

                Kelola approval pengajuan cuti, izin, dan sakit pegawai

            </div>

            <div class="ms-auto text-secondary">

                <div class="input-icon">

                    <input type="text"
                           class="form-control"
                           placeholder="Search approval...">

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

                    <th>SPV</th>

                    <th>Manager</th>

                    <th>HRD</th>

                    <th>Status Final</th>

                    <th class="w-1">
                        Aksi
                    </th>

                </tr>

            </thead>

            <tbody>

                {{-- DATA SAMPLE 1 --}}
                <tr>

                    <td>

                        APR001

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

                                    Divisi IT

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


                    {{-- SPV --}}
                    <td>

                        <span class="badge bg-success-lt">

                            Approved

                        </span>

                    </td>


                    {{-- MANAGER --}}
                    <td>

                        <span class="badge bg-yellow-lt">

                            Pending

                        </span>

                    </td>


                    {{-- HRD --}}
                    <td>

                        <span class="badge bg-secondary-lt">

                            Waiting

                        </span>

                    </td>


                    {{-- STATUS FINAL --}}
                    <td>

                        <span class="badge bg-yellow text-white">

                            Process

                        </span>

                    </td>


                    {{-- AKSI --}}
                    <td>

                        <div class="btn-list flex-nowrap">

                            <button class="btn btn-success btn-sm"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modalApprove">

                                Approve

                            </button>

                            <button class="btn btn-danger btn-sm"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modalReject">

                                Reject

                            </button>

                        </div>

                    </td>

                </tr>


                {{-- DATA SAMPLE 2 --}}
                <tr>

                    <td>

                        APR002

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

                                    Divisi HRD

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

                        <span class="badge bg-success-lt">

                            Approved

                        </span>

                    </td>


                    <td>

                        <span class="badge bg-success-lt">

                            Approved

                        </span>

                    </td>


                    <td>

                        <span class="badge bg-success-lt">

                            Approved

                        </span>

                    </td>


                    <td>

                        <span class="badge bg-success text-white">

                            Approved

                        </span>

                    </td>


                    <td>

                        <a href="#"
                           class="btn btn-info btn-sm">

                            Detail

                        </a>

                    </td>

                </tr>

            </tbody>

        </table>

    </div>

</div>


{{-- MODAL APPROVE --}}
<div class="modal modal-blur fade"
     id="modalApprove"
     tabindex="-1">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <form action="#"
                  method="POST">

                @csrf

                <div class="modal-header">

                    <h5 class="modal-title">

                        Approve Pengajuan

                    </h5>

                    <button type="button"
                            class="btn-close"
                            data-bs-dismiss="modal">

                    </button>

                </div>


                <div class="modal-body">

                    <div class="mb-3">

                        <label class="form-label">

                            Catatan Approval

                        </label>

                        <textarea class="form-control"
                                  rows="4"
                                  placeholder="Masukkan catatan approval (opsional)..."></textarea>

                    </div>

                </div>


                <div class="modal-footer">

                    <button type="button"
                            class="btn me-auto"
                            data-bs-dismiss="modal">

                        Batal

                    </button>

                    <button class="btn btn-success">

                        Approve Pengajuan

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>


{{-- MODAL REJECT --}}
<div class="modal modal-blur fade"
     id="modalReject"
     tabindex="-1">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <form action="#"
                  method="POST">

                @csrf

                <div class="modal-header">

                    <h5 class="modal-title">

                        Reject Pengajuan

                    </h5>

                    <button type="button"
                            class="btn-close"
                            data-bs-dismiss="modal">

                    </button>

                </div>


                <div class="modal-body">

                    <div class="mb-3">

                        <label class="form-label">

                            Alasan Reject

                        </label>

                        <textarea class="form-control"
                                  rows="4"
                                  placeholder="Masukkan alasan penolakan..."></textarea>

                    </div>

                </div>


                <div class="modal-footer">

                    <button type="button"
                            class="btn me-auto"
                            data-bs-dismiss="modal">

                        Batal

                    </button>

                    <button class="btn btn-danger">

                        Reject Pengajuan

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection