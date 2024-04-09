<x-app-layout title="Transaksi">

    @section('title')
        <i class="fas fa-comments-dollar"></i> Transaksi
    @endsection

    @section('card-title')
        <button type="button" id="btnModalCreateTransaksi" class="btn btn-success btn-sm">Create <i
                class="fas fa-plus"></i></button>
        <div class="row  my-2">
            <div class="col-md-7">
                <form action="" method="get">
                    <div class="input-group">
                        <input type="text" name="keyword" id="keyword" class="form-control"
                            placeholder="Cari Transaksi..." aria-describedby="button-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit" id="button-addon2"><i
                                    class="fas fa-search-dollar"></i></button>
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
                <th scope="col">Invoice</th>
                <th scope="col">Total</th>
                <th scope="col">Nama </th>
                <th scope="col">Kategori</th>
                <th scope="col">Dibuat</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @php
                $i = ($transaksi->currentPage() - 1) * $transaksi->perPage() + 1;
            @endphp
            @foreach ($transaksi as $item)
                <tr>
                    <th scope="row">{{ $i++ }}</th>
                    <td style="width: 15%">{{ $item->kode_transaksi }}</td>
                    <td>{{ number_format($item->total, '0', ',', '.') }}</td>
                    <td>{{ $item->mahasiswa->nama }}</td>
                    <td>{{ $item->kategoriTransaksi->nama }}</td>
                    <td>{{ $item->created_at->format('d M Y') }}</td>
                    <td>
                        <button class="btn btn-warning btn-sm"
                            onclick="detailTransaksi('{{ $item->kode_transaksi }}')"><i class="fas fa-eye"></i></button>
                        <button class="btn btn-primary btn-sm" onclick="editTransaksi('{{ $item->kode_transaksi }}')"><i
                                class="fas fa-edit"></i></button>
                        <button class="btn btn-danger btn-sm"
                            onclick="destroyTransaksi('{{ $item->kode_transaksi }}')"><i
                                class="fas fa-trash-alt"></i></button>
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>
    <div class="mt-3">
        {{ $transaksi->onEachSide(3)->links('pagination::bootstrap-4') }}
        <small>Displaying {{ $transaksi->count() }} of {{ $transaksi->total() }}</small>
    </div>
    <div class="modalTransaksi"></div>

    <script>
        function destroyTransaksi(kode) {
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
                        type: "DELETE",
                        url: "{{ route('transaksi.destroy', ' + kode + ') }}",
                        data: {
                            _token: "{{ csrf_token() }}",
                            kode_transaksi: kode
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
                                }, 1250);
                            }
                        }
                    });
                }
            });
        }

        function detailTransaksi(kode) {
            $.ajax({
                type: 'get',
                url: "{{ route('transaksi.show', ' + kode + ') }}",
                data: {
                    kode_transaksi: kode,
                    _token: "{{ csrf_token() }}"
                },
                dataType: "json",
                success: function(response) {
                    $('.modalTransaksi').html(response.view);
                    $('#showTransaksi').modal('show');
                }
            });
        }

        function editTransaksi(kode) {
            $.ajax({
                type: "GET",
                url: "{{ route('transaksi.edit', ' + kode + ') }}",
                data: {
                    kode_transaksi: kode,
                    _token: "{{ csrf_token() }}"
                },
                dataType: "json",
                success: function(response) {
                    $('.modalTransaksi').html(response.view);
                    $('#editTransaksi').modal('show');
                }
            });
        }

        $('#btnModalCreateTransaksi').click(function(e) {
            e.preventDefault();
            $.ajax({
                type: "get",
                url: "{{ route('transaksi.create') }}",
                dataType: "json",
                success: function(response) {
                    $('.modalTransaksi').html(response.view);
                    $('#createTransaksi').modal('show');
                }
            });
        });
    </script>

</x-app-layout>
