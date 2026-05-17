@extends('adminlte::page')

@section('title', 'Pengajuan Izin')

@section('content_header')
    <h1>Pengajuan Izin</h1>
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

                <label>Alasan Izin</label>

                <textarea class="form-control"></textarea>

            </div>

            <button class="btn btn-primary">
                Ajukan Izin
            </button>

        </form>

    </div>

</div>

@stop