<x-app-layout title="Laporan Mahasiswa">
    @section('title')
        Laporan Mahasiswa
    @endsection

    @section('card-title')
        <form action="{{ route('laporan-mahasiswa.pdf') }}" method="post">
            @csrf
            <div class="row">
                <div class="col-md">
                    <label for="filter_jurusan">Cetak Sesuai Jurusan</label>
                    <select name="filter_jurusan" id="filter_jurusan" class="form-control">
                        <option value="" selected disabled>Pilih Jurusan</option>
                        @foreach ($jurusan as $j)
                            <option value="{{ $j->id }}">{{ $j->jurusan }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md">
                    <label for="">Cetak PDF</label>
                    <div class="input-group">
                        <button type="submit" class="btn btn-primary">Print PDF <i class="fas fa-file-pdf"></i></button>
                    </div>
                </div>
            </div>
        </form>
        <div class="mt-3">
            <form action="{{ route('laporan-mahasiswa.export') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md">
                        <label for="filter_jurusan">Export Sesuai Jurusan</label>
                        <select name="filter_jurusan" id="filter_jurusan" class="form-control">
                            <option value="" selected disabled>Pilih Jurusan</option>
                            @foreach ($jurusan as $j)
                                <option value="{{ $j->id }}">{{ $j->jurusan }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md">
                        <label for="">Export Excel</label>
                        <div class="input-group">
                            <button type="submit" class="btn btn-danger">Export Excel <i
                                    class="fas fa-file-excel"></i></button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    @endsection

    <table class="table table-bordered table-sm">
        <thead>
            <tr>
                <th>#</th>
                <th>NIM</th>
                <th>Nama</th>
                <th>Jurusan</th>
                <th>Alamat</th>
                <th>Telepon</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @php
                $i = 1;
            @endphp
            @foreach ($mahasiswa as $m)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $m->nim }}</td>
                    <td>{{ $m->nama }}</td>
                    <td>{{ $m->jurusanMahasiswa?->jurusan }}</td>
                    <td>{{ $m->alamat }}</td>
                    <td>{{ $m->no_telp }}</td>
                    <td>{{ $m->created_at->format('d-m-Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</x-app-layout>
