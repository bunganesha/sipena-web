@extends('layouts.index')

@section('title', 'Profile')

@section('page-title', 'Profile Saya')

@section('content')

<div class="row">

    {{-- ========================= --}}
    {{-- INFORMASI PROFILE --}}
    {{-- ========================= --}}

    <div class="col-md-5">

        <div class="card">

            <div class="card-body text-center">

                <span
                    class="avatar avatar-xl rounded bg-primary text-white mb-3"
                    style="font-size:30px">

                    {{ strtoupper(substr($user->pegawai->nama ?? $user->username,0,1)) }}

                </span>

                <h3 class="mb-1">

                    {{ $user->pegawai->nama ?? '-' }}

                </h3>

                <div class="text-secondary">

                    {{ strtoupper($user->role) }}

                </div>

            </div>

            <table class="table card-table table-vcenter">

                <tbody>

                    <tr>

                        <td width="35%">
                            Username
                        </td>

                        <td>

                            {{ $user->username }}

                        </td>

                    </tr>

                    <tr>

                        <td>
                            NIP
                        </td>

                        <td>

                            {{ $user->pegawai->nip ?? '-' }}

                        </td>

                    </tr>

                    <tr>

                        <td>
                            Divisi
                        </td>

                        <td>

                            {{ $user->pegawai->divisi ?? '-' }}

                        </td>

                    </tr>

                    <tr>

                        <td>
                            Jabatan
                        </td>

                        <td>

                            {{ $user->pegawai->jabatan ?? '-' }}

                        </td>

                    </tr>

                    <tr>

                        <td>
                            Sisa Cuti
                        </td>

                        <td>

                            <span class="badge bg-success">

                                {{ $user->pegawai->sisa_cuti ?? 0 }} Hari

                            </span>

                        </td>

                    </tr>

                </tbody>

            </table>

        </div>

    </div>
    {{-- ========================= --}}
    {{-- UBAH PASSWORD --}}
    {{-- ========================= --}}

    <div class="col-md-7">

        <div class="card">

            <div class="card-header">

                <h3 class="card-title">

                    Ubah Password

                </h3>

            </div>

            <form action="{{ route('profile.password') }}" method="POST">

                @csrf
                @method('PUT')

                <div class="card-body">

                    {{-- Password Lama --}}
                    <div class="mb-3">

                        <label class="form-label">

                            Password Lama

                        </label>

                        <input
                            type="password"
                            name="password_lama"
                            class="form-control"
                            required>

                    </div>

                    {{-- Password Baru --}}
                    <div class="mb-3">

                        <label class="form-label">

                            Password Baru

                        </label>

                        <input
                            type="password"
                            name="password_baru"
                            class="form-control"
                            required>

                    </div>

                    {{-- Konfirmasi --}}
                    <div class="mb-3">

                        <label class="form-label">

                            Konfirmasi Password Baru

                        </label>

                        <input
                            type="password"
                            name="password_baru_confirmation"
                            class="form-control"
                            required>

                    </div>

                </div>

                <div class="card-footer text-end">

                    <button
                        type="submit"
                        class="btn btn-primary">

                        Simpan Password

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection