@extends('adminlte::page')

@section('title', 'Data Pegawai')

@section('content_header')
    <h1>Data Pegawai</h1>
@stop

@section('content')

<div class="card">

    <div class="card-header">

        <button class="btn btn-primary"
                data-toggle="modal"
                data-target="#modalPegawai">

            Tambah Pegawai

        </button>

    </div>

    <div class="card-body">

        <table class="table table-bordered">

            <thead class="table-dark">

                <tr>
                    <th>NIP</th>
                    <th>Nama</th>
                    <th>Jabatan</th>
                    <th>Divisi</th>
                    <th>Jatah Cuti</th>
                </tr>

            </thead>

            <tbody>

                @foreach($pegawai as $p)

                <tr>

                    <td>{{ $p->nip }}</td>
                    <td>{{ $p->nama }}</td>
                    <td>{{ $p->jabatan }}</td>
                    <td>{{ $p->divisi }}</td>
                    <td>{{ $p->jatah_cuti }} Hari</td>

                </tr>

                @endforeach

            </tbody>

        </table>

    </div>

</div>

<div class="modal fade"
     id="modalPegawai">

    <div class="modal-dialog">

        <div class="modal-content">

            <form action="/pegawai/store"
                  method="POST">

                @csrf

                <div class="modal-header bg-primary">

                    <h5 class="modal-title">
                        Tambah Pegawai
                    </h5>

                </div>

                <div class="modal-body">

                    <div class="form-group mb-3">

                        <label>NIP</label>

                        <input type="text"
                               name="nip"
                               class="form-control">

                    </div>

                    <div class="form-group mb-3">

                        <label>Nama</label>

                        <input type="text"
                               name="nama"
                               class="form-control">

                    </div>

                    <div class="form-group mb-3">

                        <label>Jabatan</label>

                        <input type="text"
                               name="jabatan"
                               class="form-control">

                    </div>

                    <div class="form-group mb-3">

                        <label>Divisi</label>

                        <input type="text"
                               name="divisi"
                               class="form-control">

                    </div>

                    <div class="form-group mb-3">

                        <label>Jatah Cuti</label>

                        <input type="number"
                               name="jatah_cuti"
                               class="form-control"
                               value="3">

                    </div>

                </div>

                <div class="modal-footer">

                    <button class="btn btn-primary">
                        Simpan
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@stop