<!DOCTYPE html>
<html>

<head>
    <title>Laporan Hasil Produksi</title>
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
            text-align: left;
        }
    </style>
</head>

<body>
    <h2 align="center">Laporan Hasil Produksi</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Mesin</th>
                <th>Nama Operator</th>
                <th>Nama Produk</th>
                <th>Acuan Sampling</th>
                <th>AQL Check</th>
                <th>Status Produk</th>
                <th>Temuan Defect</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $index => $row)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $row->tanggal }}</td>
                    <td>{{ $row->mesin }}</td>
                    <td>{{ $row->nama_operator }}</td>
                    <td>{{ $row->masterProduk->nama_produk ?? '-' }}</td>
                    <td>{{ $row->acuan_sampling }}</td>
                    <td>{{ $row->aql_check }}</td>
                    <td>{{ $row->status_produk }}</td>
                    <td>{{ $row->temuan_defect }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
