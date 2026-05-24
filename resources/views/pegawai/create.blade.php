<form action="{{ route('pegawai.store') }}" method="POST">
    @csrf

    {{-- USER RELATION --}}
    <div class="mb-3">
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

    {{-- field lain --}}
    <input type="text" name="nip" class="form-control">
    <input type="text" name="nama" class="form-control">
    <input type="text" name="jabatan" class="form-control">
    <input type="text" name="divisi" class="form-control">

    <select name="status" class="form-select">
        <option value="aktif">Aktif</option>
        <option value="nonaktif">Nonaktif</option>
    </select>

    <button class="btn btn-primary">Simpan</button>
</form>