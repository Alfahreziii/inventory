<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Pengeluaran</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        table, th, td { border: 1px solid black; padding: 8px; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h2>Laporan Pengeluaran Bahan Baku</h2>
    <p>Bulan: {{ DateTime::createFromFormat('!m', $bulan)->format('F') }} - Tahun: {{ $tahun }}</p>

    @if(!empty($deskripsi))
    <p><strong>Deskripsi:</strong> {{ $deskripsi }}</p>
@endif


    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Code Bahan Baku</th>
                <th>Nama Bahan</th>
                <th>Jumlah</th>
                <th>Tanggal Keluar</th>
                <th>Petugas</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pengeluarans as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->namabahan->code_barang ?? '-' }}</td>
                    <td>{{ $item->namabahan->nama_bahan ?? '-' }}</td>
                    <td>{{ $item->jumlah }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->getRawOriginal('tgl_keluar'))->format('d-m-Y') }}</td>
                    <td>{{ $item->user->name ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
