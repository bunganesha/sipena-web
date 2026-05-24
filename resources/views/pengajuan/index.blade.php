@extends('layouts.index')

@section('title', 'Data Pengajuan')
@section('page-title', 'Data Pengajuan')

@section('page-action')
<button class="btn btn-primary"
    data-bs-toggle="modal"
    data-bs-target="#modalPengajuan">
    + Tambah Pengajuan
</button>
@endsection

@section('content')

<div class="card">

    {{-- HEADER --}}
    <div class="card-body border-bottom py-3">
        <div class="d-flex align-items-center">

            <div class="text-secondary">
                Kelola pengajuan cuti, izin, dan sakit pegawai
            </div>

            <div class="ms-auto">
                <input type="text" class="form-control" placeholder="Search pengajuan...">
            </div>

        </div>
    </div>

    {{-- TABLE --}}
    <div class="table-responsive">
        <table class="table table-vcenter card-table">

            <thead>
                <tr>
                    <th>No</th>
                    <th>Pegawai</th>
                    <th>NIP</th>
                    <th>Jenis</th>
                    <th>Tanggal</th>
                    <th>Alasan</th>
                    <th>SPV</th>
                    <th>Manager</th>
                    <th>HRD</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>

                @forelse($pengajuans as $pengajuan)
                <tr>

                    <td>{{ $loop->iteration }}</td>

                    <td>{{ $pengajuan->pegawai->nama ?? '-' }}</td>

                    <td>{{ $pengajuan->pegawai->nip ?? '-' }}</td>

                    <td>
                        <span class="badge bg-blue-lt">
                            {{ ucfirst($pengajuan->jenis_pengajuan) }}
                        </span>
                    </td>

                    <td>
                        {{ $pengajuan->tanggal_mulai }} <br>
                        <span class="text-muted">s/d</span> {{ $pengajuan->tanggal_selesai }}
                    </td>

                    <td>
                        {{ \Illuminate\Support\Str::limit($pengajuan->alasan, 25) }}
                    </td>

                    {{-- SPV --}}
                    <td>
                        <span class="badge
                            @if($pengajuan->status_spv == 'approved') bg-success-lt
                            @elseif($pengajuan->status_spv == 'rejected') bg-danger-lt
                            @else bg-warning-lt @endif">
                            {{ ucfirst($pengajuan->status_spv) }}
                        </span>
                    </td>

                    {{-- MANAGER --}}
                    <td>
                        <span class="badge
                            @if($pengajuan->status_manager == 'approved') bg-success-lt
                            @elseif($pengajuan->status_manager == 'rejected') bg-danger-lt
                            @else bg-warning-lt @endif">
                            {{ ucfirst($pengajuan->status_manager) }}
                        </span>
                    </td>

                    {{-- HRD --}}
                    <td>
                        <span class="badge
                            @if($pengajuan->status_hrd == 'approved') bg-success-lt
                            @elseif($pengajuan->status_hrd == 'rejected') bg-danger-lt
                            @else bg-warning-lt @endif">
                            {{ ucfirst($pengajuan->status_hrd) }}
                        </span>
                    </td>

                    {{-- ACTION --}}
                    <td>
                        <div class="btn-list flex-nowrap">

                            <button class="btn btn-info btn-sm"
                                data-pengajuan='@json($pengajuan)'
                                onclick="showDetail(this)">
                                Detail
                            </button>

                            <form action="{{ route('pengajuan.destroy', $pengajuan->id) }}"
                                method="POST"
                                onsubmit="return confirm('Hapus pengajuan ini?')">

                                @csrf
                                @method('DELETE')

                                <button class="btn btn-danger btn-sm">
                                    Hapus
                                </button>

                            </form>

                        </div>
                    </td>

                </tr>
                @empty
                <tr>
                    <td colspan="10" class="text-center text-muted">
                        Tidak ada data pengajuan
                    </td>
                </tr>
                @endforelse

            </tbody>

        </table>
    </div>
</div>

{{-- ===================== --}}
{{-- MODAL TAMBAH --}}
{{-- ===================== --}}
<div class="modal modal-blur fade" id="modalPengajuan" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <form action="{{ route('pengajuan.store') }}" method="POST">
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title">Tambah Pengajuan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Pegawai</label>
                            <select name="pegawai_id" class="form-select" required>
                                @foreach($pegawais as $pegawai)
                                <option value="{{ $pegawai->id }}">
                                    {{ $pegawai->nip }} - {{ $pegawai->nama }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Jenis</label>
                            <select name="jenis_pengajuan" class="form-select">
                                <option value="cuti">Cuti</option>
                                <option value="izin">Izin</option>
                                <option value="sakit">Sakit</option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tanggal Mulai</label>
                            <input type="date" name="tanggal_mulai" class="form-control" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tanggal Selesai</label>
                            <input type="date" name="tanggal_selesai" class="form-control" required>
                        </div>

                        <div class="col-12 mb-3">
                            <label class="form-label">Alasan</label>
                            <textarea name="alasan" class="form-control"></textarea>
                        </div>

                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn me-auto" data-bs-dismiss="modal">Batal</button>
                    <button class="btn btn-primary">Simpan</button>
                </div>

            </form>

        </div>
    </div>
</div>

{{-- ===================== --}}
{{-- MODAL DETAIL (FIX UI TABLER) --}}
{{-- ===================== --}}
<div class="modal modal-blur fade" id="modalDetail" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Detail Pengajuan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

                <div class="row g-3">

                    <div class="col-md-6">
                        <div class="card card-sm">
                            <div class="card-body">
                                <div class="text-muted">Pegawai</div>
                                <div class="fw-bold" id="d_nama">-</div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card card-sm">
                            <div class="card-body">
                                <div class="text-muted">NIP</div>
                                <div class="fw-bold" id="d_nip">-</div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card card-sm">
                            <div class="card-body">
                                <div class="text-muted">Jenis</div>
                                <div class="fw-bold" id="d_jenis">-</div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card card-sm">
                            <div class="card-body">
                                <div class="text-muted">Tanggal</div>
                                <div class="fw-bold" id="d_tanggal">-</div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="card card-sm">
                            <div class="card-body">
                                <div class="text-muted">Alasan</div>
                                <div class="fw-bold" id="d_alasan">-</div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card card-sm">
                            <div class="card-body">
                                <div class="text-muted">SPV</div>
                                <div class="fw-bold" id="d_spv">-</div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card card-sm">
                            <div class="card-body">
                                <div class="text-muted">Manager</div>
                                <div class="fw-bold" id="d_manager">-</div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card card-sm">
                            <div class="card-body">
                                <div class="text-muted">HRD</div>
                                <div class="fw-bold" id="d_hrd">-</div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </div>
</div>

@endsection

{{-- SCRIPT --}}
@push('scripts')
<script>
function showDetail(el) {

    const data = JSON.parse(el.dataset.pengajuan);

    document.getElementById('d_nama').innerText = data.pegawai?.nama ?? '-';
    document.getElementById('d_nip').innerText = data.pegawai?.nip ?? '-';
    document.getElementById('d_jenis').innerText = data.jenis_pengajuan ?? '-';
    document.getElementById('d_tanggal').innerText =
        (data.tanggal_mulai ?? '-') + ' - ' + (data.tanggal_selesai ?? '-');
    document.getElementById('d_alasan').innerText = data.alasan ?? '-';

    document.getElementById('d_spv').innerText = data.status_spv ?? '-';
    document.getElementById('d_manager').innerText = data.status_manager ?? '-';
    document.getElementById('d_hrd').innerText = data.status_hrd ?? '-';

    new bootstrap.Modal(document.getElementById('modalDetail')).show();
}
</script>
@endpush