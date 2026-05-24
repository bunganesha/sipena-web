@extends('layouts.index')

@section('content')

<form action="{{ route('user.store') }}" method="POST">
@csrf

<div class="card">
    <div class="card-body">

        <input type="text" name="username" class="form-control mb-2" placeholder="Username" required>

        <input type="password" name="password" class="form-control mb-2" placeholder="Password" required>

        <select name="role" class="form-select mb-2">
            <option value="hrd">HRD</option>
            <option value="spv">SPV</option>
            <option value="manager">Manager</option>
            <option value="pegawai">Pegawai</option>
        </select>

        <select name="id_pegawai" class="form-select mb-2">
            <option value="">Pilih Pegawai</option>
            @foreach($pegawais as $pegawai)
                <option value="{{ $pegawai->id }}">
                    {{ $pegawai->nama }}
                </option>
            @endforeach
        </select>

        <button class="btn btn-primary">Simpan</button>

    </div>
</div>

</form>

@endsection