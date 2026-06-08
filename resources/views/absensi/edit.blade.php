@extends('layouts.index')

@section('title', 'Edit Absensi')

@section('page-title', 'Edit Absensi')

@section('content')

<div class="card">

    <div class="card-body">

        <form action="/absensi/{{ $absensi->id }}"
              method="POST">

            @csrf
            @method('PUT')

            <div class="row">

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Pegawai

                    </label>

                    <select name="pegawai_id"
                            class="form-select">

                        @foreach($pegawais as $pegawai)

                        <option value="{{ $pegawai->id }}"
                            {{ $pegawai->id == $absensi->pegawai_id ? 'selected' : '' }}>

                            {{ $pegawai->nama }}

                        </option>

                        @endforeach

                    </select>

                </div>


                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Tanggal

                    </label>

                    <input type="date"
                           name="tanggal"
                           class="form-control"
                           value="{{ $absensi->tanggal }}">

                </div>


                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Jam Masuk

                    </label>

                    <input type="time"
                           name="jam_masuk"
                           class="form-control"
                           value="{{ $absensi->jam_masuk }}">

                </div>


                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Jam Keluar

                    </label>

                    <input type="time"
                           name="jam_keluar"
                           class="form-control"
                           value="{{ $absensi->jam_keluar }}">

                </div>


                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Status

                    </label>

                    <select name="status_absensi"
                            class="form-select">

                        <option value="hadir">
                            Hadir
                        </option>

                        <option value="izin">
                            Izin
                        </option>

                        <option value="sakit">
                            Sakit
                        </option>

                        <option value="cuti">
                            Cuti
                        </option>

                        <option value="alpha">
                            Alpha
                        </option>

                    </select>

                </div>


                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Keterangan

                    </label>

                    <input type="text"
                           name="keterangan"
                           class="form-control"
                           value="{{ $absensi->keterangan }}">

                </div>

            </div>


            <button class="btn btn-primary">

                Update Absensi

            </button>

        </form>

    </div>

</div>

@endsection