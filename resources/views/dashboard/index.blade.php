@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard HRD</h1>
@stop

@section('content')

<div class="row">

    <div class="col-lg-3 col-6">

        <div class="small-box bg-info">

            <div class="inner">
                <h3>120</h3>
                <p>Total Pegawai</p>
            </div>

        </div>

    </div>

    <div class="col-lg-3 col-6">

        <div class="small-box bg-success">

            <div class="inner">
                <h3>100</h3>
                <p>Hadir</p>
            </div>

        </div>

    </div>

    <div class="col-lg-3 col-6">

        <div class="small-box bg-warning">

            <div class="inner">
                <h3>5</h3>
                <p>Izin</p>
            </div>

        </div>

    </div>

    <div class="col-lg-3 col-6">

        <div class="small-box bg-danger">

            <div class="inner">
                <h3>3</h3>
                <p>Alfa</p>
            </div>

        </div>

    </div>

</div>

<div class="card">

    <div class="card-header">
        <h3 class="card-title">
            Aktivitas Absensi
        </h3>
    </div>

    <div class="card-body">

        <table class="table table-bordered">

            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td>Putri</td>
                    <td>
                        <span class="badge bg-success">
                            Hadir
                        </span>
                    </td>
                    <td>17 Mei 2026</td>
                </tr>
            </tbody>

        </table>

    </div>

</div>

@stop   