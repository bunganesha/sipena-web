<aside class="navbar navbar-vertical navbar-expand-lg navbar-dark sidebar-custom">
    <div class="container-fluid">

        {{-- Toggle Mobile --}}
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar-menu">
            <span class="navbar-toggler-icon"></span>
        </button>

        {{-- Logo --}}
        <h1 class="navbar-brand navbar-brand-autodark py-3">
            <a href="/" class="text-decoration-none brand-text">
                SIPENA
            </a>
        </h1>

        {{-- Sidebar Menu --}}
        <div class="collapse navbar-collapse" id="sidebar-menu">

            <ul class="navbar-nav pt-2">

                {{-- Dashboard --}}
                <li class="nav-item">
                    <a class="nav-link active" href="/">

                        <span class="nav-link-icon">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="icon"
                                 width="24"
                                 height="24"
                                 viewBox="0 0 24 24"
                                 stroke-width="2"
                                 stroke="currentColor"
                                 fill="none"
                                 stroke-linecap="round"
                                 stroke-linejoin="round">

                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M4 4h6v8h-6z"/>
                                <path d="M14 4h6v4h-6z"/>
                                <path d="M14 12h6v8h-6z"/>
                                <path d="M4 16h6v4h-6z"/>
                            </svg>
                        </span>

                        <span class="nav-link-title">
                            Dashboard
                        </span>

                    </a>
                </li>

                {{-- Data Pegawai --}}
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <span class="nav-link-icon">
                            👥
                        </span>

                        <span class="nav-link-title">
                            Data Pegawai
                        </span>
                    </a>
                </li>

                {{-- Absensi --}}
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <span class="nav-link-icon">
                            📅
                        </span>

                        <span class="nav-link-title">
                            Absensi
                        </span>
                    </a>
                </li>

                {{-- Pengajuan --}}
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <span class="nav-link-icon">
                            📨
                        </span>

                        <span class="nav-link-title">
                            Pengajuan
                        </span>
                    </a>
                </li>

                {{-- Laporan --}}
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <span class="nav-link-icon">
                            📊
                        </span>

                        <span class="nav-link-title">
                            Laporan
                        </span>
                    </a>
                </li>

            </ul>

        </div>

    </div>
</aside>

<style>

    /* SIDEBAR */
    .sidebar-custom {

        background: linear-gradient(
            180deg,
            #17344dff 0%,
            #112b52ff 55%,
            #202a39ff 100%
        ) !important;

        box-shadow: 4px 0 18px rgba(0,0,0,0.06);
    }

    /* BRAND */
    .brand-text {

        color: #ffffffff !important;

        font-size: 24px;

        font-weight: 700;

        letter-spacing: 1px;
    }

    /* MENU */
    .sidebar-custom .nav-link {

        color: rgba(255,255,255,0.88) !important;

        margin-bottom: 8px;

        border-radius: 14px;

        padding: 12px 14px;

        transition: all 0.25s ease;
    }

    /* HOVER */
    .sidebar-custom .nav-link:hover {

        background-color: rgba(255, 236, 179, 0.18);

        color: #FFF7D6 !important;

        transform: translateX(3px);
    }

    /* ACTIVE MENU */
    .sidebar-custom .nav-link.active {

        background: linear-gradient(
            135deg,
            #efcf6fff,
            #d3b354ff
        );

        color: #000000ff !important;

        font-weight: 700;

        box-shadow: 0 4px 10px rgba(246, 215, 118, 0.25);
    }

    /* ACTIVE ICON */
    .sidebar-custom .nav-link.active .icon {
        color: #000000ff !important;
    }

    /* ICON */
    .sidebar-custom .icon {
        opacity: 0.9;
    }

</style>