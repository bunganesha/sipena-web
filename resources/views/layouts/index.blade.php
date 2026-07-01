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
                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible">
                        {{ session('success') }}
                        <button class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    @endif

                    @if(session('error'))
                    <div class="alert alert-danger alert-dismissible">
                        {{ session('error') }}
                        <button class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    @endif

                    @if($errors->any())
                    <div class="alert alert-danger alert-dismissible">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    @endif
                    
                    @yield('content')

                </div>

            </div>

        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="{{ asset('assets/js/tabler.min.js') }}"></script>

    @stack('scripts')
</body>

</html>