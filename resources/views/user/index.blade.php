@extends('layouts.index')

@section('title', 'Data User')

@section('page-title', 'Data User')

@section('page-action')

<button class="btn btn-primary"
        data-bs-toggle="modal"
        data-bs-target="#modalUser">

    + Tambah User

</button>

@endsection

@section('content')

<div class="card">

    {{-- HEADER --}}
    <div class="card-body border-bottom py-3">

        <div class="d-flex align-items-center">

            <div class="text-secondary">

                Kelola akun pengguna SIPENA

            </div>

            <div class="ms-auto text-secondary">

                <div class="input-icon">

                    <input type="text"
                           class="form-control"
                           placeholder="Search user...">

                </div>

            </div>

        </div>

    </div>


    {{-- TABLE --}}
    <div class="table-responsive">

        <table class="table table-vcenter card-table">

            <thead>

                <tr>

                    <th>ID User</th>

                    <th>Username</th>

                    <th>Pegawai</th>

                    <th>Role</th>

                    <th>Status</th>

                    <th class="w-1">
                        Aksi
                    </th>

                </tr>

            </thead>

            <tbody>

                {{-- SAMPLE DATA --}}
                <tr>

                    <td>

                        USR001

                    </td>


                    {{-- USERNAME --}}
                    <td>

                        <div class="d-flex py-1 align-items-center">

                            <span class="avatar me-2 bg-primary text-white">

                                A

                            </span>

                            <div class="flex-fill">

                                <div class="font-weight-medium">

                                    admin.hrd

                                </div>

                            </div>

                        </div>

                    </td>


                    {{-- PEGAWAI --}}
                    <td>

                        Admin HRD

                    </td>


                    {{-- ROLE --}}
                    <td>

                        <span class="badge bg-blue-lt">

                            HRD

                        </span>

                    </td>


                    {{-- STATUS --}}
                    <td>

                        <span class="badge bg-success-lt">

                            Aktif

                        </span>

                    </td>


                    {{-- AKSI --}}
                    <td>

                        <div class="btn-list flex-nowrap">

                            <a href="#"
                               class="btn btn-warning btn-sm">

                                Edit

                            </a>

                            <a href="#"
                               class="btn btn-danger btn-sm">

                                Hapus

                            </a>

                        </div>

                    </td>

                </tr>


                {{-- SAMPLE DATA --}}
                <tr>

                    <td>

                        USR002

                    </td>


                    <td>

                        <div class="d-flex py-1 align-items-center">

                            <span class="avatar me-2 bg-success text-white">

                                S

                            </span>

                            <div class="flex-fill">

                                <div class="font-weight-medium">

                                    spv.produksi

                                </div>

                            </div>

                        </div>

                    </td>


                    <td>

                        Siti Aisyah

                    </td>


                    <td>

                        <span class="badge bg-warning-lt">

                            SPV

                        </span>

                    </td>


                    <td>

                        <span class="badge bg-success-lt">

                            Aktif

                        </span>

                    </td>


                    <td>

                        <div class="btn-list flex-nowrap">

                            <a href="#"
                               class="btn btn-warning btn-sm">

                                Edit

                            </a>

                            <a href="#"
                               class="btn btn-danger btn-sm">

                                Hapus

                            </a>

                        </div>

                    </td>

                </tr>

            </tbody>

        </table>

    </div>

</div>


{{-- MODAL TAMBAH USER --}}
<div class="modal modal-blur fade"
     id="modalUser"
     tabindex="-1">

    <div class="modal-dialog modal-lg modal-dialog-centered">

        <div class="modal-content">

            <form action="#"
                  method="POST">

                @csrf

                {{-- HEADER --}}
                <div class="modal-header">

                    <h5 class="modal-title">

                        Tambah User

                    </h5>

                    <button type="button"
                            class="btn-close"
                            data-bs-dismiss="modal">

                    </button>

                </div>


                {{-- BODY --}}
                <div class="modal-body">

                    <div class="row">

                        {{-- USERNAME --}}
                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Username

                            </label>

                            <input type="text"
                                   name="username"
                                   class="form-control"
                                   required>

                        </div>


                        {{-- PASSWORD --}}
                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Password

                            </label>

                            <input type="password"
                                   name="password"
                                   class="form-control"
                                   required>

                        </div>


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


                        {{-- ROLE --}}
                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Role

                            </label>

                            <select name="role"
                                    class="form-select">

                                <option value="HRD">

                                    HRD

                                </option>

                                <option value="SPV">

                                    SPV

                                </option>

                                <option value="Manager">

                                    Manager

                                </option>

                                <option value="Pegawai">

                                    Pegawai

                                </option>

                            </select>

                        </div>


                        {{-- STATUS --}}
                        <div class="col-md-12 mb-3">

                            <label class="form-label">

                                Status User

                            </label>

                            <select name="status"
                                    class="form-select">

                                <option value="Aktif">

                                    Aktif

                                </option>

                                <option value="Nonaktif">

                                    Nonaktif

                                </option>

                            </select>

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

                        Simpan User

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection