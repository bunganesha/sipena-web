<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'SIPENA')</title>

    <!-- Tabler CSS -->
    <link href="{{ asset('assets/css/tabler.min.css') }}" rel="stylesheet">

    <!-- Optional Icons -->
    <link href="{{ asset('assets/css/tabler-icons.min.css') }}" rel="stylesheet">

    @stack('styles')
</head>

<body>

<div class="page">

    {{-- Sidebar --}}
    @include('layouts.sidebar')

    <div class="page-wrapper">

        {{-- Navbar --}}
        @include('layouts.navbar')

        {{-- Header --}}
        <div class="page-header d-print-none">
            <div class="container-xl">

                <div class="row g-2 align-items-center">

                    <div class="col">
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

        {{-- Content --}}
        <div class="page-body">
            <div class="container-xl">
                @yield('content')
            </div>
        </div>

    </div>

</div>

<!-- Tabler JS -->
<script src="{{ asset('assets/js/tabler.min.js') }}"></script>

@stack('scripts')

</body>
</html>