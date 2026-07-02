{{-- ========================= --}}
{{-- SUMMARY --}}
{{-- ========================= --}}

<div class="row row-deck row-cards">

    <div class="col-sm-6 col-lg-3">
        <div class="card card-sm">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <span class="avatar bg-primary text-white me-3">
                        <i class="ti ti-users"></i>
                    </span>

                    <div>
                        <div class="text-secondary">
                            Total Pegawai
                        </div>

                        <div class="fs-1 fw-bold">
                            {{ $totalPegawai }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="col-sm-6 col-lg-3">
        <div class="card card-sm">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <span class="avatar bg-success text-white me-3">
                        <i class="ti ti-calendar-check"></i>
                    </span>

                    <div>
                        <div class="text-secondary">
                            Hadir Hari Ini
                        </div>

                        <div class="fs-1 fw-bold text-success">
                            {{ $hadir }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="col-sm-6 col-lg-3">
        <div class="card card-sm">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <span class="avatar bg-warning text-white me-3">
                        <i class="ti ti-clock-hour-4"></i>
                    </span>

                    <div>
                        <div class="text-secondary">
                            Approval Pending
                        </div>

                        <div class="fs-1 fw-bold text-warning">
                            {{ $pendingHrd }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="col-sm-6 col-lg-3">
        <div class="card card-sm">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <span class="avatar bg-danger text-white me-3">
                        <i class="ti ti-user-x"></i>
                    </span>

                    <div>
                        <div class="text-secondary">
                            Alpha Hari Ini
                        </div>

                        <div class="fs-1 fw-bold text-danger">
                            {{ $alpha }}
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

    {{-- ABSENSI --}}
    <div class="col-lg-8">

        <div class="card">

            <div class="card-header">

                <h3 class="card-title">

                    Absensi Hari Ini

                </h3>

            </div>

            <div class="table-responsive">

                <table class="table table-vcenter">

                    <thead>

                        <tr>

                            <th>NIP</th>
                            <th>Nama</th>
                            <th>Divisi</th>
                            <th>Status</th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($absensis as $item)

                        <tr>

                            <td>{{ $item->pegawai->nip }}</td>

                            <td>{{ $item->pegawai->nama }}</td>

                            <td>{{ $item->pegawai->divisi }}</td>

                            <td>

                                @php

                                $badge = 'danger';

                                if ($item->status_absensi == 'hadir') {
                                $badge = 'success';
                                } elseif ($item->status_absensi == 'izin') {
                                $badge = 'warning';
                                } elseif ($item->status_absensi == 'sakit') {
                                $badge = 'info';
                                } elseif ($item->status_absensi == 'cuti') {
                                $badge = 'primary';
                                }

                                @endphp

                                <span class="badge bg-{{ $badge }}-lt">
                                    {{ ucfirst($item->status_absensi) }}
                                </span>

                            </td>

                        </tr>

                        @empty

                        <tr>

                            <td colspan="4" class="text-center">

                                Belum ada absensi hari ini.

                            </td>

                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>



    {{-- QUICK MENU --}}
    <div class="col-lg-4">

        <div class="card">

            <div class="card-header">

                <h3 class="card-title">

                    Quick Menu

                </h3>

            </div>

            <div class="list-group list-group-flush">

                <a href="{{ route('pegawai.index') }}"
                    class="list-group-item list-group-item-action">

                    👤 Kelola Pegawai

                </a>

                <a href="{{ route('user.index') }}"
                    class="list-group-item list-group-item-action">

                    🔑 Kelola User

                </a>

                <a href="{{ route('absensi.index') }}"
                    class="list-group-item list-group-item-action">

                    📅 Data Absensi

                </a>

                <a href="{{ route('approval.index') }}"
                    class="list-group-item list-group-item-action">

                    ✅ Approval

                </a>

                <a href="/laporan"
                    class="list-group-item list-group-item-action">

                    📊 Laporan

                </a>

                <a href="{{ route('profile.index') }}"
                    class="list-group-item list-group-item-action">

                    ⚙️ Profil Saya

                </a>

            </div>

        </div>

        <div class="card mt-3">

            <div class="card-header">
                <h3 class="card-title">
                    Statistik Hari Ini
                </h3>
            </div>

            <div class="list-group list-group-flush">

                <div class="list-group-item d-flex justify-content-between">
                    <span>🟢 Hadir</span>
                    <span class="badge bg-success">{{ $hadir }}</span>
                </div>

                <div class="list-group-item d-flex justify-content-between">
                    <span>🟡 Izin</span>
                    <span class="badge bg-warning">{{ $izin }}</span>
                </div>

                <div class="list-group-item d-flex justify-content-between">
                    <span>🔵 Sakit</span>
                    <span class="badge bg-info">{{ $sakit }}</span>
                </div>

                <div class="list-group-item d-flex justify-content-between">
                    <span>🟣 Cuti</span>
                    <span class="badge bg-primary">{{ $cuti }}</span>
                </div>

                <div class="list-group-item d-flex justify-content-between">
                    <span>🔴 Alpha</span>
                    <span class="badge bg-danger">{{ $alpha }}</span>
                </div>

            </div>

        </div>

    </div>

</div>