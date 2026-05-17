@extends('adminlte::page')

@section('title', 'Laporan')

@section('content_header')
    <h1>Laporan Absensi</h1>
@stop

@section('content')

<div class="card">

    <div class="card-body">

        <div class="row mb-4">

            <div class="col-md-4">

                <label>Bulan</label>

                <select class="form-control">

                    <option>Januari</option>
                    <option>Februari</option>
                    <option>Maret</option>

                </select>

            </div>

            <div class="col-md-4">

                <label>Tahun</label>

                <input type="number"
                       class="form-control"
                       value="2026">

            </div>

        </div>

        <table class="table table-bordered table-hover">

            <thead class="table-dark">

                <tr>
                    <th>NIP</th>
                    <th>Nama</th>
                    <th>Hadir</th>
                    <th>Izin</th>
                    <th>Sakit</th>
                    <th>Cuti</th>
                    <th>Alfa</th>
                </tr>

            </thead>

            <tbody>

                <tr>

                    <td>1001</td>
                    <td>Putri</td>
                    <td>20</td>
                    <td>1</td>
                    <td>1</td>
                    <td>2</td>
                    <td>0</td>

                </tr>

            </tbody>

        </table>

    </div>

</div>

@stop