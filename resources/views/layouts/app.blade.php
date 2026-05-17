<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Absensi</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>

        body{
            background:#f4f6f9;
        }

        .sidebar{
            width:250px;
            height:100vh;
            background:#0d1b2a;
            position:fixed;
            color:white;
            padding-top:20px;
        }

        .sidebar a{
            display:block;
            color:white;
            padding:15px 20px;
            text-decoration:none;
        }

        .sidebar a:hover{
            background:#1b263b;
        }

        .content{
            margin-left:250px;
            padding:20px;
        }

        .card-dashboard{
            border:none;
            border-radius:15px;
            box-shadow:0 2px 10px rgba(0,0,0,0.1);
        }

    </style>

</head>

<body>

<div class="sidebar">

    <h4 class="text-center mb-4">
        PT. XYZ
    </h4>

    <a href="/dashboard">Dashboard</a>
    <a href="/pegawai">Data Pegawai</a>
    <a href="/absensi">Absensi</a>
    <a href="/pengajuan">Pengajuan</a>

</div>

<div class="content">

    @yield('content')

</div>

</body>
</html>