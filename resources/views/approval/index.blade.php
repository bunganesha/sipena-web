@extends('layouts.index')

@section('title', 'Approval Pengajuan')
@section('page-title', 'Approval Pengajuan')

@section('content')

<div class="card">

    {{-- HEADER --}}
    <div class="card-body border-bottom py-3">

        <div class="d-flex align-items-center">

            <div class="text-secondary">
                Kelola Approval Pengajuan Pegawai
            </div>

            <div class="ms-auto">

                <form method="GET">

                    <div class="input-icon">

                        <input
                            type="text"
                            class="form-control"
                            placeholder="Search..."
                            name="search"
                            value="{{ request('search') }}">

                    </div>

                </form>

            </div>

        </div>

    </div>


    <div class="table-responsive">

        <table class="table table-vcenter card-table">

            <thead>

                <tr>

                    <th>ID</th>
                    <th>Pegawai</th>
                    <th>Role</th>
                    <th>Jenis</th>
                    <th>Tanggal</th>
                    <th>SPV</th>
                    <th>Manager</th>
                    <th>HRD</th>
                    <th>Status</th>
                    <th width="180">Aksi</th>

                </tr>

            </thead>

            <tbody>

                @forelse($pengajuans as $item)

                @php

                $pemohonRole = strtolower(optional(optional($item->pegawai)->user)->role);

                @endphp

                <tr>

                    <td>

                        APR{{ str_pad($item->id,4,'0',STR_PAD_LEFT) }}

                    </td>

                    <td>

                        <strong>{{ optional($item->pegawai)->nama }}</strong>

                        <br>

                        <small class="text-secondary">

                            {{ optional($item->pegawai)->nip }}

                        </small>

                    </td>

                    <td>

                        <span class="badge bg-blue-lt">

                            {{ strtoupper($pemohonRole) }}

                        </span>

                    </td>

                    <td>

                        <span class="badge bg-warning-lt">

                            {{ ucfirst($item->jenis_pengajuan) }}

                        </span>

                    </td>

                    <td>

                        {{ $item->tanggal_mulai }}

                        <br>

                        <small class="text-secondary">

                            s/d {{ $item->tanggal_selesai }}

                        </small>

                    </td>

                    {{-- ========================= --}}
                    {{-- STATUS SPV --}}
                    {{-- ========================= --}}

                    <td>

                        @switch($item->status_spv)

                        @case('approved')

                        <span class="badge bg-success">
                            Approved
                        </span>

                        @break

                        @case('rejected')

                        <span class="badge bg-danger">
                            Rejected
                        </span>

                        @break

                        @default

                        @if(in_array($pemohonRole,['manager','hrd']))

                        <span class="badge bg-secondary">

                            -

                        </span>

                        @else

                        <span class="badge bg-warning">

                            Pending

                        </span>

                        @endif

                        @endswitch

                    </td>

                    {{-- ========================= --}}
                    {{-- STATUS MANAGER --}}
                    {{-- ========================= --}}

                    <td>

                        @switch($item->status_manager)

                        @case('approved')

                        <span class="badge bg-success">
                            Approved
                        </span>

                        @break

                        @case('rejected')

                        <span class="badge bg-danger">
                            Rejected
                        </span>

                        @break

                        @default

                        @if($pemohonRole=='hrd')

                        <span class="badge bg-secondary">

                            -

                        </span>

                        @else

                        <span class="badge bg-warning">

                            Pending

                        </span>

                        @endif

                        @endswitch

                    </td>

                    {{-- ========================= --}}
                    {{-- STATUS HRD --}}
                    {{-- ========================= --}}

                    <td>

                        @if($item->status_hrd=='approved')

                        <span class="badge bg-primary">

                            Mengetahui

                        </span>

                        @elseif($item->status_hrd=='rejected')

                        <span class="badge bg-danger">

                            Rejected

                        </span>

                        @else

                        <span class="badge bg-warning">

                            Waiting

                        </span>

                        @endif

                    </td>

                    {{-- ========================= --}}
                    {{-- STATUS FINAL --}}
                    {{-- ========================= --}}

                    <td>

                        @php

                        $final = 'Process';

                        if(
                        $item->status_spv=='rejected' ||
                        $item->status_manager=='rejected' ||
                        $item->status_hrd=='rejected'
                        ){
                        $final='Rejected';
                        }

                        elseif($pemohonRole=='pegawai'
                        &&
                        $item->status_spv=='approved'
                        &&
                        $item->status_manager=='approved'
                        &&
                        $item->status_hrd=='approved'
                        ){
                        $final='Approved';
                        }

                        elseif($pemohonRole=='spv'
                        &&
                        $item->status_manager=='approved'
                        &&
                        $item->status_hrd=='approved'
                        ){
                        $final='Approved';
                        }

                        elseif(
                        in_array($pemohonRole,['manager','hrd'])
                        &&
                        $item->status_hrd=='approved'
                        ){
                        $final='Approved';
                        }

                        @endphp

                        @if($final=='Approved')

                        <span class="badge bg-success">

                            Approved

                        </span>

                        @elseif($final=='Rejected')

                        <span class="badge bg-danger">

                            Rejected

                        </span>

                        @else

                        <span class="badge bg-warning">

                            Process

                        </span>

                        @endif

                    </td>

                    {{-- ========================= --}}
                    {{-- AKSI --}}
                    {{-- ========================= --}}
                    <td>

                        <div class="btn-list">

                            <button
                                class="btn btn-success btn-sm"
                                onclick="openModal('approve', '{{ $item->id }}')">

                                {{ session('role') == 'hrd' ? 'Mengetahui' : 'Approve' }}

                            </button>

                            <button
                                class="btn btn-danger btn-sm"
                                onclick="openModal('reject', '{{ $item->id }}')">

                                Reject

                            </button>

                            <button
                                class="btn btn-info btn-sm"
                                onclick="openDetail('{{ $item->id }}')">

                                Detail

                            </button>

                        </div>

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="10" class="text-center">

                        Belum ada data.

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

{{-- ========================================= --}}
{{-- MODAL APPROVAL --}}
{{-- ========================================= --}}

<div class="modal fade" id="modalApproval" tabindex="-1">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <form
                id="approvalForm"
                method="POST">

                @csrf
                @method('PUT')

                <div class="modal-header">

                    <h5
                        class="modal-title"
                        id="modalTitle">

                        Approval Pengajuan

                    </h5>

                    <button
                        class="btn-close"
                        data-bs-dismiss="modal">
                    </button>

                </div>

                <div class="modal-body">

                    <input
                        type="hidden"
                        name="status"
                        id="statusInput">

                    <div
                        class="mb-3"
                        id="alasanGroup">

                        <label class="form-label">

                            Catatan

                        </label>

                        <textarea
                            class="form-control"
                            rows="4"
                            name="alasan"
                            id="alasanInput"
                            placeholder="Masukkan catatan..."></textarea>

                    </div>

                    <label class="form-check">

                        <input
                            type="checkbox"
                            class="form-check-input"
                            id="confirmCheck">

                        <span class="form-check-label">

                            Saya yakin dengan keputusan ini

                        </span>

                    </label>

                </div>

                <div class="modal-footer">

                    <button
                        type="button"
                        class="btn me-auto"
                        data-bs-dismiss="modal">

                        Batal

                    </button>

                    <button
                        class="btn btn-success"
                        id="submitBtn">

                        Submit

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>


{{-- ========================================= --}}
{{-- MODAL DETAIL --}}
{{-- ========================================= --}}

<div class="modal fade" id="modalDetail" tabindex="-1">

    <div class="modal-dialog modal-lg">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title">

                    Detail Pengajuan

                </h5>

                <button
                    class="btn-close"
                    data-bs-dismiss="modal">
                </button>

            </div>

            <div class="modal-body" id="detailBody">

            </div>

        </div>

    </div>

</div>

<script>
    function openModal(type, id) {

        const modal = new bootstrap.Modal(document.getElementById('modalApproval'));

        document.getElementById('approvalForm').action = '/approval/' + id;

        document.getElementById('statusInput').value =
            type == 'approve' ?
            'Approved' :
            'Rejected';

        const role = '{{ session("role") }}';

        const title = document.getElementById('modalTitle');
        const submit = document.getElementById('submitBtn');
        const alasanGroup = document.getElementById('alasanGroup');

        document.getElementById('alasanInput').value = '';
        document.getElementById('confirmCheck').checked = false;

        if (type == 'approve') {

            submit.className = 'btn btn-success';

            if (role == 'hrd') {

                title.innerHTML = 'Mengetahui Pengajuan';

                alasanGroup.style.display = 'none';

                submit.innerHTML = 'Mengetahui';

            } else {

                title.innerHTML = 'Approve Pengajuan';

                alasanGroup.style.display = 'block';

                submit.innerHTML = 'Approve';

            }

        } else {

            title.innerHTML = 'Reject Pengajuan';

            submit.className = 'btn btn-danger';

            submit.innerHTML = 'Reject';

            alasanGroup.style.display = 'block';

        }

        modal.show();

    }



    function openDetail(id) {

        fetch('/approval/' + id + '/detail')

            .then(res => res.json())

            .then(res => {

                let data = res.data;

                let html = '';

                html += `

        <div class="mb-3">

            <h4>Data Pengajuan</h4>

            <table class="table table-bordered">

                <tr>

                    <th width="180">Nama</th>

                    <td>${data.pegawai.nama}</td>

                </tr>

                <tr>

                    <th>Jenis</th>

                    <td>${data.jenis_pengajuan}</td>

                </tr>

                <tr>

                    <th>Tanggal</th>

                    <td>

                        ${data.tanggal_mulai}

                        s/d

                        ${data.tanggal_selesai}

                    </td>

                </tr>

                <tr>

                    <th>Alasan</th>

                    <td>${data.alasan}</td>

                </tr>

            </table>

        </div>

        <hr>

        <h4>Riwayat Approval</h4>

        `;

                if (data.logs.length == 0) {

                    html += `

            <div class="alert alert-warning">

                Belum ada approval.

            </div>

            `;

                }

                data.logs.forEach(log => {

                    let badge = '';

                    if (log.status == 'approved') {

                        if (log.role == 'hrd') {

                            badge = '<span class="badge bg-primary">Mengetahui</span>';

                        } else {

                            badge = '<span class="badge bg-success">Approved</span>';

                        }

                    } else {

                        badge = '<span class="badge bg-danger">Rejected</span>';

                    }

                    html += `

            <div class="card mb-2">

                <div class="card-body">

                    <div class="d-flex justify-content-between">

                        <strong>

                            ${log.role.toUpperCase()}

                        </strong>

                        ${badge}

                    </div>

                    <hr>

                    <small>

                        ${log.created_at}

                    </small>

                    <br><br>

                    ${

                        log.alasan

                        ?

                        `<b>Catatan :</b><br>${log.alasan}`

                        :

                        '<i>Tidak ada catatan</i>'

                    }

                </div>

            </div>

            `;

                });

                document.getElementById('detailBody').innerHTML = html;

                new bootstrap.Modal(document.getElementById('modalDetail')).show();

            });

    }




    document.getElementById('approvalForm')

        .addEventListener('submit', function(e) {

            let status = document.getElementById('statusInput').value;

            let alasan = document.getElementById('alasanInput').value.trim();

            let role = '{{ session("role") }}';

            let confirm = document.getElementById('confirmCheck').checked;

            if (!confirm) {

                e.preventDefault();

                alert('Silakan centang konfirmasi terlebih dahulu.');

                return;

            }

            if (

                status == 'Rejected'

                &&

                alasan == ''

            ) {

                e.preventDefault();

                alert('Alasan reject wajib diisi.');

                return;

            }

            if (

                role != 'hrd'

                &&

                status == 'Approved'

                &&

                alasan == ''

            ) {

                if (

                    !window.confirm(

                        'Approve tanpa catatan?'

                    )

                ) {

                    e.preventDefault();

                    return;

                }

            }

        });
</script>

@endsection