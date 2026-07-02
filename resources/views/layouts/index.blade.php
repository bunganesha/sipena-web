<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'SIPENA')</title>

    <link href="{{ asset('assets/css/tabler.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/tabler-icons.min.css') }}" rel="stylesheet">

    @stack('styles')
</head>

<body>

    <div class="page">

        {{-- TOP NAVBAR --}}
        @include('layouts.navbar')

        <div class="page-wrapper">

            {{-- PAGE HEADER --}}
            <div class="page-header d-print-none">
                <div class="container-xl">

                    <div class="row g-2 align-items-center">

                        <div class="col">

                            <div class="page-pretitle">
                                Sistem Informasi Pegawai
                            </div>

                            <h2 class="page-title">
                                @yield('page-title')
                            </h2>

                        </div>

                        <div class="col-auto ms-auto d-print-none">
                            @yield('page-action')
                        </div>

                    </div>

                </div>
            </div>

            {{-- CONTENT --}}
            <div class="page-body">

                <div class="container-xl">
                    {{-- ========================= --}}
                    {{-- GLOBAL ALERT --}}
                    {{-- ========================= --}}

                    @if(session('success'))

                    <div class="alert alert-success alert-dismissible" role="alert">

                        <div class="d-flex">

                            <div>

                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="icon alert-icon"
                                    width="24"
                                    height="24"
                                    viewBox="0 0 24 24"
                                    stroke-width="2"
                                    stroke="currentColor"
                                    fill="none"
                                    stroke-linecap="round"
                                    stroke-linejoin="round">

                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />

                                    <path d="M5 12l5 5l10 -10" />

                                </svg>

                            </div>

                            <div>

                                <strong>Berhasil!</strong>

                                <br>

                                {{ session('success') }}

                            </div>

                        </div>

                        <a class="btn-close" data-bs-dismiss="alert"></a>

                    </div>

                    @endif


                    @if(session('error'))

                    <div class="alert alert-danger alert-dismissible" role="alert">

                        <div class="d-flex">

                            <div>

                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="icon alert-icon"
                                    width="24"
                                    height="24"
                                    viewBox="0 0 24 24"
                                    stroke-width="2"
                                    stroke="currentColor"
                                    fill="none"
                                    stroke-linecap="round"
                                    stroke-linejoin="round">

                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />

                                    <path d="M12 9v4" />

                                    <path d="M12 16v.01" />

                                    <path d="M5 19h14" />

                                    <path d="M5 5h14" />

                                </svg>

                            </div>

                            <div>

                                <strong>Terjadi Kesalahan!</strong>

                                <br>

                                {{ session('error') }}

                            </div>

                        </div>

                        <a class="btn-close" data-bs-dismiss="alert"></a>

                    </div>

                    @endif


                    @if($errors->any())

                    <div class="alert alert-warning alert-dismissible" role="alert">

                        <div class="d-flex">

                            <div>

                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="icon alert-icon"
                                    width="24"
                                    height="24"
                                    viewBox="0 0 24 24"
                                    stroke-width="2"
                                    stroke="currentColor"
                                    fill="none"
                                    stroke-linecap="round"
                                    stroke-linejoin="round">

                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />

                                    <path d="M12 9v2" />

                                    <path d="M12 17v.01" />

                                    <path d="M5.07 19H19a2 2 0 0 0 1.75-2.97L13.75 4a2 2 0 0 0-3.5 0L3.25 16.03A2 2 0 0 0 5.07 19z" />

                                </svg>

                            </div>

                            <div>

                                <strong>Validasi Gagal!</strong>

                                <ul class="mb-0 mt-1">

                                    @foreach($errors->all() as $error)

                                    <li>{{ $error }}</li>

                                    @endforeach

                                </ul>

                            </div>

                        </div>

                        <a class="btn-close" data-bs-dismiss="alert"></a>

                    </div>

                    @endif

                    @yield('content')

                </div>

            </div>

        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="{{ asset('assets/js/tabler.min.js') }}"></script>

    <script>
        setTimeout(function() {

            document.querySelectorAll('.alert').forEach(function(alert) {

                bootstrap.Alert.getOrCreateInstance(alert).close();

            });

        }, 6000);
    </script>

    @stack('scripts')
</body>

</html>