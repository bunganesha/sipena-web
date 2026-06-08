<!DOCTYPE html>
<html>
<head>
    <title>Laporan Absensi</title>
</head>
<body>

<h2>Laporan Absensi</h2>

<table border="1" cellpadding="5" cellspacing="0">
    <tr>
        <th>No</th>
        <th>Pegawai ID</th>
        <th>Tanggal</th>
        <th>Status</th>
        <th>Keterangan</th>
    </tr>

    @foreach($laporan as $item)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $item->pegawai_id }}</td>
        <td>{{ $item->tanggal }}</td>
        <td>{{ $item->status_absensi }}</td>
        <td>{{ $item->keterangan }}</td>
    </tr>
    @endforeach

</table>

</body>
</html>