@extends('layouts.index')

@section('title', 'Data Pegawai')

@section('page-title', 'Data Pegawai')

@section('page-action')

<button class="btn btn-primary"
    data-bs-toggle="modal"
    data-bs-target="#modalPegawai">

    + Tambah Pegawai

</button>

@endsection

@section('content')

<div class="card">

    {{-- HEADER --}}
    <div class="card-body border-bottom py-3">

        <div class="d-flex align-items-center">

            <div class="text-secondary">
                Data seluruh pegawai perusahaan
            </div>

            <div class="ms-auto text-secondary">
                <div class="input-icon">
                    <input type="text"
                        class="form-control"
                        placeholder="Search pegawai...">
                </div>
            </div>

        </div>

    </div>

    {{-- TABLE --}}
    <div class="table-responsive">

        <table class="table table-vcenter card-table">

            <thead>
                <tr>
                    <th>NIP</th>
                    <th>Nama</th>
                    <th>Jabatan</th>
                    <th>Divisi</th>
                    <th>Status</th>
                    <th>Jatah Cuti</th>
                    <th>Sisa Cuti</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>

                @forelse($pegawais as $pegawai)
                <tr>

                    <td>{{ $pegawai->nip }}</td>
                    <td>{{ $pegawai->nama }}</td>
                    <td>{{ $pegawai->jabatan }}</td>
                    <td>{{ $pegawai->divisi }}</td>

                    <td>
                        <span class="badge bg-success-lt">
                            {{ $pegawai->status }}
                        </span>
                    </td>

                    <td>{{ $pegawai->jatah_cuti }}</td>
                    <td>{{ $pegawai->sisa_cuti }}</td>

                    <td>
                        <div class="btn-list flex-nowrap">

                            {{-- EDIT --}}
                            <button class="btn btn-warning btn-sm"
                                data-bs-toggle="modal"
                                data-bs-target="#modalEditPegawai"
                                onclick="editPegawai(
                                    '{{ $pegawai->id }}',
                                    '{{ $pegawai->nip }}',
                                    '{{ $pegawai->nama }}',
                                    '{{ $pegawai->jabatan }}',
                                    '{{ $pegawai->divisi }}',
                                    '{{ $pegawai->status }}',
                                    '{{ $pegawai->jatah_cuti }}',
                                    '{{ $pegawai->sisa_cuti }}'
                                )">
                                Edit
                            </button>

                            {{-- DELETE --}}
                            <form action="{{ route('pegawai.destroy', $pegawai->id) }}"
                                method="POST"
                                onsubmit="return confirm('Yakin hapus data ini?')">

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
                    <td colspan="8" class="text-center text-muted">
                        Tidak ada data pegawai
                    </td>
                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

{{-- ========================= --}}
{{-- MODAL TAMBAH PEGAWAI --}}
{{-- ========================= --}}
<div class="modal modal-blur fade"
    id="modalPegawai"
    tabindex="-1">

    <div class="modal-dialog modal-lg modal-dialog-centered">

        <div class="modal-content">

            <form action="{{ route('pegawai.store') }}" method="POST">
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title">Tambah Pegawai</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">User</label>

                            <select name="user_id" class="form-select" required>

                                <option value="">Pilih User</option>

                                @foreach($users as $user)

                                    <option value="{{ $user->id }}">
                                        {{ $user->username }}
                                    </option>

                                @endforeach

                            </select>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label class="form-label">NIP</label>
                            <input type="text" name="nip" class="form-control" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nama</label>
                            <input type="text" name="nama" class="form-control" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Jabatan</label>
                            <input type="text" name="jabatan" class="form-control" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Divisi</label>
                            <input type="text" name="divisi" class="form-control" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select">
                                <option value="aktif">Aktif</option>
                                <option value="nonaktif">Nonaktif</option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Jatah Cuti</label>
                            <input type="number" name="jatah_cuti" class="form-control" value="3">
                        </div>

                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn me-auto" data-bs-dismiss="modal">
                        Batal
                    </button>

                    <button class="btn btn-primary">
                        Simpan
                    </button>
                </div>

            </form>

        </div>

    </div>

</div>

{{-- ========================= --}}
{{-- MODAL EDIT PEGAWAI --}}
{{-- ========================= --}}
<div class="modal modal-blur fade"
    id="modalEditPegawai"
    tabindex="-1">

    <div class="modal-dialog modal-lg modal-dialog-centered">

        <div class="modal-content">

            <form id="formEditPegawai" method="POST">
                @csrf
                @method('PUT')

                <div class="modal-header">
                    <h5 class="modal-title">Edit Pegawai</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <label class="form-label">NIP</label>
                            <input type="text" name="nip" id="edit_nip" class="form-control" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nama</label>
                            <input type="text" name="nama" id="edit_nama" class="form-control" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Jabatan</label>
                            <input type="text" name="jabatan" id="edit_jabatan" class="form-control" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Divisi</label>
                            <input type="text" name="divisi" id="edit_divisi" class="form-control" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Status</label>
                            <select name="status" id="edit_status" class="form-select">
                                <option value="aktif">Aktif</option>
                                <option value="nonaktif">Nonaktif</option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Jatah Cuti</label>
                            <input type="number" name="jatah_cuti" id="edit_jatah_cuti" class="form-control">
                        </div>

                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn me-auto" data-bs-dismiss="modal">
                        Batal
                    </button>

                    <button class="btn btn-primary">
                        Update
                    </button>
                </div>

            </form>

        </div>

    </div>

</div>

@endsection

@push('scripts')
<script>
function editPegawai(id, nip, nama, jabatan, divisi, status, jatah, sisa) {

    document.getElementById('formEditPegawai').action = `/pegawai/${id}`;

    document.getElementById('edit_nip').value = nip;
    document.getElementById('edit_nama').value = nama;
    document.getElementById('edit_jabatan').value = jabatan;
    document.getElementById('edit_divisi').value = divisi;
    document.getElementById('edit_status').value = status;
    document.getElementById('edit_jatah_cuti').value = jatah;
    document.getElementById('edit_sisa_cuti').value = sisa;
}
</script>
@endpush