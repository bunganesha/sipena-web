@extends('adminlte::page')

@section('title', 'Pengajuan Cuti')

@section('content_header')
    <h1>Pengajuan Cuti</h1>
@stop

@section('content')

<div class="card">

    <div class="card-body">

        <form>

            <div class="form-group mb-3">

                <label>Tanggal Mulai</label>

                <input type="date"
                       class="form-control">

            </div>

            <div class="form-group mb-3">

                <label>Tanggal Selesai</label>

                <input type="date"
                       class="form-control">

            </div>

            <div class="form-group mb-3">

                <label>Alasan</label>

                <textarea class="form-control"></textarea>

            </div>

            <div class="alert alert-info">

                Jatah cuti maksimal:
                <b>3 hari / tahun</b>

            </div>

            <button class="btn btn-primary">
                Ajukan Cuti
            </button>

        </form>

    </div>

</div>

@stop