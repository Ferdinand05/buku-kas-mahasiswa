<!-- Modal -->
<div class="modal fade" id="createUser" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="createUserLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createUserLabel">Create User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formCreateUser">
                    <div class="form-group">
                        <label for="name">Username</label>
                        <input type="text" name="name" id="name" class="form-control">
                        <small class="text-danger errorName"></small>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control">
                        <small class="text-danger errorEmail"></small>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="text" name="password" id="password" class="form-control">
                        <small class="text-danger errorPassword"></small>
                    </div>

                    <div class="form-group">
                        <select name="role" id="role" class="form-control">
                            <option value="" selected disabled>Pilih Role</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                        <small class="text-danger errorRole"></small>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Submit</button>
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
    $('#formCreateUser').submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "{{ route('user.store') }}",
            data: {
                _token: "{{ csrf_token() }}",
                name: $('#name').val(),
                email: $('#email').val(),
                password: $('#password').val(),
                role: $('#role').val()
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
                    $('#createUser').modal('hide');
                    setTimeout(() => {
                        window.location.reload();
                    }, 1350);
                }

                if (response.error) {
                    $('.errorName').html(response.error.name);
                    $('.errorEmail').html(response.error.email);
                    $('.errorPassword').html(response.error.password);
                    $('.errorRole').html(response.error.role);
                }

            }
        });
    });
</script>
