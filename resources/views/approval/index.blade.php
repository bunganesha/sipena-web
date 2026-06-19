@extends('layouts.index')

@section('title', 'Approval Pengajuan')

@section('page-title', 'Approval Pengajuan')

@section('content')

<div class="card">
    {{-- HEADER --}}
    <div class="card-body border-bottom py-3">

        <div class="d-flex align-items-center">

            <div class="text-secondary">

                Kelola approval pengajuan cuti, izin, dan sakit pegawai

            </div>

            <div class="ms-auto text-secondary">

                <form method="GET" action="/approval">

                    <div class="input-icon">

                        <input type="text" name="search" class="form-control" placeholder="Search approval..."
                            value="{{ request('search') }}">

                    </div>

                </form>

            </div>

        </div>

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

                    <th>Durasi</th>

                    <th>SPV</th>

                    <th>Manager</th>

                    <th>HRD</th>

                    <th>Status Final</th>

                    <th>ALASAN</th>

                    <th class="w-1">
                        Aksi
                    </th>

                </tr>


            </thead>

            <tbody>

                @forelse ($pengajuans as $item)
                <tr>

                    {{-- ID --}}
                    <td>

                        APR00{{ $item->id }}

            
                    </td>


                    {{-- PEGAWAI --}}
                    <td>

                        <div class="d-flex py-1 align-items-center">

                            <span class="avatar me-2 bg-primary text-white">

                                {{ substr(optional($item->pegawai)->nama ?? 'P',0,1) }}

                            </span>

                            <div class="flex-fill">

                                <div class="font-weight-medium">

                                    {{ optional($item->pegawai)->nama ?? '-' }}

                                </div>

                                <div class="text-secondary">

                                    {{ optional($item->pegawai)->divisi ?? '-' }}

                                </div>

                            </div>

                        </div>


                    </td>
                    {{-- JENIS --}}
                    <td>

                        @if ($item->jenis_pengajuan == 'Cuti')
                        <span class="badge bg-warning-lt">

                            {{ $item->jenis_pengajuan }}

                        </span>
                        @elseif($item->jenis_pengajuan == 'Sakit')
                        <span class="badge bg-danger-lt">

                            {{ $item->jenis_pengajuan }}

                        </span>
                        @else
                        <span class="badge bg-primary-lt">

                            {{ $item->jenis_pengajuan }}

                        </span>
                        @endif

                    </td>


                    {{-- TANGGAL --}}
                    <td>

                        {{ $item->tanggal_mulai ?? '-' }}

                    </td>


                    {{-- DURASI --}}
                    <td>

                        {{ $item->durasi ?? '-' }}

                    </td>

                    {{-- SPV --}}
                    <td>

                        @if (($item->status_spv ?? '') == 'approved')
                        <span class="badge bg-success-lt">
                            Approved
                        </span>
                        @elseif(($item->status_spv ?? '') == 'rejected')
                        <span class="badge bg-danger-lt">
                            Rejected
                        </span>
                        @else
                        <span class="badge bg-yellow-lt">
                            Pending
                        </span>
                        @endif

                    </td>

                    {{-- MANAGER --}}
                    <td>

                        @if (($item->status_manager ?? '') == 'approved')
                        <span class="badge bg-success-lt">
                            Approved
                        </span>
                        @elseif(($item->status_manager ?? '') == 'rejected')
                        <span class="badge bg-danger-lt">
                            Rejected
                        </span>
                        @else
                        <span class="badge bg-yellow-lt">
                            Pending
                        </span>
                        @endif

                    </td>

                    {{-- HRD --}}
                    <td>

                        @if (($item->status_hrd ?? '') == 'approved')
                        <span class="badge bg-success-lt">
                            Approved
                        </span>
                        @elseif(($item->status_hrd ?? '') == 'rejected')
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

                        @if (
                        $item->status_spv == 'approved' &&
                        $item->status_manager == 'approved' &&
                        $item->status_hrd == 'approved'
                        )

                        <span class="badge bg-success text-white">
                            Approved
                        </span>

                        @elseif (
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

                    {{-- ALASAN --}}
                    <td>
                        {{ $item->alasan }}
                    </td>

                    {{-- AKSI --}}

                    <td>

                        <div class="btn-list flex-nowrap">

                            {{-- SPV --}}
                            @if (
                            session('role') == 'spv' &&
                            $item->status_spv == 'pending'
                            )

                            <form action="/approval/{{ $item->id }}" method="POST">
                                @csrf
                                @method('PUT')

                                <input type="hidden" name="status" value="Approved">

                                <button class="btn btn-success btn-sm">
                                    Approve
                                </button>
                            </form>

                            <form action="/approval/{{ $item->id }}" method="POST">
                                @csrf
                                @method('PUT')

                                <input type="hidden" name="status" value="Rejected">

                                <button class="btn btn-danger btn-sm">
                                    Reject
                                </button>
                            </form>

                            @endif


                            {{-- MANAGER --}}
                            @if (
                            session('role') == 'manager' &&
                            $item->status_spv == 'approved' &&
                            $item->status_manager == 'pending'
                            )

                            <form action="/approval/{{ $item->id }}" method="POST">
                                @csrf
                                @method('PUT')

                                <input type="hidden" name="status" value="Approved">

                                <button class="btn btn-success btn-sm">
                                    Approve
                                </button>
                            </form>

                            <form action="/approval/{{ $item->id }}" method="POST">
                                @csrf
                                @method('PUT')

                                <input type="hidden" name="status" value="Rejected">

                                <button class="btn btn-danger btn-sm">
                                    Reject
                                </button>
                            </form>

                            @endif


                            {{-- HRD --}}
                            @if (
                        session('role') == 'hrd' &&
                        $item->status_spv == 'approved' &&
                        $item->status_manager == 'approved' &&
                        $item->status_hrd == 'pending'
                        )

                            <form action="/approval/{{ $item->id }}" method="POST">
                                @csrf
                                @method('PUT')

                                <input type="hidden" name="status" value="Approved">

                                <button class="btn btn-success btn-sm">
                                    Approve
                                </button>
                            </form>

                            <form action="/approval/{{ $item->id }}" method="POST">
                                @csrf
                                @method('PUT')

                                <input type="hidden" name="status" value="Rejected">

                                <button class="btn btn-danger btn-sm">
                                    Reject
                                </button>
                            </form>

                            @endif

                        </div>

                    </td>
                </tr>

                @empty


                <tr>

                    <td colspan="11" class="text-center text-secondary py-4">

                        Belum ada data pengajuan

                    </td>

                </tr>
                @endforelse

            </tbody>

        </table>

    </div>

</div>


{{-- MODAL APPROVE --}}
<div class="modal modal-blur fade" id="modalApprove" tabindex="-1">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <form action="#" method="POST">

                @csrf

                <div class="modal-header">

                    <h5 class="modal-title">

                        Approve Pengajuan

                    </h5>

                    <button type="button" class="btn-close" data-bs-dismiss="modal">

                    </button>

                </div>


                <div class="modal-body">

                    <div class="mb-3">

                        <label class="form-label">

                            Catatan Approval

                        </label>

                        <textarea class="form-control" rows="4" placeholder="Masukkan catatan approval (opsional)..."></textarea>

                    </div>

                </div>


                <div class="modal-footer">

                    <button type="button" class="btn me-auto" data-bs-dismiss="modal">

                        Batal

                    </button>

                    <button class="btn btn-success">

                        Approve Pengajuan

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>


{{-- MODAL REJECT --}}
<div class="modal modal-blur fade" id="modalReject" tabindex="-1">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <form action="#" method="POST">

                @csrf

                <div class="modal-header">

                    <h5 class="modal-title">

                        Reject Pengajuan

                    </h5>

                    <button type="button" class="btn-close" data-bs-dismiss="modal">

                    </button>

                </div>


                <div class="modal-body">

                    <div class="mb-3">

                        <label class="form-label">

                            Alasan Reject

                        </label>

                        <textarea class="form-control" rows="4" placeholder="Masukkan alasan penolakan..."></textarea>

                    </div>

                </div>


                <div class="modal-footer">

                    <button type="button" class="btn me-auto" data-bs-dismiss="modal">

                        Batal

                    </button>

                    <button class="btn btn-danger">

                        Reject Pengajuan

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection