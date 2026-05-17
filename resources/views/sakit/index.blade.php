@extends('adminlte::page')

@section('title', 'Pengajuan Sakit')

@section('content_header')
    <h1>Pengajuan Sakit</h1>
@stop

@section('content')

<div class="card">

    <div class="card-body">

        <form>

            <div class="form-group mb-3">

                <label>Tanggal</label>

                <input type="date"
                       class="form-control">

            </div>

            <div class="form-group mb-3">

                <label>Keterangan Sakit</label>

                <textarea class="form-control"></textarea>

            </div>

            <div class="form-group mb-3">

                <label>Upload Surat Dokter</label>

                <input type="file"
                       class="form-control">

            </div>

            <button class="btn btn-danger">
                Ajukan Sakit
            </button>

        </form>

    </div>

</div>

@stop