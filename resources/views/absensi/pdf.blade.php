<!DOCTYPE html>
<html>

<head>

    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid black;
            padding: 6px;
            text-align: center;
        }
    </style>

</head>

<body>

    <h2>
        Laporan Absensi Pegawai
    </h2>

    <p>

        <b>Nama :</b>

        {{ $pegawai->nama }}

        <br>

        <b>NIP :</b>

        {{ $pegawai->nip }}

        <br>

        <b>Bulan :</b>

        {{ date('F Y', strtotime($bulan)) }}

    </p>

    <table>

        <tr>

            <th>No</th>

            <th>Tanggal</th>

            <th>Masuk</th>

            <th>Keluar</th>

            <th>Status</th>

        </tr>

        @foreach($absensis as $item)

        <tr>

            <td>

                {{ $loop->iteration }}

            </td>

            <td>

                {{ $item->tanggal }}

            </td>

            <td>

                {{ $item->jam_masuk ?? '-' }}

            </td>

            <td>

                {{ $item->jam_keluar ?? '-' }}

            </td>

            <td>

                {{ ucfirst($item->status_absensi) }}

            </td>

        </tr>

        @endforeach

    </table>

</body>

</html>