<header class="navbar navbar-expand-md d-print-none">
    <div class="container-xl">

        {{-- Toggle Sidebar Mobile --}}
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar-menu">
            <span class="navbar-toggler-icon"></span>
        </button>

        {{-- Right Navbar --}}
        <div class="navbar-nav flex-row order-md-last ms-auto">

            {{-- Notification --}}
            <div class="nav-item dropdown d-none d-md-flex me-3">
                <a href="#" class="nav-link px-0" data-bs-toggle="dropdown" tabindex="-1">

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

                        <path d="M10 5a2 2 0 1 1 4 0c0 .628 .134 1.197 .374 1.688l.707 1.414a2 2 0 0 0 .895 .895l1.414 .707c.491 .24 1.06 .374 1.688 .374a2 2 0 1 1 0 4c-.628 0-1.197 .134-1.688 .374l-1.414 .707a2 2 0 0 0-.895 .895l-.707 1.414c-.24 .491-.374 1.06-.374 1.688a2 2 0 1 1 -4 0c0-.628-.134-1.197-.374-1.688l-.707-1.414a2 2 0 0 0-.895-.895l-1.414-.707c-.491-.24-1.06-.374-1.688-.374a2 2 0 1 1 0-4c.628 0 1.197-.134 1.688-.374l1.414-.707a2 2 0 0 0 .895-.895l.707-1.414c.24-.491 .374-1.06 .374-1.688"/>
                    </svg>

                </a>
            </div>

            {{-- Profile --}}
            <div class="nav-item dropdown">

                <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown">

                    <span class="avatar avatar-sm bg-primary text-white">
                        A
                    </span>

                    <div class="d-none d-xl-block ps-2">

                        <div>
                            Admin HRD
                        </div>

                        <div class="mt-1 small text-secondary">
                            Administrator
                        </div>

                    </div>

                </a>

                {{-- Dropdown --}}
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">

                    <a href="#" class="dropdown-item">
                        Profile
                    </a>

                    <a href="#" class="dropdown-item">
                        Settings
                    </a>

                    <div class="dropdown-divider"></div>

                    <a href="#" class="dropdown-item text-danger">
                        Logout
                    </a>

                </div>

            </div>

        </div>

    </div>
</header>