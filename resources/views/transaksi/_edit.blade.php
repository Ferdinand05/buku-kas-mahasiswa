<!-- Modal -->
<div class="modal fade" id="editTransaksi" data-backdrop="static" tabindex="-1" aria-labelledby="editTransaksiLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editTransaksiLabel">Edit Transaksi </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formEditTransaksi">
                    <div class="row mb-2">
                        <div class="col-md-4">
                            <input type="text" name="kode_transaksi" id="kode_transaksi" class="form-control"
                                value="{{ $transaksi->kode_transaksi }}" disabled>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md">
                            <label for="nama_mahasiswa" class="form-label">Nama Mahasiswa</label>
                            <select name="nama_mahasiswa" id="nama_mahasiswa" class="form-control">
                                @foreach ($mahasiswa as $m)
                                    @if ($transaksi->nim_mahasiswa == $m->nim)
                                        <option selected value="{{ $m->nim }}">{{ $m?->nama }} -
                                            {{ $m->nim }} -
                                            {{ $m->jurusanMahasiswa?->nama }}</option>
                                    @else
                                        <option value="{{ $m->nim }}">{{ $m?->nama }} - {{ $m->nim }} -
                                            {{ $m->jurusanMahasiswa?->nama }}</option>
                                    @endif
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
                                    @foreach ($kategoriTransaksi as $k)
                                        @if ($transaksi->id_kategori_transaksi == $k->id)
                                            <option value="{{ $k->id }}" selected>{{ $k->nama }}</option>
                                        @else
                                            <option value="{{ $k->id }}">{{ $k->nama }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <small class="text-danger errorKategori"></small>

                            </div>
                        </div>
                        <div class="col-md">
                            <div class="form-group">
                                <label for="jenis_transaksi" class="form-label">Jenis Transaksi</label>
                                <select name="jenis_transaksi" id="jenis_transaksi" class="form-control">

                                    @if ($transaksi->jenis == 'Pemasukan')
                                        <option value="Pemasukan" selected>Pemasukan</option>
                                        <option value="Pengeluaran">Pengeluaran</option>
                                    @elseif ($transaksi->jenis == 'Pengeluaran')
                                        <option value="Pemasukan">Pemasukan</option>
                                        <option value="Pengeluaran" selected>Pengeluaran</option>
                                    @endif

                                </select>
                                <small class="text-danger errorJenis"></small>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md">
                            <div class="form-group">
                                <label for="total">Total</label>
                                <input type="number" name="total" id="total" class="form-control"
                                    value="{{ $transaksi->total }}">
                                <small class="text-danger errorTotal"></small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="user" class="form-label">Admin</label>
                                <select name="user" id="user" class="form-control">
                                    @foreach ($users as $user)
                                        @if ($user->id == $transaksi->user_id)
                                            <option value="{{ $user->id }}" selected>{{ $user->name }}</option>
                                        @else
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-warning" id="btnUpdateTransaksi">Save </button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    $('#formEditTransaksi').submit(function(e) {
        e.preventDefault();
        let kode = $('#kode_transaksi').val();
        Swal.fire({
            title: "Are you sure?",
            text: "Transaksi akan diupdate!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Save"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "PUT",
                    url: "{{ route('transaksi.update', '+ kode +') }}",
                    data: {
                        user: $('#user').val(),
                        nama_mahasiswa: $('#nama_mahasiswa').val(),
                        kategori_transaksi: $('#kategori_transaksi').val(),
                        jenis_transaksi: $('#jenis_transaksi').val(),
                        total: $('#total').val(),
                        kode_transaksi: kode,
                        _token: "{{ csrf_token() }}"
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

                            $('#editTransaksi').modal('hide');

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
