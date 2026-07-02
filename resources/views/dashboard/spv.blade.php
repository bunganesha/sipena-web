{{-- ========================= --}}
{{-- SUMMARY --}}
{{-- ========================= --}}

<div class="row row-deck row-cards">

    <div class="col-md-3">
        <div class="card card-sm">
            <div class="card-body">
                <div class="text-secondary">Sisa Cuti</div>
                <div class="fs-1 fw-bold text-primary">
                    {{ $sisaCuti }} Hari
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card card-sm">
            <div class="card-body">
                <div class="text-secondary">Total Pengajuan Saya</div>
                <div class="fs-1 fw-bold">
                    {{ $pengajuanSaya }}
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card card-sm">
            <div class="card-body">
                <div class="text-secondary">Kehadiran</div>
                <div class="fs-1 fw-bold text-success">
                    {{ $hadirSaya }}
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card card-sm">
            <div class="card-body">
                <div class="text-secondary">Approval Menunggu</div>
                <div class="fs-1 fw-bold text-warning">
                    {{ $pendingSpv }}
                </div>
            </div>
        </div>
    </div>

</div>



<div class="row mt-4">

    {{-- RIWAYAT ABSENSI --}}
    <div class="col-lg-7">

        <div class="card">

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
                            <th>Masuk</th>
                            <th>Keluar</th>
                            <th>Status</th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($absensis as $item)

                        <tr>

                            <td>{{ $item->tanggal }}</td>

                            <td>{{ $item->jam_masuk ?? '-' }}</td>

                            <td>{{ $item->jam_keluar ?? '-' }}</td>

                            <td>

                                @php

                                $badge='danger';

                                if($item->status_absensi=='hadir') $badge='success';
                                elseif($item->status_absensi=='izin') $badge='warning';
                                elseif($item->status_absensi=='sakit') $badge='info';
                                elseif($item->status_absensi=='cuti') $badge='primary';

                                @endphp

                                <span class="badge bg-{{ $badge }}-lt">

                                    {{ ucfirst($item->status_absensi) }}

                                </span>

                            </td>

                        </tr>

                        @empty

                        <tr>

                            <td colspan="4" class="text-center">

                                Belum ada data.

                            </td>

                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>



    {{-- APPROVAL + MENU --}}
    <div class="col-lg-5">

        <div class="card mb-3">

            <div class="card-header">

                <h3 class="card-title">

                    Menunggu Approval SPV

                </h3>

            </div>

            <div class="table-responsive">

                <table class="table">

                    <thead>

                        <tr>

                            <th>Pegawai</th>
                            <th>Jenis</th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($pengajuanSpv as $item)

                        <tr>

                            <td>{{ $item->pegawai->nama }}</td>

                            <td>{{ ucfirst($item->jenis_pengajuan) }}</td>

                        </tr>

                        @empty

                        <tr>

                            <td colspan="2" class="text-center">

                                Tidak ada data.

                            </td>

                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>


        <div class="card">

            <div class="card-header">

                <h3 class="card-title">

                    Quick Menu

                </h3>

            </div>

            <div class="list-group list-group-flush">

                <a href="{{ route('pengajuan.index') }}"
                    class="list-group-item list-group-item-action">

                    📄 Pengajuan Saya

                </a>

                <a href="{{ route('approval.index') }}"
                    class="list-group-item list-group-item-action">

                    ✅ Approval Pengajuan

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