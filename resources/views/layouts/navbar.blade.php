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

                    <a href="/logout" class="dropdown-item text-danger">

                        Logout

                    </a>

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


                    {{-- HRD --}}
                    @if (session('role') == 'hrd')
                        {{-- MASTER DATA --}}
                        <li class="nav-item dropdown">

                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">

                                Master Data

                            </a>

                            <ul class="dropdown-menu">

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


                        {{-- TRANSAKSI --}}
                        <li class="nav-item dropdown">

                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">

                                Transaksi

                            </a>

                            <ul class="dropdown-menu">

                                <li>

                                    <a class="dropdown-item" href="/absensi">

                                        Data Absensi

                                    </a>

                                </li>

                                <li>

                                    <a class="dropdown-item" href="/pengajuan">

                                        Pengajuan

                                    </a>

                                </li>

                                <li>

                                    <a class="dropdown-item" href="/approval">

                                        Approval

                                    </a>

                                </li>

                            </ul>

                        </li>


                        {{-- LAPORAN --}}
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


                    {{-- PEGAWAI --}}
                    @if (session('role') == 'pegawai')
                        <li class="nav-item">

                            <a class="nav-link {{ request()->is('pengajuan') ? 'active' : '' }}" href="/pengajuan">

                                <span class="nav-link-icon d-md-none d-lg-inline-block">
                                    📨
                                </span>

                                <span class="nav-link-title">
                                    Pengajuan
                                </span>

                            </a>

                        </li>
                    @endif


                    {{-- SPV & MANAGER --}}
                    @if (session('role') == 'spv' || session('role') == 'manager')
                        <li class="nav-item">

                            <a class="nav-link {{ request()->is('approval') ? 'active' : '' }}" href="/approval">

                                <span class="nav-link-icon d-md-none d-lg-inline-block">
                                    ✅
                                </span>

                                <span class="nav-link-title">
                                    Approval
                                </span>

                            </a>

                        </li>
                    @endif

                </ul>

            </div>

        </div>

    </div>

</header>
