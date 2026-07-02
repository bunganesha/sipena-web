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

                        @php
                        $badge = match($item->status_absensi){
                        'hadir' => 'bg-success-lt text-success',
                        'izin' => 'bg-warning-lt text-warning',
                        'sakit' => 'bg-info-lt text-info',
                        'cuti' => 'bg-purple-lt text-purple',
                        'alpha' => 'bg-danger-lt text-danger',
                        default => 'bg-secondary-lt'
                        };
                        @endphp

                        <span class="badge {{ $badge }}">
                            {{ ucfirst($item->status_absensi) }}
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