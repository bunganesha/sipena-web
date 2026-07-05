@extends('layouts.index')

@section('title','Riwayat Approval')

@section('page-title','Riwayat Approval')

@section('content')

<div class="card">

    <div class="card-header">

        <div class="row w-100">

            <div class="col-md-6">

                <h3 class="card-title">

                    Riwayat Approval Saya

                </h3>

            </div>

            <div class="col-md-6">

                <form method="GET">

                    <div class="input-group">

                        <input
                            type="text"
                            name="search"
                            class="form-control"
                            placeholder="Cari nama atau NIP..."
                            value="{{ request('search') }}">

                        <button class="btn btn-primary">

                            Cari

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

    <div class="table-responsive">

        <table class="table table-vcenter table-hover">

            <thead>

                <tr>

                    <th>NIP</th>

                    <th>Nama Pegawai</th>

                    <th>Jenis</th>

                    <th>Tanggal</th>

                    <th>Status</th>

                    <th>Aksi</th>

                </tr>

            </thead>

            <tbody>

                @forelse($pengajuans as $item)

                <tr>

                    <td>

                        {{ $item->pegawai->nip }}

                    </td>

                    <td>

                        {{ $item->pegawai->nama }}

                    </td>

                    <td>

                        {{ ucfirst($item->jenis_pengajuan) }}

                    </td>

                    <td>

                        {{ \Carbon\Carbon::parse($item->tanggal_mulai)->format('d M Y') }}

                        <br>

                        <small class="text-secondary">

                            s/d

                            {{ \Carbon\Carbon::parse($item->tanggal_selesai)->format('d M Y') }}

                        </small>

                    </td>

                    <td>

                        @if(session('role')=='spv')

                        @php
                        $status = $item->status_spv;
                        @endphp

                        @elseif(session('role')=='manager')

                        @php
                        $status = $item->status_manager;
                        @endphp

                        @else

                        @php
                        $status = $item->status_hrd;
                        @endphp

                        @endif

                        @if($status=='approved')

                        <span class="badge bg-success-lt">

                            Disetujui

                        </span>

                        @else

                        <span class="badge bg-danger-lt">

                            Ditolak

                        </span>

                        @endif

                    </td>

                    <td>

                        <button

                            class="btn btn-sm btn-primary btn-detail"

                            data-id="{{ $item->id }}">

                            Detail

                        </button>

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="6" class="text-center">

                        Belum ada riwayat approval.

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@include('approval.detail-modal')

@endsection