@extends('adminlte::page')

@section('title', 'Import Absensi')

@section('content_header')
    <h1>Import Absensi Fingerprint</h1>
@stop

@section('content')

<div class="card">

    <div class="card-header bg-primary">

        <h3 class="card-title">
            Upload File CSV Fingerprint
        </h3>

    </div>

    <div class="card-body">

        <form action=""
              method="POST"
              enctype="multipart/form-data">

            @csrf

            <div class="form-group mb-4">

                <label>File CSV</label>

                <input type="file"
                       class="form-control">

                <small class="text-danger">
                    File harus format CSV
                </small>

            </div>

            <button class="btn btn-success">

                Import Absensi

            </button>

        </form>

    </div>

</div>

<div class="card mt-4">

    <div class="card-header bg-dark">

        <h3 class="card-title">
            Preview Data Absensi
        </h3>

    </div>

    <div class="card-body">

        <table class="table table-bordered table-hover">

            <thead class="table-dark">

                <tr>

                    <th>NIP</th>
                    <th>Nama</th>
                    <th>Tanggal</th>
                    <th>Jam Masuk</th>
                    <th>Status</th>

                </tr>

            </thead>

            <tbody>

                <tr>

                    <td>1001</td>
                    <td>Putri</td>
                    <td>17 Mei 2026</td>
                    <td>08:00</td>

                    <td>

                        <span class="badge bg-success">
                            Hadir
                        </span>

                    </td>

                </tr>

            </tbody>

        </table>

    </div>

</div>

@stop