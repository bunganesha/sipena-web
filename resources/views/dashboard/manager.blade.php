{{-- ========================= --}}
{{-- SUMMARY --}}
{{-- ========================= --}}

<div class="row row-deck row-cards">

    {{-- Pending Approval --}}
    <div class="col-sm-6 col-lg-3">
        <div class="card card-sm">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <span class="avatar bg-warning text-white me-3">
                        <i class="ti ti-hourglass"></i>
                    </span>

                    <div>
                        <div class="text-secondary">
                            Approval Pending
                        </div>

                        <div class="fs-1 fw-bold text-warning">
                            {{ $pendingManager }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Pengajuan Saya --}}
    <div class="col-sm-6 col-lg-3">
        <div class="card card-sm">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <span class="avatar bg-primary text-white me-3">
                        <i class="ti ti-file-text"></i>
                    </span>

                    <div>
                        <div class="text-secondary">
                            Pengajuan Saya
                        </div>

                        <div class="fs-1 fw-bold">
                            {{ $pengajuanSaya }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Sisa Cuti --}}
    <div class="col-sm-6 col-lg-3">
        <div class="card card-sm">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <span class="avatar bg-success text-white me-3">
                        <i class="ti ti-beach"></i>
                    </span>

                    <div>
                        <div class="text-secondary">
                            Sisa Cuti
                        </div>

                        <div class="fs-1 fw-bold text-success">
                            {{ $sisaCuti }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Kehadiran --}}
    <div class="col-sm-6 col-lg-3">
        <div class="card card-sm">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <span class="avatar bg-info text-white me-3">
                        <i class="ti ti-calendar-check"></i>
                    </span>

                    <div>
                        <div class="text-secondary">
                            Total Hadir
                        </div>

                        <div class="fs-1 fw-bold text-info">
                            {{ $hadirSaya }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


{{-- ========================= --}}
{{-- CONTENT --}}
{{-- ========================= --}}

<div class="row mt-4">

    <div class="col-lg-8">

        <div class="card">

            <div class="card-header">
                <h3 class="card-title">
                    Pengajuan Menunggu Persetujuan
                </h3>
            </div>

            <div class="table-responsive">

                <table class="table table-vcenter">

                    <thead>
                        <tr>
                            <th>Pegawai</th>
                            <th>Jenis</th>
                            <th>Tanggal</th>
                            <th>Status SPV</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($pengajuanManager as $item)

                        <tr>

                            <td>{{ $item->pegawai->nama }}</td>

                            <td>{{ ucfirst($item->jenis_pengajuan) }}</td>

                            <td>
                                {{ $item->tanggal_mulai }}
                            </td>

                            <td>
                                <span class="badge bg-success-lt">
                                    Approved
                                </span>
                            </td>

                        </tr>

                        @empty

                        <tr>

                            <td colspan="4" class="text-center">
                                Tidak ada pengajuan yang perlu diproses.
                            </td>

                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>


        {{-- Riwayat Absensi --}}
        <div class="card mt-3">

            <div class="card-header">
                <h3 class="card-title">
                    Riwayat Absensi Saya
                </h3>
            </div>

            <div class="table-responsive">

                <table class="table table-vcenter">

                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach($absensis as $item)

                        <tr>

                            <td>{{ $item->tanggal }}</td>

                            <td>

                                <span class="badge bg-primary-lt">

                                    {{ ucfirst($item->status_absensi) }}

                                </span>

                            </td>

                        </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        </div>

    </div>


    <div class="col-lg-4">

        <div class="card">

            <div class="card-header">
                <h3 class="card-title">
                    Quick Menu
                </h3>
            </div>

            <div class="list-group list-group-flush">

                <a href="{{ route('approval.index') }}"
                    class="list-group-item list-group-item-action">

                    ✅ Approval Pengajuan

                </a>

                <a href="{{ route('pengajuan.index') }}"
                    class="list-group-item list-group-item-action">

                    📄 Pengajuan Saya

                </a>

                <a href="{{ route('absensi.saya') }}"
                    class="list-group-item list-group-item-action">

                    📅 Riwayat Absensi

                </a>

                <a href="{{ route('profile.index') }}"
                    class="list-group-item list-group-item-action">

                    ⚙️ Profil Saya

                </a>

            </div>

        </div>

    </div>

</div>