<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login SIPENA</title>

    <link href="{{ asset('assets/css/tabler.min.css') }}" rel="stylesheet">
</head>

<body class="d-flex flex-column">

<div class="page page-center">

    <div class="container container-tight py-4">

        <div class="text-center mb-4">

            <h1 class="text-primary fw-bold">
                SIPENA
            </h1>

            <div class="text-secondary">
                Sistem Informasi Pengelolaan Absensi dan Cuti Pegawai
            </div>

        </div>

        <div class="card card-md shadow-sm">

            <div class="card-body">

                <h2 class="card-title text-center mb-4">
                    Login
                </h2>

                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                <form action="{{ route('login') }}" method="POST">

                    @csrf
                    @csrf

                    <div class="mb-3">

                        <label class="form-label">
                            Username
                        </label>

                        <input type="text"
                            name="username"
                            class="form-control"
                            placeholder="Masukkan username"
                            required>

                    </div>
                    </div>

                    <div class="mb-3">

                        <label class="form-label">
                            Password
                        </label>

                        <input type="password"
                            name="password"
                            class="form-control"
                            placeholder="Masukkan password"
                            required>

                    </div>
                    </div>

                    <div class="form-footer">

                        <button type="submit"
                            class="btn btn-primary w-100">

                            Login
                            Login

                        </button>
                        </button>

                    </div>

                </form>
                    </div>

                </form>

            </div>
            </div>

        </div>
        </div>

    </div>
    </div>

</div>

<script src="{{ asset('assets/js/tabler.min.js') }}"></script>

</body>
</html>