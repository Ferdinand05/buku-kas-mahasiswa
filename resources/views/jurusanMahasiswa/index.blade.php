<x-app-layout title="Jurusan Mahasiswa">

    @section('title')
        Jurusan Mahasiswa
    @endsection

    @section('card-title')
        <button class="btn btn-sm btn-success" id="btnModalCreate"> Create
            <i class="fas fa-plus fa-sm">
            </i></button>
    @endsection


    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nama</th>
                <th scope="col">Terdaftar</th>
                <th scope="col">Dibuat</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @php
                $i = ($jurusan->currentPage() - 1) * $jurusan->perPage() + 1;
            @endphp
            @foreach ($jurusan as $item)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $item['nama'] }}</td>
                    <td>{{ $item->mahasiswa->count() }}</td>
                    <td>{{ $item->created_at->toFormattedDateString() }}</td>
                    <td>
                        <button type="button" class="btn btn-sm btn-primary"
                            onclick="editJurusanMahasiswa({{ $item->id }})"><i class="fas fa-edit"></i></button>
                        <button type="button" class="btn btn-sm btn-danger"
                            onclick="destroyJurusanMahasiswa({{ $item->id }})"><i
                                class="fas fa-trash-alt"></i></button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="mt-3">
        {{ $jurusan->onEachSide(3)->links('pagination::bootstrap-4') }}
        <small>Displaying {{ $jurusan->count() }} of {{ $jurusan->total() }}</small>
    </div>

    <div class="modalJurusanMahasiswa"></div>

    <script>
        function editJurusanMahasiswa(id) {
            $.ajax({
                type: "get",
                url: "{{ route('jurusan-mahasiswa.edit', ' + id + ') }}",
                data: {
                    id_jurusan: id
                },
                dataType: "json",
                success: function(response) {
                    $('.modalJurusanMahasiswa').html(response.data);
                    $('#editJurusanMahasiswa').modal('show');
                }
            });
        }

        function destroyJurusanMahasiswa(id) {
            console.log(id);
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
                        url: "{{ route('jurusan-mahasiswa.destroy', ' + id + ') }}",
                        data: {
                            _token: "{{ csrf_token() }}",
                            id_jurusan: id
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
                            }

                            setTimeout(() => {
                                window.location.reload();
                            }, 1200);
                        }
                    });
                }
            });
        }

        $('#btnModalCreate').click(function(e) {
            e.preventDefault();
            $.ajax({
                type: "get",
                url: "{{ route('jurusan-mahasiswa.create') }}",
                dataType: "json",
                success: function(response) {
                    $('.modalJurusanMahasiswa').html(response.view);
                    $('#createJurusanMahasiswa').modal('show');
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
