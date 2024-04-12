<x-app-layout title="Mahasiswa">

    @section('title')
        <i class="fas fa-user-graduate"></i> Mahasiswa
    @endsection

    @section('card-title')
        <button class="btn btn-sm btn-success" id="btnModalCreate"> Create
            <i class="fas fa-plus fa-sm">
            </i></button>
        <div class="row  my-2">
            <div class="col-md-7">
                <form action="" method="get">
                    <div class="input-group">
                        <input type="text" name="keyword" class="form-control" placeholder="Cari Mahasiswa..."
                            aria-describedby="button-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit" id="button-addon2"><i
                                    class="fas fa-search"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endsection


    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">NIM</th>
                <th scope="col">Nama</th>
                <th scope="col">Jurusan</th>
                <th scope="col">Alamat</th>
                <th scope="col">Telepon</th>
                <th scope="col">Dibuat</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @php
                $i = ($mahasiswa->currentPage() - 1) * $mahasiswa->perPage() + 1;
            @endphp
            @foreach ($mahasiswa as $item)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $item->nim }}</td>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->jurusanMahasiswa?->jurusan }}</td>
                    <td>{{ $item->alamat }}</td>
                    <td>{{ $item->no_telp }}</td>
                    <td>{{ $item->created_at->format('d-m-Y') }}</td>
                    <td>
                        <button type="button" class="btn btn-sm btn-primary"
                            onclick="editMahasiswa({{ $item->nim }})"><i class="fas fa-edit"></i></button>
                        @role('super admin')
                            <button type="button" class="btn btn-sm btn-danger"
                                onclick="destroyMahasiswa({{ $item->nim }})"><i class="fas fa-trash-alt"></i></button>
                        @endrole
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="mt-3">
        {{ $mahasiswa->onEachSide(3)->links('pagination::bootstrap-4') }}
        <small>Displaying {{ $mahasiswa->count() }} Of {{ $mahasiswa->total() }}</small>
    </div>

    <div class="modalMahasiswa"></div>

    <script>
        function editMahasiswa(nim) {
            $.ajax({
                type: "get",
                url: "{{ route('mahasiswa.edit', ' + nim + ') }}",
                data: {
                    nim: nim
                },
                dataType: "json",
                success: function(response) {
                    $('.modalMahasiswa').html(response.data);
                    $('#editMahasiswa').modal('show');
                }
            });
        }

        function destroyMahasiswa(nim) {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "delete",
                        url: "{{ route('mahasiswa.destroy', ' + nim + ') }}",
                        data: {
                            _token: "{{ csrf_token() }}",
                            nim: nim
                        },
                        dataType: "json",
                        success: function(response) {
                            if (response.success) {
                                Swal.fire({
                                    position: "center",
                                    icon: "success",
                                    title: response.success,
                                    showConfirmButton: false,
                                    timer: 1200
                                });

                                setTimeout(() => {
                                    window.location.reload();
                                }, 1200);
                            }

                            if (response.error) {
                                Swal.fire({
                                    title: "Ooops!",
                                    text: response.error,
                                    icon: "error"
                                });
                            }


                        }
                    });
                }
            });
        }

        $('#btnModalCreate').click(function(e) {
            e.preventDefault();
            $.ajax({
                type: "get",
                url: "{{ route('mahasiswa.create') }}",
                dataType: "json",
                success: function(response) {
                    $('.modalMahasiswa').html(response.view);
                    $('#createMahasiswa').modal('show');
                }
            });
        });



        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


        });
    </script>


</x-app-layout>
