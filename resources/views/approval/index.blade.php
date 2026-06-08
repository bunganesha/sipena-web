@extends('layouts.index')

@section('title', 'Approval Pengajuan')

@section('page-title', 'Approval Pengajuan')

@section('content')

<div class="card">

    {{-- HEADER --}}
    <div class="card-body border-bottom py-3">

        <form action="/approval"
              method="GET">

            <div class="d-flex align-items-center">

                <div class="text-secondary">

                    Kelola approval pengajuan cuti, izin, dan sakit pegawai

                </div>

                <div class="ms-auto text-secondary">

                    <div class="input-icon">

                        <input type="text"
                               name="search"
                               class="form-control"
                               placeholder="Search approval..."
                               value="{{ request('search') }}">

                    </div>

                </div>

            </div>

        </form>

    </div>


    {{-- TABLE --}}
    <div class="table-responsive">

        <table class="table table-vcenter card-table">

            <thead>

                <tr>

                    <th>ID</th>
                    <th>Pegawai</th>
                    <th>Jenis</th>
                    <th>Tanggal</th>
                    <th>SPV</th>
                    <th>Manager</th>
                    <th>HRD</th>
                    <th>Status Final</th>
                    <th class="w-1">
                        Aksi
                    </th>

                </tr>

            </thead>

            <tbody>

                @forelse($pengajuans as $item)

                <tr>

                    <td>

                        APR00{{ $item->id }}

                    </td>


                    {{-- PEGAWAI --}}
                    <td>

                        <div class="d-flex py-1 align-items-center">

                            <span class="avatar me-2 bg-primary text-white">

                                {{ strtoupper(substr($item->pegawai->nama ?? 'P',0,1)) }}

                            </span>

                            <div class="flex-fill">

                                <div class="font-weight-medium">

                                    {{ $item->pegawai->nama ?? '-' }}

                                </div>

                                <div class="text-secondary">

                                    Divisi {{ $item->pegawai->divisi ?? '-' }}

                                </div>

                            </div>

                        </div>

                    </td>


                    {{-- JENIS --}}
                    <td>

                       <span class="badge bg-warning-lt text-warning">

                            {{ ucfirst($item->jenis_pengajuan) }}

                        </span>

                    </td>


                    {{-- TANGGAL --}}
                    <td>

                        {{ $item->tanggal_mulai }}

                    </td>


                    {{-- SPV --}}
                    <td>

                        @if($item->status_spv == 'approved')

                            <span class="badge bg-success-lt">
                                Approved
                            </span>

                        @elseif($item->status_spv == 'rejected')

                            <span class="badge bg-danger-lt">
                                Rejected
                            </span>

                        @else

                            <span class="badge bg-yellow-lt">
                                Process
                            </span>

                        @endif

                    </td>


                    {{-- MANAGER --}}
                    <td>

                        @if($item->status_manager == 'approved')

                            <span class="badge bg-success-lt">
                                Approved
                            </span>

                        @elseif($item->status_manager == 'rejected')

                            <span class="badge bg-danger-lt">
                                Rejected
                            </span>

                        @else

                            <span class="badge bg-yellow-lt">
                                Process
                            </span>

                        @endif

                    </td>


                    {{-- HRD --}}
                    <td>

                        @if($item->status_hrd == 'approved')

                            <span class="badge bg-success-lt">
                                Approved
                            </span>

                        @elseif($item->status_hrd == 'rejected')

                            <span class="badge bg-danger-lt">
                                Rejected
                            </span>

                        @else

                            <span class="badge bg-secondary-lt">
                                Waiting
                            </span>

                        @endif

                    </td>


                    {{-- STATUS FINAL --}}
                    <td>

                        @if(
                            $item->status_spv == 'approved' &&
                            $item->status_manager == 'approved' &&
                            $item->status_hrd == 'approved'
                        )

                            <span class="badge bg-success text-white">
                                Approved
                            </span>

                        @elseif(
                            $item->status_spv == 'rejected' ||
                            $item->status_manager == 'rejected' ||
                            $item->status_hrd == 'rejected'
                        )

                            <span class="badge bg-danger text-white">
                                Rejected
                            </span>

                        @else

                            <span class="badge bg-yellow text-white">
                                Process
                            </span>

                        @endif

                    </td>


                    {{-- AKSI --}}
                    <td>

                        <div class="btn-list flex-nowrap">

                            {{-- APPROVE --}}
                            <form action="/approval/{{ $item->id }}"
                                  method="POST">

                                @csrf
                                @method('PUT')

                                <input type="hidden"
                                       name="status"
                                       value="Approved">

                                <button class="btn btn-success btn-sm">

                                    Approve

                                </button>

                            </form>


                            {{-- REJECT --}}
                            <form action="/approval/{{ $item->id }}"
                                  method="POST">

                                @csrf
                                @method('PUT')

                                <input type="hidden"
                                       name="status"
                                       value="Rejected">

                                <button class="btn btn-danger btn-sm">

                                    Reject

                                </button>

                            </form>

                        </div>

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="9"
                        class="text-center">

                        Data pengajuan kosong

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection