@extends('adminlte::page')

@section('title', 'Approval')

@section('content_header')
    <h1>Approval Pengajuan</h1>
@stop

@section('content')

<div class="card">

    <div class="card-body">

        <table class="table table-bordered table-hover">

            <thead class="table-dark">

                <tr>
                    <th>Nama</th>
                    <th>Jenis</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>

            </thead>

            <tbody>

                <tr>

                    <td>Putri</td>
                    <td>Cuti</td>
                    <td>17 Mei 2026</td>

                    <td>
                        <span class="badge bg-warning">
                            Pending
                        </span>
                    </td>

                    <td>

                        <button class="btn btn-success btn-sm">
                            Approve
                        </button>

                        <button class="btn btn-danger btn-sm">
                            Reject
                        </button>

                    </td>

                </tr>

            </tbody>

        </table>

    </div>

</div>

@stop