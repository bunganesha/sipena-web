{{-- ========================= --}}
{{-- SUMMARY --}}
{{-- ========================= --}}

<div class="row row-deck row-cards">

    <div class="col-sm-4">

        <div class="card card-sm">

            <div class="card-body">

                <div class="d-flex align-items-center">

                    <span class="avatar bg-warning text-white me-3">

                        <i class="ti ti-hourglass"></i>

                    </span>

                    <div>

                        <div class="text-secondary">
                            Menunggu Persetujuan
                        </div>

                        <div class="fs-1 fw-bold text-warning">
                            {{ $pendingManager }}
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>


    <div class="col-sm-4">

        <div class="card card-sm">

            <div class="card-body">

                <div class="d-flex align-items-center">

                    <span class="avatar bg-success text-white me-3">

                        <i class="ti ti-circle-check"></i>

                    </span>

                    <div>

                        <div class="text-secondary">
                            Disetujui
                        </div>

                        <div class="fs-1 fw-bold text-success">
                            {{ $approveManager }}
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>


    <div class="col-sm-4">

        <div class="card card-sm">

            <div class="card-body">

                <div class="d-flex align-items-center">

                    <span class="avatar bg-danger text-white me-3">

                        <i class="ti ti-circle-x"></i>

                    </span>

                    <div>

                        <div class="text-secondary">
                            Ditolak
                        </div>

                        <div class="fs-1 fw-bold text-danger">
                            {{ $rejectManager }}
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

    {{-- LIST PENGAJUAN --}}
    <div class="col-lg-8">

        <div class="card">

            <div class="card-header">

                <h3 class="card-title">

                    Pengajuan Menunggu Persetujuan Manager

                </h3>

            </div>

            <div class="table-responsive">

                <table class="table table-vcenter">

                    <thead>

                        <tr>

                            <th>Pegawai</th>
                            <th>Jenis</th>
                            <th>Tanggal Mulai</th>
                            <th>Tanggal Selesai</th>
                            <th>Status SPV</th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($pengajuanManager as $item)

                            <tr>

                                <td>{{ $item->pegawai->nama }}</td>

                                <td>{{ ucfirst($item->jenis_pengajuan) }}</td>

                                <td>{{ $item->tanggal_mulai }}</td>

                                <td>{{ $item->tanggal_selesai }}</td>

                                <td>

                                    <span class="badge bg-success-lt">

                                        {{ ucfirst($item->status_spv) }}

                                    </span>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="5" class="text-center">

                                    Tidak ada pengajuan yang perlu diproses.

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

                <a href="{{ route('approval.index') }}"
                    class="list-group-item list-group-item-action">

                    ✅ Approval Pengajuan

                </a>

                <a href="{{ route('pengajuan.index') }}"
                    class="list-group-item list-group-item-action">

                    📄 Riwayat Pengajuan

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

                    Ringkasan Approval

                </h3>

            </div>

            <div class="list-group list-group-flush">

                <div class="list-group-item d-flex justify-content-between">

                    <span>🟡 Pending</span>

                    <span class="badge bg-warning">
                        {{ $pendingManager }}
                    </span>

                </div>

                <div class="list-group-item d-flex justify-content-between">

                    <span>🟢 Approved</span>

                    <span class="badge bg-success">
                        {{ $approveManager }}
                    </span>

                </div>

                <div class="list-group-item d-flex justify-content-between">

                    <span>🔴 Rejected</span>

                    <span class="badge bg-danger">
                        {{ $rejectManager }}
                    </span>

                </div>

            </div>

        </div>

    </div>

</div>