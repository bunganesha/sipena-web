@extends('layouts.index')

@section('title', 'Data User')

@section('page-title', 'Data User')

@section('page-action')

<button class="btn btn-primary"
    data-bs-toggle="modal"
    data-bs-target="#modalUser">

    + Tambah User

</button>

@endsection

@section('content')

<div class="card">

    {{-- HEADER --}}
    <div class="card-body border-bottom py-3">

        <div class="d-flex align-items-center">

            <div class="text-secondary">
                Kelola akun pengguna SIPENA
            </div>

            <div class="ms-auto text-secondary">
                <div class="input-icon">
                    <input type="text"
                        class="form-control"
                        placeholder="Search user...">
                </div>
            </div>

        </div>

    </div>

    {{-- TABLE --}}
    <div class="table-responsive">

        <table class="table table-vcenter card-table">

            <thead>
                <tr>
                    <th>ID User</th>
                    <th>Username</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th class="w-1">Aksi</th>
                </tr>
            </thead>

            <tbody>

                @forelse($users as $user)

                <tr>

                    {{-- ID --}}
                    <td>
                        USR{{ str_pad($user->id, 3, '0', STR_PAD_LEFT) }}
                    </td>

                    {{-- USERNAME --}}
                    <td>
                        <div class="d-flex py-1 align-items-center">
                            <span class="avatar me-2 bg-primary text-white">
                                {{ strtoupper(substr($user->username, 0, 1)) }}
                            </span>

                            <div class="flex-fill">
                                <div class="font-weight-medium">
                                    {{ $user->username }}
                                </div>
                            </div>
                        </div>
                    </td>

                    {{-- ROLE --}}
                    <td>
                        <span class="badge bg-blue-lt">
                            {{ strtoupper($user->role) }}
                        </span>
                    </td>

                    {{-- STATUS (sementara default) --}}
                    <td>
                        <span class="badge bg-success-lt">
                            Aktif
                        </span>
                    </td>

                    {{-- AKSI --}}
                    <td>
                        <div class="btn-list flex-nowrap">

                            <button class="btn btn-warning btn-sm"
                                data-user='@json($user)'
                                onclick="editUser(this)"
                                data-bs-toggle="modal"
                                data-bs-target="#modalEditUser">
                                Edit
                            </button>

                            <form action="{{ route('user.destroy', $user->id) }}"
                                method="POST"
                                onsubmit="return confirm('Hapus user ini?')">

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
                    <td colspan="5" class="text-center text-muted">
                        Tidak ada data user
                    </td>
                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

{{-- ========================= --}}
{{-- MODAL TAMBAH USER --}}
{{-- ========================= --}}
<div class="modal modal-blur fade"
    id="modalUser"
    tabindex="-1">

    <div class="modal-dialog modal-lg modal-dialog-centered">

        <div class="modal-content">

            <form action="{{ route('user.store') }}" method="POST">
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title">Tambah User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Username</label>
                            <input type="text" name="username" class="form-control" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Role</label>
                            <select name="role" class="form-select">
                                <option value="hrd">HRD</option>
                                <option value="spv">SPV</option>
                                <option value="manager">Manager</option>
                                <option value="pegawai">Pegawai</option>
                            </select>
                        </div>

                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn me-auto" data-bs-dismiss="modal">
                        Batal
                    </button>

                    <button class="btn btn-primary">
                        Simpan User
                    </button>
                </div>

            </form>

        </div>

    </div>

</div>

{{-- ========================= --}}
{{-- MODAL EDIT USER --}}
{{-- ========================= --}}
<div class="modal modal-blur fade"
    id="modalEditUser"
    tabindex="-1">

    <div class="modal-dialog modal-lg modal-dialog-centered">

        <div class="modal-content">

            <form id="formEditUser" method="POST">
                @csrf
                @method('PUT')

                <div class="modal-header">
                    <h5 class="modal-title">Edit User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Username</label>
                            <input type="text" name="username" id="edit_username" class="form-control" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Password (opsional)</label>
                            <input type="password" name="password" id="edit_password" class="form-control">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Role</label>
                            <select name="role" id="edit_role" class="form-select">
                                <option value="hrd">HRD</option>
                                <option value="spv">SPV</option>
                                <option value="manager">Manager</option>
                                <option value="pegawai">Pegawai</option>
                            </select>
                        </div>

                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn me-auto" data-bs-dismiss="modal">
                        Batal
                    </button>

                    <button class="btn btn-primary">
                        Update User
                    </button>
                </div>

            </form>

        </div>

    </div>

</div>

@endsection

{{-- SCRIPT --}}
@push('scripts')
<script>
    function editUser(el) {
        const user = JSON.parse(el.dataset.user);

        document.getElementById('formEditUser').action = `/user/${user.id}`;
        document.getElementById('edit_username').value = user.username;
        document.getElementById('edit_role').value = user.role;
    }
</script>
@endpush