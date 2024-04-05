<!-- Modal -->
<div class="modal fade" id="editJurusanMahasiswa" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Edit Jurusan Mahasiswa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formEditJurusanMahasiswa">
                    <input type="hidden" name="" id="id_jurusan" value="{{ $jurusan->id }}">
                    <div class="form-group">
                        <label for="nama_jurusan">Nama Jurusan</label>
                        <div class="input-group">
                            <input type="text" name="nama_jurusan" id="nama_jurusan" class="form-control"
                                value="{{ $jurusan->nama }}">
                        </div>
                        <small class="errorNama text-danger"></small>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    $('#formEditJurusanMahasiswa').submit(function(e) {
        e.preventDefault();
        id_jurusan = $('#id_jurusan').val();
        $.ajax({
            type: "put",
            url: "{{ route('jurusan-mahasiswa.update', '+ id_jurusan +') }}",
            data: {
                nama_jurusan: $('#nama_jurusan').val(),
                id_jurusan: id_jurusan,
                _token: "{{ csrf_token() }}"
            },
            dataType: "json",
            success: function(response) {
                if (response.error) {
                    $('.errorNama').html(response.error.nama);
                }

                if (response.success) {
                    Swal.fire({
                        title: "Good job!",
                        text: response.success,
                        icon: "success"
                    });
                    $('#editJurusanMahasiswa').modal('hide');

                    setTimeout(() => {
                        window.location.reload();
                    }, 1500);
                }
            }
        });
    });
</script>
