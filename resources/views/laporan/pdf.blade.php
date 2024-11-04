<!DOCTYPE html>
<html>
<head>
    <title>Laporan Transaksi Belum Lunas</title>
    <style>
        /* Tambahkan CSS untuk styling PDF jika diperlukan */
    </style>
</head>
<body>
    <h1>Laporan Transaksi Belum Lunas</h1>
    <table border="1" cellspacing="0" cellpadding="5">
        <thead>
            <tr>
                <th>ID Transaksi</th>
                <th>Nama Pembeli</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transaksis as $transaksi)
                <tr>
                    <td>{{ $transaksi->id }}</td>
                    <td>{{ $transaksi->nama_pembeli }}</td>
                    <td>{{ $transaksi->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
