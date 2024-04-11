<table>
    <thead>
        <tr>
            <th>No.</th>
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
                <td>{{ $m->jurusanMahasiswa->jurusan }}</td>
                <td>{{ $m->alamat }}</td>
                <td>{{ $m->no_telp }}</td>
                <td>{{ $m->created_at->format('d M Y') }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
