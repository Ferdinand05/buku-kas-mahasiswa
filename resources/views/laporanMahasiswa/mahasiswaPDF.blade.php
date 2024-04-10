<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Mahasiswa - PDF</title>

    <style>
        body {
            font-family: sans-serif;
        }
    </style>

</head>

<body>
    <div class="header">
        <h4>Laporan Mahasiswa</h4>
        @if ($jurusan)
            <p>Dari Jurusan {{ $jurusan->jurusan }} <br> {{ $mahasiswa->count() }} Mahasiswa</p>
        @else
            <p>Dari Semua Jurusan <br> {{ $mahasiswa->count() }} Mahasiswa</p>
        @endif
    </div>
    <hr>
    <br>
    <table border="1" cellpadding="5" cellspacing="0">
        <caption>
            {{ date('d M Y') }}
        </caption>
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

</body>

</html>
