<x-app-layout title="Kategori Transaksi">

    @section('title')
        Kategori Transaksi
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
                <th scope="col">Keterangan</th>
                <th scope="col">Dibuat</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @php
                $i = ($kategoritransaksi->currentPage() - 1) * $kategoritransaksi->perPage() + 1;
            @endphp
            @foreach ($kategoritransaksi as $item)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $item['nama'] }}</td>
                    <td>{{ $item['keterangan'] }}</td>
                    <td>{{ $item->created_at->toFormattedDateString() }}</td>
                    <td>
                        <button type="button" class="btn btn-sm btn-primary"
                            onclick="editKategoriTransaksi({{ $item->id }})"><i class="fas fa-edit"></i></button>
                        @role('super admin')
                            <button type="button" class="btn btn-sm btn-danger"
                                onclick="destroyKategoriTransaksi({{ $item->id }})"><i
                                    class="fas fa-trash-alt"></i></button>
                        @endrole
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="mt-3">
        {{ $kategoritransaksi->onEachSide(3)->links('pagination::bootstrap-4') }}
        <small>Displaying {{ $kategoritransaksi->count() }} Of {{ $kategoritransaksi->total() }}</small>
    </div>

    <div class="modalKategoriTransaksi"></div>

    <script>
        function editKategoriTransaksi(id) {
            $.ajax({
                type: "get",
                url: "{{ route('kategori-transaksi.edit', ' + id + ') }}",
                data: {
                    id_kategori: id
                },
                dataType: "json",
                success: function(response) {
                    $('.modalKategoriTransaksi').html(response.data);
                    $('#editKategoriTransaksi').modal('show');
                }
            });
        }

        function destroyKategoriTransaksi(id) {
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
                        url: "{{ route('kategori-transaksi.destroy', ' + id + ') }}",
                        data: {
                            _token: "{{ csrf_token() }}",
                            id_kategori: id
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
                            }, 1300);
                        }
                    });
                }
            });
        }

        $('#btnModalCreate').click(function(e) {
            e.preventDefault();
            $.ajax({
                type: "get",
                url: "{{ route('kategori-transaksi.create') }}",
                dataType: "json",
                success: function(response) {
                    $('.modalKategoriTransaksi').html(response.view);
                    $('#createKategoriTransaksi').modal('show');
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
