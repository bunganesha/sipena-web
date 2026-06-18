@extends('layouts.index')

@section('title', 'Absensi Saya')

@section('page-title', 'Absensi Saya')

@section('content')

<div class="card">

    <div class="card-header">
        <h3 class="card-title">Riwayat Absensi Saya</h3>
    </div>

    <div class="table-responsive">

        <table class="table table-vcenter card-table">

            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Jam Masuk</th>
                    <th>Jam Keluar</th>
                    <th>Status</th>
                    <th>Keterangan</th>
                </tr>
            </thead>

            <tbody>

                @forelse($data as $item)

                <tr>
                    <td>{{ $item->tanggal }}</td>
                    <td>{{ $item->jam_masuk ?? '-' }}</td>
                    <td>{{ $item->jam_keluar ?? '-' }}</td>
                    <td>
                        <span class="badge bg-primary-lt">
                            {{ $item->status_absensi }}
                        </span>
                    </td>
                    <td>{{ $item->keterangan ?? '-' }}</td>
                </tr>

                @empty

                <tr>
                    <td colspan="5" class="text-center text-secondary">
                        Belum ada data absensi
                    </td>
                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection