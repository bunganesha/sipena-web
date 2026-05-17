<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>SIPENA</title>

    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">

    <style>

        body{
            background: linear-gradient(
                135deg,
                #0f172a,
                #1e293b
            );

            height:100vh;
            display:flex;
            justify-content:center;
            align-items:center;
        }

        .login-box{
            width:380px;
        }

        .card{
            border:none;
            border-radius:20px;
            overflow:hidden;
            box-shadow:0 10px 30px rgba(0,0,0,0.3);
        }

        .card-body{
            padding:40px;
        }

        .logo{
            text-align:center;
            color:white;
            font-size:45px;
            font-weight:bold;
            margin-bottom:25px;
            letter-spacing:3px;
        }

        .form-control{
            height:50px;
            border-radius:12px;
        }

        .btn-login{
            height:50px;
            border-radius:12px;
            font-weight:bold;
            font-size:16px;
            background:#2563eb;
            border:none;
        }

        .btn-login:hover{
            background:#1d4ed8;
        }

    </style>

</head>

<body>

<div class="login-box">

    <div class="logo">
        SIPENA
    </div>

    <div class="card">

        <div class="card-body">

            @if(session('error'))

                <div class="alert alert-danger">

                    {{ session('error') }}

                </div>

            @endif

            <form action="/proses-login"
                  method="POST">

                @csrf

                <div class="form-group mb-3">

                    <input type="text"
                           name="username"
                           class="form-control"
                           placeholder="Username">

                </div>

                <div class="form-group mb-4">

                    <input type="password"
                           name="password"
                           class="form-control"
                           placeholder="Password">

                </div>

                <button class="btn btn-primary btn-block btn-login">

                    Login

                </button>

            </form>

        </div>

    </div>

</div>

</body>
</html>