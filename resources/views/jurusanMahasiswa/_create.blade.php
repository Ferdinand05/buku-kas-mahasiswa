<!-- Modal -->
<div class="modal fade" id="createJurusanMahasiswa" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Create Jurusan Mahasiswa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formCreateJurusanMahasiswa">
                    <div class="form-group">
                        <label for="nama_jurusan">Nama Jurusan</label>
                        <div class="input-group">
                            <input type="text" name="nama_jurusan" id="nama_jurusan" class="form-control">
                        </div>
                        <small class="errorNama text-danger"></small>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Submit</button>
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
    $('#formCreateJurusanMahasiswa').submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: "post",
            url: "{{ route('jurusan-mahasiswa.store') }}",
            data: {
                nama_jurusan: $('#nama_jurusan').val(),
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
                    $('#createJurusanMahasiswa').modal('hide');

                    setTimeout(() => {
                        window.location.reload();
                    }, 1500);
                }
            }
        });
    });
</script>
