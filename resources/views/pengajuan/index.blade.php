@extends('layouts.app')

@section('content')

<h2 class="mb-4">
    Pengajuan
</h2>

<div class="card p-4 border-0 shadow-sm rounded-4">

    <form>

        <div class="mb-3">

            <label>Jenis Pengajuan</label>

            <select class="form-select">

                <option>Cuti</option>
                <option>Izin</option>
                <option>Sakit</option>

            </select>

        </div>

        <div class="mb-3">

            <label>Tanggal</label>

            <input type="date"
                   class="form-control">

        </div>

        <div class="mb-3">

            <label>Alasan</label>

            <textarea class="form-control"></textarea>

        </div>

        <button class="btn btn-primary">
            Kirim Pengajuan
        </button>

    </form>

</div>

@endsection