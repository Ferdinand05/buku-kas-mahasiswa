<x-app-layout title="Laporan Transaksi">

    @section('title')
        Laporan Transaksi Pemasukan/Pengeluaran
    @endsection

    @section('card-title')
        <form action="{{ route('laporan-transaksi.pdf') }}" method="post">
            @csrf
            <div class="row ">
                <div class="col-md">
                    <label for="tanggal_awal" class="form-label">Tanggal Awal</label>
                    <input type="date" name="tanggal_awal" id="tanggal_awal" class="form-control">
                </div>
                <div class="col-md">
                    <label for="tanggal_akhir" class="form-label">Tanggal Akhir</label>
                    <input type="date" name="tanggal_akhir" id="tanggal_akhir" class="form-control">
                </div>
                <div class="col-md">
                    <label for="">Cetak PDF</label>
                    <div class="input-group">
                        <button class="btn btn-info " type="submit">Cetak PDF <i class="fas fa-file-pdf"></i></button>
                    </div>
                </div>
            </div>
        </form>
    @endsection

    <h5>Pemasukan - {{ $pemasukan->count() }}</h5>
    <table class="table table-bordered table-sm">
        <thead class="bg-primary">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Invoice</th>
                <th scope="col">Total</th>
                <th scope="col">Kategori</th>
                <th scope="col">Nama</th>
                <th scope="col">Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @php
                $i = 1;
            @endphp
            @foreach ($pemasukan as $item)
                <tr>
                    <th scope="row">{{ $i++ }}</th>
                    <td>{{ $item->kode_transaksi }}</td>
                    <td>{{ $item->total }}</td>
                    <td>{{ $item->kategoriTransaksi->nama }}</td>
                    <td>{{ $item->mahasiswa->nama }}</td>
                    <td>{{ $item->created_at->format('d M Y') }}</td>
                </tr>
            @endforeach


        </tbody>
    </table>
    <hr>

    <h5>Pengeluaran - {{ $pengeluaran->count() }}</h5>
    <table class="table table-bordered table-sm">
        <thead class="bg-danger">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Invoice</th>
                <th scope="col">Total</th>
                <th scope="col">Kategori</th>
                <th scope="col">Nama</th>
                <th scope="col">Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @php
                $i = 1;
            @endphp
            @foreach ($pengeluaran as $item)
                <tr>
                    <th scope="row">{{ $i++ }}</th>
                    <td>{{ $item->kode_transaksi }}</td>
                    <td>{{ $item->total }}</td>
                    <td>{{ $item->kategoriTransaksi->nama }}</td>
                    <td>{{ $item->mahasiswa->nama }}</td>
                    <td>{{ $item->created_at->format('d M Y') }}</td>
                </tr>
            @endforeach


        </tbody>
    </table>



</x-app-layout>
