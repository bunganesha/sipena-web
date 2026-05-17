@extends('adminlte::page')

@section('title', 'Data User')

@section('content_header')
    <h1>Data User</h1>
@stop

@section('content')

<div class="card">

    <div class="card-header">
        <button class="btn btn-primary">
            Tambah User
        </button>
    </div>

    <div class="card-body">

        <table class="table table-bordered table-hover">

            <thead class="table-dark">

                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Role</th>
                    <th>Aksi</th>
                </tr>

            </thead>

            <tbody>

                <tr>
                    <td>1</td>
                    <td>admin</td>
                    <td>HRD</td>

                    <td>
                        <button class="btn btn-warning btn-sm">
                            Edit
                        </button>

                        <button class="btn btn-danger btn-sm">
                            Hapus
                        </button>
                    </td>

                </tr>

            </tbody>

        </table>

    </div>

</div>

@stop