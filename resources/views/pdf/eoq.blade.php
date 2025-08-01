<!DOCTYPE html>
<html>
<head>
    <title>Laporan EOQ</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { border-collapse: collapse; width: 100%; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: center; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>

<h2>Laporan EOQ</h2>
<p>Dicetak oleh: {{ $top->name }}</p>
@if(!empty($deskripsi))
    <p><strong>Deskripsi:</strong> {{ $deskripsi }}</p>
@endif
<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Kode Barang</th>
            <th>Nama Bahan</th>
            <th>Demand</th>
            <th>Biaya Pesan</th>
            <th>Biaya Simpan</th>
            <th>EOQ</th>
            <th>TIC</th>
            <th>Frekuensi Pembelian</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $index => $item)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $item->code_barang }}</td>
            <td>{{ $item->nama_bahan }}</td>
            <td>{{ $item->demand }}</td>
            <td>{{ $item->biaya_pesan }}</td>
            <td>{{ $item->biaya_simpan }}</td>
            <td>{{ $item->nilai_eoq }}</td>
            <td>{{ $item->nilai_tic }}</td>
            <td>{{ $item->frekuensi_pembelian }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>
