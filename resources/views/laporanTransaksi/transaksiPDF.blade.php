<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Transaksi Masuk & Keluar</title>

    <style>
        body {
            font-family: sans-serif;
        }
    </style>

</head>

<body>

    <div class="header">
        <h5>Laporan Transaksi</h5>
        @if ($tanggal_awal || $tanggal_akhir)
            dari Tanggal {{ $tanggal_awal }} sampai
            {{ $tanggal_akhir }}
        @else
            Keseluruhan
        @endif
    </div>
    <hr>
    <br>
    <h4>Pemasukan</h4>
    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>#</th>
                <th>Invoice</th>
                <th>Total</th>
                <th>Kategori</th>
                <th>Nama</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @php
                $i = 1;
                $totalPemasukan = 0;
            @endphp
            @foreach ($pemasukan as $item)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $item->kode_transaksi }}</td>
                    <td>{{ number_format($item->total, '0', ',', '.') }}</td>
                    <td>{{ $item->kategoriTransaksi->nama }}</td>
                    <td>{{ $item->mahasiswa->nama }}</td>
                    <td>{{ $item->created_at->format('d M Y') }}</td>
                </tr>


                @php
                    $totalPemasukan += $item->total;
                @endphp
            @endforeach
            <tr>
                <td colspan="2">Pemasukan</td>
                <td colspan="4" style="text-align: center">{{ number_format($totalPemasukan, '0', ',', '.') }}</td>
            </tr>
        </tbody>
    </table>
    <br>
    <hr>
    <br>
    <h4>Pengeluaran</h4>
    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>#</th>
                <th>Invoice</th>
                <th>Total</th>
                <th>Kategori</th>
                <th>Nama</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @php
                $i = 1;
                $totalPengeluaran = 0;
            @endphp
            @foreach ($pengeluaran as $item)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $item->kode_transaksi }}</td>
                    <td>{{ number_format($item->total, '0', ',', '.') }}</td>
                    <td>{{ $item->kategoriTransaksi->nama }}</td>
                    <td>{{ $item->mahasiswa->nama }}</td>
                    <td>{{ $item->created_at->format('d M Y') }}</td>
                </tr>

                @php
                    $totalPengeluaran += $item->total;
                @endphp
            @endforeach
            <tr>
                <td colspan="2">Pengeluaran</td>
                <td colspan="4" style="text-align: center">{{ number_format($totalPengeluaran, '0', ',', '.') }}
                </td>
            </tr>
        </tbody>
    </table>
    <br>
    <h4>Jumlah : {{ number_format($totalPemasukan - $totalPengeluaran, '0', ',', '.') }}</h4>

</body>

</html>
