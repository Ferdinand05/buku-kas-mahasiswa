<!-- Modal -->
<div class="modal fade" id="createTransaksi" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="createTransaksiLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createTransaksiLabel">Create Transaksi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formCreateTransaksi">
                    <div class="row">
                        <div class="col-md">
                            <label for="nama_mahasiswa" class="form-label">Nama Mahasiswa</label>
                            <select name="nama_mahasiswa" id="nama_mahasiswa" class="form-control">
                                <option selected disabled> >> Pilih Mahasiswa << </option>
                                        @foreach ($mahasiswa as $m)
                                <option value="{{ $m->nim }}">{{ $m?->nama }} - {{ $m->nim }} -
                                    {{ $m->jurusanMahasiswa?->nama }}</option>
                                @endforeach
                            </select>
                            <small class="text-danger errorMahasiswa"></small>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md">
                            <div class="form-group">
                                <label for="kategori_transaksi" class="form-label">Kategori Transaksi</label>
                                <select name="kategori_transaksi" id="kategori_transaksi" class="form-control">
                                    <option selected disabled> >> Pilih Kategori Transaksi << </option>
                                            @foreach ($kategoriTransaksi as $k)
                                    <option value="{{ $k->id }}">{{ $k->nama }}</option>
                                    @endforeach
                                </select>
                                <small class="text-danger errorKategori"></small>

                            </div>
                        </div>
                        <div class="col-md">
                            <div class="form-group">
                                <label for="jenis_transaksi" class="form-label">Jenis Transaksi</label>
                                <select name="jenis_transaksi" id="jenis_transaksi" class="form-control">
                                    <option value="Pemasukan">Pemasukan</option>
                                    <option value="Pengeluaran">Pengeluaran</option>
                                </select>
                                <small class="text-danger errorJenis"></small>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md">
                            <div class="form-group">
                                <label for="total">Total</label>
                                <input type="number" name="total" id="total" class="form-control">
                                <small class="text-danger errorTotal"></small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="user" class="form-label">Admin</label>
                                <select name="user" id="user" class="form-control">
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary" id="btnCreateTransaksi">Submit</button>
                        <button type="reset" class="btn btn-secondary"><i class="fas fa-sync"></i></button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modalCariMahasiswa"></div>

<script>
    $('#formCreateTransaksi').submit(function(e) {
        e.preventDefault();
        Swal.fire({
            title: "Are you sure?",
            text: "Transaksi akan disimpan",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Save"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "{{ route('transaksi.store') }}",
                    data: {
                        _token: "{{ csrf_token() }}",
                        user: $('#user').val(),
                        nama_mahasiswa: $('#nama_mahasiswa').val(),
                        kategori_transaksi: $('#kategori_transaksi').val(),
                        jenis_transaksi: $('#jenis_transaksi').val(),
                        total: $('#total').val(),
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                position: "center",
                                icon: "success",
                                title: response.success,
                                showConfirmButton: false,
                                timer: 1300
                            });

                            $('#createTransaksi').modal('hide');

                            setTimeout(() => {
                                window.location.reload();
                            }, 1350);
                        }

                        if (response.error) {
                            let e = response.error;
                            $('.errorMahasiswa').html(e.nama_mahasiswa);
                            $('.errorKategori').html(e.kategori_transaksi);
                            $('.errorJenis').html(e.jenis_transaksi);
                            $('.errorTotal').html(e.total);
                        }


                    }
                });
            }
        });
    });
</script>
