<header class="navbar navbar-expand-md navbar-light d-print-none border-bottom bg-white">

    <div class="container-xl">

        {{-- MOBILE TOGGLE --}}
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu">

            <span class="navbar-toggler-icon"></span>

        </button>


        {{-- BRAND --}}
        <h1 class="navbar-brand navbar-brand-autodark pe-0 pe-md-4">

            <a href="/dashboard" class="text-decoration-none d-flex align-items-center">

                <span class="avatar avatar-sm bg-primary text-white me-2">
                    S
                </span>

                <div>

                    <div class="fw-bold text-primary">
                        SIPENA
                    </div>

                    <div class="small text-secondary">
                        Sistem Absensi Pegawai
                    </div>

                </div>

            </a>

        </h1>


        {{-- RIGHT MENU --}}
        <div class="navbar-nav flex-row order-md-last">

            {{-- NOTIFICATION --}}
            <div class="nav-item dropdown d-none d-md-flex me-3">

                <a href="#" class="nav-link px-0" data-bs-toggle="dropdown" tabindex="-1"
                    aria-label="Show notifications">

                    <span class="badge bg-red"></span>

                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                        stroke-linejoin="round">

                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />

                        <path
                            d="M10 5a2 2 0 1 1 4 0c0 .628 .134 1.197 .374 1.688l.707 1.414a2 2 0 0 0 .895 .895l1.414 .707c.491 .24 1.06 .374 1.688 .374a2 2 0 1 1 0 4c-.628 0-1.197 .134-1.688 .374l-1.414 .707a2 2 0 0 0-.895 .895l-.707 1.414c-.24 .491-.374 1.06-.374 1.688a2 2 0 1 1 -4 0c0-.628-.134-1.197-.374-1.688l-.707-1.414a2 2 0 0 0-.895-.895l-1.414-.707c-.491-.24-1.06-.374-1.688-.374a2 2 0 1 1 0-4c.628 0 1.197-.134 1.688-.374l1.414-.707a2 2 0 0 0 .895-.895l.707-1.414c.24-.491 .374-1.06 .374-1.688" />

                    </svg>

                </a>

            </div>

            {{-- PROFILE --}}
            <div class="nav-item dropdown">

                <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown">

                    <span class="avatar avatar-sm bg-primary text-white">

                        {{ strtoupper(substr(session('username'), 0, 1)) }}

                    </span>

                    <div class="d-none d-xl-block ps-2">

                        <div>
                            {{ session('username') }}
                        </div>

                        <div class="mt-1 small text-secondary">
                            {{ strtoupper(session('role')) }}
                        </div>

                    </div>

                </a>


                {{-- DROPDOWN --}}
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">

                    <a href="#" class="dropdown-item">

                        Profile

                    </a>

                    <a href="#" class="dropdown-item">

                        Settings

                    </a>
                    <div class="dropdown-divider"></div>
                    {{-- LOGOUT --}}
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf

                        <button type="submit"
                            class="dropdown-item text-danger border-0 bg-transparent w-100 text-start">

                            Logout

                        </button>
                    </form>
                </div>
            </div>
        </div>
        {{-- NAVIGATION MENU --}}
        <div class="collapse navbar-collapse" id="navbar-menu">
            <div class="d-flex flex-column flex-md-row flex-fill align-items-stretch align-items-md-center">
                <ul class="navbar-nav">
                    {{-- DASHBOARD --}}
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}" href="/dashboard">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                📊
                            </span>
                            <span class="nav-link-title">
                                Dashboard
                            </span>
                        </a>
                    </li>
                    {{-- MASTER DATA --}}
                    @if (session('role') == 'hrd')
                        <li class="nav-item dropdown">

                            <a class="nav-link dropdown-toggle" href="#" id="masterDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">

                                <span class="nav-link-icon d-md-none d-lg-inline-block">
                                    👨‍💼
                                </span>

                                <span class="nav-link-title">
                                    Master Data
                                </span>

                            </a>

                            <ul class="dropdown-menu" aria-labelledby="masterDropdown">

                                <li>
                                    <a class="dropdown-item" href="/pegawai">

                                        Data Pegawai

                                    </a>
                                </li>

                                <li>
                                    <a class="dropdown-item" href="/user">

                                        Data User

                                    </a>
                                </li>

                            </ul>

                        </li>
                    @endif
                    {{-- TRANSAKSI --}}
                    <li class="nav-item dropdown">

                        <a class="nav-link dropdown-toggle" href="#" id="transaksiDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">

                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                📅
                            </span>

                            <span class="nav-link-title">
                                Transaksi
                            </span>

                        </a>

                        <ul class="dropdown-menu" aria-labelledby="transaksiDropdown">

                            {{-- HRD --}}
                            @if (session('role') == 'hrd')
                                <li>
                                    <a class="dropdown-item" href="/absensi">

                                        Data Absensi

                                    </a>
                                </li>

                                <li>
                                    <a class="dropdown-item" href="/approval">

                                        Approval

                                    </a>
                                </li>
                            @endif

                            @if (session('role') == 'pegawai')
                                <li>
                                    <a class="dropdown-item" href="/pengajuan">

                                        Pengajuan

                                    </a>
                                </li>

                                <li>
                                    <a class="dropdown-item" href="/absensi-saya">

                                        Absensi Saya

                                    </a>
                                </li>
                            @endif

                            {{-- MANAGER & SPV --}}
                            @if (session('role') == 'manager' || session('role') == 'spv')
                                <li>
                                    <a class="dropdown-item" href="/approval">

                                        Approval

                                    </a>
                                </li>
                            @endif

                        </ul>

                    </li>

                    {{-- LAPORAN --}}
                    @if (session('role') == 'hrd')
                        <li class="nav-item">

                            <a class="nav-link {{ request()->is('laporan') ? 'active' : '' }}" href="/laporan">

                                <span class="nav-link-icon d-md-none d-lg-inline-block">
                                    📄
                                </span>

                                <span class="nav-link-title">
                                    Laporan
                                </span>

                            </a>

                        </li>
                    @endif

                </ul>

            </div>

        </div>

    </div>

</header>

{{-- BOOTSTRAP JS --}}

<script src="{{ asset('assets/js/tabler.min.js') }}"></script>