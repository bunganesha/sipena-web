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
                        <input type="text" name="search" class="form-control"
                            placeholder="Search approval..."
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
                    <th class="w-1">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($pengajuans as $item)
                <tr>

                    {{-- ID --}}
                    <td>APR00{{ $item->id }}</td>

                    {{-- PEGAWAI --}}
                    <td>
                        <div class="d-flex py-1 align-items-center">
                            <span class="avatar me-2 bg-primary text-white">
                                {{ substr(optional($item->pegawai)->nama ?? 'P',0,1) }}
                            </span>

                            <div>
                                <div class="fw-bold">
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
                        @php $jenis = strtolower($item->jenis_pengajuan); @endphp

                        <span class="badge
                            {{ $jenis == 'cuti' ? 'bg-warning-lt' : '' }}
                            {{ $jenis == 'sakit' ? 'bg-danger-lt' : '' }}
                            {{ !in_array($jenis,['cuti','sakit']) ? 'bg-primary-lt' : '' }}
                        ">
                            {{ $item->jenis_pengajuan }}
                        </span>
                    </td>

                    {{-- TANGGAL --}}
                    <td>{{ $item->tanggal_mulai ?? '-' }}</td>

                    {{-- DURASI --}}
                    <td>{{ $item->durasi ?? '-' }}</td>

                    {{-- SPV --}}
                    <td>
                        @if($item->status_spv == 'approved')
                            <span class="badge bg-success-lt">Approved</span>
                        @elseif($item->status_spv == 'rejected')
                            <span class="badge bg-danger-lt">Rejected</span>
                        @else
                            <span class="badge bg-yellow-lt">Pending</span>
                        @endif
                    </td>

                    {{-- MANAGER --}}
                    <td>
                        @if($item->status_manager == 'approved')
                            <span class="badge bg-success-lt">Approved</span>
                        @elseif($item->status_manager == 'rejected')
                            <span class="badge bg-danger-lt">Rejected</span>
                        @else
                            <span class="badge bg-yellow-lt">Pending</span>
                        @endif
                    </td>

                    {{-- HRD --}}
                    <td>
                        @if($item->status_hrd == 'approved')
                            <span class="badge bg-primary">Mengetahui</span>
                        @elseif($item->status_hrd == 'rejected')
                            <span class="badge bg-danger-lt">Rejected</span>
                        @else
                            <span class="badge bg-secondary-lt">Waiting</span>
                        @endif
                    </td>

                    {{-- STATUS FINAL --}}
                    <td>
                        @if(
                            $item->status_spv == 'approved' &&
                            $item->status_manager == 'approved' &&
                            $item->status_hrd == 'approved'
                        )
                            <span class="badge bg-success text-white">Approved</span>

                        @elseif(
                            $item->status_spv == 'rejected' ||
                            $item->status_manager == 'rejected' ||
                            $item->status_hrd == 'rejected'
                        )
                            <span class="badge bg-danger text-white">Rejected</span>
                        @else
                            <span class="badge bg-yellow text-white">Process</span>
                        @endif
                    </td>

                    {{-- AKSI --}}
                    <td>
                        <div class="btn-list flex-nowrap">

                            {{-- SPV / MANAGER MODAL --}}
                            @if(
                                (session('role') == 'spv' && $item->status_spv == 'pending') ||
                                (session('role') == 'manager' && $item->status_spv == 'approved' && $item->status_manager == 'pending')
                            )
                                <button class="btn btn-success btn-sm"
                                    onclick="openModal('approve', '{{ $item->id }}')">
                                    Approve
                                </button>

                                <button class="btn btn-danger btn-sm"
                                    onclick="openModal('reject', '{{ $item->id }}')">
                                    Reject
                                </button>
                            @endif

                            {{-- HRD (tetap form lama) --}}
                            @if(
                                session('role') == 'hrd' &&
                                $item->status_spv == 'approved' &&
                                $item->status_manager == 'approved' &&
                                $item->status_hrd == 'pending'
                            )
                                <form action="/approval/{{ $item->id }}" method="POST">
                                    @csrf @method('PUT')
                                    <input type="hidden" name="status" value="Approved">
                                    <button class="btn btn-primary btn-sm">Mengetahui</button>
                                </form>

                                <form action="/approval/{{ $item->id }}" method="POST">
                                    @csrf @method('PUT')
                                    <input type="hidden" name="status" value="Rejected">
                                    <button class="btn btn-danger btn-sm">Reject</button>
                                </form>
                            @endif

                            <button class="btn btn-info btn-sm"
                                onclick="openDetail('{{ $item->id }}')">
                                Detail
                            </button>

                        </div>
                    </td>

                </tr>
                @empty
                <tr>
                    <td colspan="10" class="text-center text-secondary py-4">
                        Belum ada data pengajuan
                    </td>
                </tr>
                @endforelse
            </tbody>

        </table>
    </div>
</div>

{{-- MODAL APPROVAL --}}
<div class="modal fade" id="modalApproval">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <form id="approvalForm" method="POST">
                @csrf
                @method('PUT')

                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Approval</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <input type="hidden" name="status" id="statusInput">

                    <div id="alasanGroup" class="mb-3">
                        <label class="form-label">Alasan / Catatan</label>
                        <textarea name="alasan" id="alasanInput"
                            class="form-control" rows="4"></textarea>
                    </div>

                    <label class="form-check">
                        <input class="form-check-input" type="checkbox" id="confirmCheck">
                        <span class="form-check-label">Saya yakin dengan keputusan ini</span>
                    </label>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn me-auto" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn" id="submitBtn">Submit</button>
                </div>

            </form>

        </div>
    </div>
</div>

{{-- MODAL DETAIL --}}
<div class="modal fade" id="modalDetail">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h5>Detail Approval</h5>
            </div>

            <div class="modal-body" id="detailBody"></div>

        </div>
    </div>
</div>


<script>
    let selectedId = null;
    let selectedType = null;

    function openModal(type, id) {
        selectedId = id;
        selectedType = type;

        const modal = new bootstrap.Modal(document.getElementById('modalApproval'));

        document.getElementById('approvalForm').action = `/approval/${id}`;
        document.getElementById('statusInput').value = type === 'approve' ? 'Approved' : 'Rejected';

        const role = '{{ session("role") }}';

        if (role === 'hrd' && type === 'approve') {
            document.getElementById('modalTitle').innerText =
                'Mengetahui Pengajuan';
        } else {
            document.getElementById('modalTitle').innerText =
                type === 'approve' ?
                'Approve Pengajuan' :
                'Reject Pengajuan';
        }

        document.getElementById('submitBtn').className =
            type === 'approve' ? 'btn btn-success' : 'btn btn-danger';

        document.getElementById('alasanInput').value = '';

        document.getElementById('confirmCheck').checked = false;

        const alasanGroup = document.getElementById('alasanGroup');

        if (
            '{{ session("role") }}' === 'hrd' &&
            type === 'approve'
        ) {
            alasanGroup.style.display = 'none';
        } else {
            alasanGroup.style.display = 'block';
        }

        modal.show();
    }

    function openDetail(id) {
        fetch(`/approval/${id}/detail`)
            .then(res => res.json())
            .then(data => {

                let html = `
                    <div class="mb-3">
                        <h4>Alasan Pegawai</h4>
                        <div class="alert alert-info">
                            ${data.data.alasan ?? '-'}
                        </div>
                    </div>

                    <hr>

                    <h4>Riwayat Approval</h4>
                `;

                const logs = data.data.logs ?? [];

                logs.forEach(log => {

                    let badge = '';

                    if (log.role === 'hrd' && log.status === 'approved') {
                        badge = '<span class="badge bg-primary text-white">Mengetahui</span>';
                    } else if (log.status === 'approved') {
                        badge = '<span class="badge bg-success text-white">Approved</span>';
                    } else if (log.status === 'rejected') {
                        badge = '<span class="badge bg-danger text-white">Rejected</span>';
                    } else {
                        badge = '<span class="badge bg-secondary text-white">Pending</span>';
                    }

                    html += `
                        <div class="card mb-2">
                            <div class="card-body">

                                <strong>${log.role.toUpperCase()}</strong>
                                ${badge}

                                <br><br>

                                ${log.role === 'hrd'
                                    ? ''
                                    : (
                                        log.alasan
                                        ? `<b>Catatan:</b><br>${log.alasan}`
                                        : '<i>Tidak ada catatan</i>'
                                    )
                                }

                            </div>
                        </div>
                    `;
                });

                document.getElementById('detailBody').innerHTML = html;

                new bootstrap.Modal(document.getElementById('modalDetail')).show();
            });
    }

    // VALIDASI SIMPLE
    document.getElementById('approvalForm').addEventListener('submit', function(e) {
        const alasan = document.getElementById('alasanInput').value;
        const status = document.getElementById('statusInput').value;
        const confirm = document.getElementById('confirmCheck').checked;

        if (!confirm) {
            e.preventDefault();
            alert('Harus konfirmasi terlebih dahulu');
            return;
        }

        if (status === 'Rejected' && alasan.trim() === '') {
            e.preventDefault();
            alert('Alasan wajib diisi untuk reject');
            return;
        }
    });
</script>

@endsection