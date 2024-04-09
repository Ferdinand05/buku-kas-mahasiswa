<div class="row">
    <div class="col">
        <h4><i class="fas fa-plus-circle"></i> Pemasukan</h4>
        <table class="table table-sm table-striped table-bordered">
            <thead class="bg-primary">
                <tr>
                    <th scope="col">Kode</th>
                    <th scope="col">Total</th>
                    <th scope="col">Kategori</th>
                    <th scope="col">Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $totalPemasukan = 0;
                @endphp
                @foreach ($pemasukan as $item)
                    <tr>
                        <th scope="row">{{ $item->kode_transaksi }}</th>
                        <td>{{ number_format($item->total, '0', ',', '.') }}</td>
                        <td>{{ $item->kategoriTransaksi->nama }}</td>
                        <td>{{ $item->created_at->format('d M Y') }}</td>
                    </tr>


                    @php
                        $totalPemasukan += $item->total;
                    @endphp
                @endforeach
                <tr>
                    <th class="text-center">Total</th>
                    <th colspan="3" class="text-center">{{ number_format($totalPemasukan, '0', ',', '.') }}</th>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="col">
        <h4> <i class="fas fa-minus-circle"></i> Pengeluaran</h4>
        <table class="table table-sm table-striped table-bordered">
            <thead class="bg-danger">
                <tr>
                    <th scope="col">Kode</th>
                    <th scope="col">Total</th>
                    <th scope="col">Kategori</th>
                    <th scope="col">Tanggal</th>
                </tr>
            </thead>
            <tbody>

                @php
                    $totalPengeluaran = 0;
                @endphp
                @foreach ($pengeluaran as $item)
                    <tr>
                        <th scope="row">{{ $item->kode_transaksi }}</th>
                        <td>{{ number_format($item->total, '0', ',', '.') }}</td>
                        <td>{{ $item->kategoriTransaksi->nama }}</td>
                        <td>{{ $item->created_at->format('d M Y') }}</td>
                    </tr>
                    @php
                        $totalPengeluaran = $totalPengeluaran + $item->total;
                    @endphp
                @endforeach
                <tr>
                    <th class="text-center">Total</th>
                    <th colspan="3" class="text-center">{{ number_format($totalPengeluaran, '0', ',', '.') }}
                    </th>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div>
    <h3>Cash : {{ number_format($totalPemasukan - $totalPengeluaran, '0', ',', '.') }}</h3>
</div>
