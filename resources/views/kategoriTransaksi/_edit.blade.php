<!-- Modal -->
<div class="modal fade" id="editKategoriTransaksi" tabindex="-1" data-backdrop="static"
    aria-labelledby="createKategoriTransaksiLabel" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createKategoriTransaksiLabel">Edit Kategori Transaksi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{-- form --}}
                <input type="hidden" name="idKategoriTransaksi" id="idKategoriTransaksi" value="{{ $data->id }}">
                <div class="form-group">
                    <label for="exampleInputEmail1">Nama</label>
                    <input type="text" name="nama" id="nama" placeholder="Nama Kategori Transaksi"
                        value="{{ $data->nama }}" class="form-control" id="keterangan" </div>
                    <small class="text-danger" id="errorNama"></small>
                </div>
                <div class="form-group">

                    <label for="keterangan">Keterangan</label>
                    <input type="text" name="keterangan" class="form-control" id="keterangan"
                        value="{{ $data->keterangan }}">
                    <small class="text-danger" id="errorKeterangan"></small>

                </div>

                <button type="button" id="btnFormEditKategoriTransaksi" class="btn btn-primary"
                    id="btnCreateKategoriTransaksi">Submit</button>
                {{-- endform --}}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    $('#btnFormEditKategoriTransaksi').click(function(e) {
        e.preventDefault();
        id_kategoriTransaksi = $('#idKategoriTransaksi').val();
        $.ajax({
            type: "PUT",
            url: "{{ route('kategori-transaksi.update', '+ id_kategoriTransaksi +') }}",
            data: {
                nama: $('#nama').val(),
                keterangan: $('#keterangan').val(),
                id_kategori: id_kategoriTransaksi
            },
            dataType: "json",
            success: function(response) {
                if (response.error) {
                    $('#errorNama').html(response.error.nama);
                    $('#errorKeterangan').html(response.error.keterangan);
                }

                if (response.success) {
                    Swal.fire({
                        title: "Good job!",
                        text: response.success,
                        icon: "success"
                    });
                    $('#editKategoriTransaksi').modal('hide');

                    setTimeout(() => {
                        window.location.reload();
                    }, 1500);
                }

            }
        });
    });





    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            }
        });
    });
</script>
