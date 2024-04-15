<!-- Modal -->
<div class="modal fade" id="createMahasiswa" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Create Mahasiswa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formCreateMahasiswa">
                    <div class="form-group">
                        <label for="nim">NIM</label>
                        <div class="input-group">
                            <input type="text" name="nim" id="nim" class="form-control">
                        </div>
                        <small class="errorNim text-danger"></small>

                    </div>
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <div class="input-group">
                            <input type="text" name="nama" id="nama" class="form-control">
                        </div>
                        <small class="errorNama text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <div class="input-group">
                            <input type="text" name="alamat" id="alamat" class="form-control">
                        </div>
                        <small class="errorAlamat text-danger"></small>

                    </div>
                    <div class="form-group">
                        <label for="no_telp">No Telepon</label>
                        <div class="input-group">
                            <input type="text" name="no_telp" id="no_telp" class="form-control">
                        </div>
                        <small class="errorNoTelp text-danger"></small>

                    </div>
                    <div class="form-group">
                        <label for="jurusan_mahasiswa">Jurusan Mahasiswa</label>
                        <div class="input-group">
                            <select name="jurusan_mahasiswa" id="jurusan_mahasiswa" class="form-control">
                                <option selected disabled>> Pilih < </option>
                                        @foreach ($jurusan as $j)
                                <option value="{{ $j->id }}">{{ $j->jurusan }}</option>
                                @endforeach
                            </select>
                        </div>
                        <small class="errorJurusan text-danger"></small>

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
    $('#formCreateMahasiswa').submit(function(e) {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: "{{ route('mahasiswa.store') }}",
            data: {
                _token: "{{ csrf_token() }}",
                nim: $('#nim').val(),
                nama: $('#nama').val(),
                alamat: $('#alamat').val(),
                no_telp: $('#no_telp').val(),
                jurusan_mahasiswa: $('#jurusan_mahasiswa').val()
            },
            dataType: "json",
            success: function(response) {
                if (response.error) {
                    e = response.error;
                    $('.errorNim').html(e.nim);
                    $('.errorNama').html(e.nama);
                    $('.errorAlamat').html(e.alamat);
                    $('.errorNoTelp').html(e.no_telp);
                    $('.errorJurusan').html(e.jurusan_mahasiswa);
                }

                if (response.success) {
                    if (response.success) {
                        Swal.fire({
                            title: "Good job!",
                            text: response.success,
                            icon: "success"
                        });
                        $('#createMahasiswa').modal('hide');

                        setTimeout(() => {
                            window.location.reload();
                        }, 1500);
                    }
                }

            }
        });

    });
</script>
