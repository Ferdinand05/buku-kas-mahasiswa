<h4>Pemasukan</h4>
<table style="border: 2px solid black">
    <thead>
        <tr>
            <th style="background-color: lightblue">No</th>
            <th style="background-color: lightblue">Invoice</th>
            <th style="background-color: lightblue">Total</th>
            <th style="background-color: lightblue">Nama</th>
            <th style="background-color: lightblue">Kategori</th>
            <th style="background-color: lightblue">Tanggal</th>
        </tr>
    </thead>
    <tbody>
        @php
            $i = 1;
        @endphp
        @foreach ($pemasukan as $item)
            <tr>
                <td style="text-align: center">{{ $i++ }}</td>
                <td>{{ $item->kode_transaksi }}</td>
                <td>{{ $item->total }}</td>
                <td>{{ $item->mahasiswa->nama }}</td>
                <td>{{ $item->kategoriTransaksi->nama }}</td>
                <td>{{ $item->created_at->format('d M Y') }}</td>
            </tr>
        @endforeach
    </tbody>
</table>


<h4>Pengeluaran</h4>
<table style="border: 2px solid black">
    <thead>
        <tr>
            <th style="background-color:salmon">No</th>
            <th style="background-color:salmon">Invoice</th>
            <th style="background-color:salmon">Total</th>
            <th style="background-color:salmon">Nama</th>
            <th style="background-color:salmon">Kategori</th>
            <th style="background-color:salmon">Tanggal</th>
        </tr>
    </thead>
    <tbody>
        @php
            $i = 1;
        @endphp
        @foreach ($pengeluaran as $item)
            <tr>
                <td style="text-align: center">{{ $i++ }}</td>
                <td>{{ $item->kode_transaksi }}</td>
                <td>{{ $item->total }}</td>
                <td>{{ $item->mahasiswa->nama }}</td>
                <td>{{ $item->kategoriTransaksi->nama }}</td>
                <td>{{ $item->created_at->format('d M Y') }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
