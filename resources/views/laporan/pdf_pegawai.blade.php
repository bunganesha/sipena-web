<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">

    <title>Laporan Absensi Pegawai</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
        }

        h2,
        h4 {
            text-align: center;
            margin: 0;
        }

        .info {
            margin-top: 20px;
            margin-bottom: 20px;
        }

        .info table {
            width: 100%;
        }

        .info td {
            padding: 4px;
        }

        table.data {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        table.data th,
        table.data td {
            border: 1px solid #000;
            padding: 6px;
            text-align: center;
        }

        table.data th {
            background: #f2f2f2;
        }

        .rekap {
            margin-top: 20px;
            width: 40%;
        }

        .rekap td {
            padding: 4px;
        }

        .footer {
            margin-top: 60px;
            text-align: right;
        }
    </style>

</head>

<body>

    <h2>SIPENA</h2>

    <h4>LAPORAN ABSENSI PEGAWAI</h4>

    <div class="info">

        <table>

            <tr>

                <td width="130">Nama</td>

                <td>: {{ $pegawai->nama }}</td>

            </tr>

            <tr>

                <td>NIP</td>

                <td>: {{ $pegawai->nip }}</td>

            </tr>

            <tr>

                <td>Divisi</td>

                <td>: {{ $pegawai->divisi }}</td>

            </tr>

            <tr>

                <td>Periode</td>

                <td>:
                    {{ $bulan ? DateTime::createFromFormat('!m',$bulan)->format('F') : 'Semua Bulan' }}
                </td>

            </tr>

        </table>

    </div>

    <table class="data">

        <thead>

            <tr>

                <th>No</th>

                <th>Tanggal</th>

                <th>Masuk</th>

                <th>Keluar</th>

                <th>Status</th>

                <th>Keterangan</th>

            </tr>

        </thead>

        <tbody>

            @forelse($laporan as $item)

            <tr>

                <td>{{ $loop->iteration }}</td>

                <td>{{ $item->tanggal }}</td>

                <td>{{ $item->jam_masuk ?? '-' }}</td>

                <td>{{ $item->jam_keluar ?? '-' }}</td>

                <td>{{ ucfirst($item->status_absensi) }}</td>

                <td>{{ $item->keterangan ?? '-' }}</td>

            </tr>

            @empty

            <tr>

                <td colspan="6">

                    Tidak ada data.

                </td>

            </tr>

            @endforelse

        </tbody>

    </table>

    <table class="rekap">

        <tr>

            <td>Total Hadir</td>

            <td>: {{ $rekap['hadir'] }}</td>

        </tr>

        <tr>

            <td>Total Izin</td>

            <td>: {{ $rekap['izin'] }}</td>

        </tr>

        <tr>

            <td>Total Sakit</td>

            <td>: {{ $rekap['sakit'] }}</td>

        </tr>

        <tr>

            <td>Total Cuti</td>

            <td>: {{ $rekap['cuti'] }}</td>

        </tr>

        <tr>

            <td>Total Alpha</td>

            <td>: {{ $rekap['alpha'] }}</td>

        </tr>

    </table>

    <div class="footer">

        Bandung, {{ date('d F Y') }}

        <br><br><br><br>

        HRD

    </div>

</body>

</html>