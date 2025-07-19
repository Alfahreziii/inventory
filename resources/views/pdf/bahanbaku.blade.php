<!DOCTYPE html>
<html>
<head>
    <title>Laporan Bahan Baku</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #000;
            padding: 5px;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <h2>Laporan Masuk Bahan Baku - {{ $bulan }} {{ $tahun }}</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Barang</th>
                <th>Nama Bahan</th>
                <th>Tanggal Masuk</th>
                <th>Jumlah Bahan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $i => $item)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $item->code_barang }}</td>
                    <td>{{ $item->nama_bahan }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->tgl_masuk)->format('d-m-Y') }}</td>
                    <td>{{ $item->sisa }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
