<!-- Modal -->
<div class="modal fade" id="editUser" tabindex="-1" aria-labelledby="editUserLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editUserLabel">Edit Admin User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formEditUser">
                    <div class="form-group">
                        <input type="hidden" name="user_id" id="user_id" value="{{ $user->id }}">
                        <label for="nama">Nama</label>
                        <input type="text" name="nama" id="nama" class="form-control"
                            value="{{ $user->name }}">
                        <small class="text-danger errorNama"></small>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" name="email" id="email" class="form-control"
                            value="{{ $user->email }}">
                        <small class="text-danger errorEmail"></small>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="text" name="password" id="password" class="form-control"
                            value="{{ $user->password }}">
                    </div>
                    <div class="form-group">
                        <label for="role">Roles</label>
                        <select name="role" id="role" class="form-control">
                            @foreach ($roles as $role)
                                @if ($user->getRoleNames()[0] == $role->name)
                                    <option value="{{ $role->id }}" selected>{{ $role->name }}</option>
                                @else
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endif
                            @endforeach
                        </select>
                        <small class="text-danger errorRole"></small>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Save</button>
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
    $('#formEditUser').submit(function(e) {
        e.preventDefault();
        let user_id = $('#user_id').val();
        $.ajax({
            type: "put",
            url: "{{ route('user.update', '+ user_id +') }}",
            data: {
                user_id: user_id,
                nama: $('#nama').val(),
                email: $('#email').val(),
                password: $('#password').val(),
                role: $('#role').val(),
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
                    $('#editUser').modal('hide');
                    setTimeout(() => {
                        window.location.reload();
                    }, 1380);
                }

                if (response.error) {
                    $('.errorNama').html(response.error.name);
                    $('.errorEmail').html(response.error.email);
                    $('.errorPassword').html(response.error.password);
                    $('.errorRole').html(response.error.role);
                }
            }
        });
    });
</script>
