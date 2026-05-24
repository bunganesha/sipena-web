@extends('layouts.index')

@section('title', 'Data Pegawai')

@section('page-title', 'Data Pegawai')

@section('page-action')

<button class="btn btn-primary"
        data-bs-toggle="modal"
        data-bs-target="#modalPegawai">

    + Tambah Pegawai

</button>

@endsection

@section('content')

<div class="card">

    {{-- HEADER --}}
    <div class="card-body border-bottom py-3">

        <div class="d-flex align-items-center">

            <div class="text-secondary">
                Data seluruh pegawai perusahaan
            </div>

            <div class="ms-auto text-secondary">

                <div class="input-icon">

                    <input type="text"
                           class="form-control"
                           placeholder="Search pegawai...">

                </div>

            </div>

        </div>

    </div>

    {{-- TABLE --}}
    <div class="table-responsive">

        <table class="table table-vcenter card-table">

            <thead>

                <tr>

                    <th>NIP</th>

                    <th>Nama Pegawai</th>

                    <th>Jabatan</th>

                    <th>Divisi</th>

                    <th>Status</th>

                    <th>Jatah Cuti</th>

                    <th>Sisa Cuti</th>

                    <th class="w-1">
                        Aksi
                    </th>

                </tr>

            </thead>

            <tbody>

                @forelse($pegawai as $p)

                <tr>

                    {{-- NIP --}}
                    <td>

                        {{ $p->nip }}

                    </td>


                    {{-- NAMA --}}
                    <td>

                        <div class="d-flex py-1 align-items-center">

                            <span class="avatar me-2 bg-primary text-white">

                                {{ strtoupper(substr($p->nama, 0, 1)) }}

                            </span>

                            <div class="flex-fill">

                                <div class="font-weight-medium">

                                    {{ $p->nama }}

                                </div>

                            </div>

                        </div>

                    </td>


                    {{-- JABATAN --}}
                    <td>

                        {{ $p->jabatan }}

                    </td>


                    {{-- DIVISI --}}
                    <td>

                        <span class="badge bg-blue-lt">

                            {{ $p->divisi }}

                        </span>

                    </td>


                    {{-- STATUS --}}
                    <td>

                        <span class="badge bg-success-lt">

                            Aktif

                        </span>

                    </td>


                    {{-- JATAH CUTI --}}
                    <td>

                        <span class="badge bg-success-lt">

                            {{ $p->jatah_cuti }} Hari

                        </span>

                    </td>


                    {{-- SISA CUTI --}}
                    <td>

                        <span class="badge bg-warning-lt">

                            3 Hari

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

                @empty

                <tr>

                    <td colspan="8"
                        class="text-center text-secondary py-5">

                        Belum ada data pegawai

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>


{{-- MODAL TAMBAH PEGAWAI --}}
<div class="modal modal-blur fade"
     id="modalPegawai"
     tabindex="-1">

    <div class="modal-dialog modal-lg modal-dialog-centered">

        <div class="modal-content">

            <form action="/pegawai/store"
                  method="POST">

                @csrf

                {{-- HEADER --}}
                <div class="modal-header">

                    <h5 class="modal-title">

                        Tambah Pegawai

                    </h5>

                    <button type="button"
                            class="btn-close"
                            data-bs-dismiss="modal">

                    </button>

                </div>


                {{-- BODY --}}
                <div class="modal-body">

                    <div class="row">

                        {{-- NIP --}}
                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                NIP

                            </label>

                            <input type="text"
                                   name="nip"
                                   class="form-control"
                                   required>

                        </div>


                        {{-- NAMA --}}
                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Nama Pegawai

                            </label>

                            <input type="text"
                                   name="nama"
                                   class="form-control"
                                   required>

                        </div>


                        {{-- JABATAN --}}
                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Jabatan

                            </label>

                            <input type="text"
                                   name="jabatan"
                                   class="form-control"
                                   required>

                        </div>


                        {{-- DIVISI --}}
                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Divisi

                            </label>

                            <input type="text"
                                   name="divisi"
                                   class="form-control"
                                   required>

                        </div>


                        {{-- STATUS --}}
                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Status Pegawai

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


                        {{-- JATAH CUTI --}}
                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Jatah Cuti

                            </label>

                            <input type="number"
                                   name="jatah_cuti"
                                   class="form-control"
                                   value="3">

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

                        Simpan Pegawai

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection