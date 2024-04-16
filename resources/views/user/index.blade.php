<x-app-layout title="User">

    @section('title')
        Users
    @endsection
    @section('card-title')
        <button type="submit" class="btn btn-success btn-sm" id="btnCreateUser">Create User <i
                class="fas fa-plus"></i></button>
    @endsection

    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nama</th>
                <th scope="col">Email</th>
                <th scope="col">Role</th>
                <th scope="col">Dibuat</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; ?>
            @foreach ($users as $user)
                <tr>
                    <th scope="row">{{ $i++ }}</th>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @if ($user->getRoleNames()[0] == 'super admin')
                            <span class="badge badge-primary"> {{ $user->getRoleNames()[0] }} </span>
                        @else
                            <span class="badge badge-secondary"> {{ $user->getRoleNames()[0] }} </span>
                        @endif
                    </td>
                    <td>{{ $user->created_at->format('d M Y') }}</td>
                    <td>
                        <button type="button" class="btn btn-sm btn-primary" onclick="editUser({{ $user->id }})">
                            <i class="fa fa-user-edit"></i></button>
                        <button type="button" class="btn btn-sm btn-danger" onclick="destroyUser({{ $user->id }})">
                            <i class="fa fa-trash"></i></button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="modalUser"></div>

    <script>
        $('#btnCreateUser').click(function(e) {
            e.preventDefault();
            $.ajax({
                type: "get",
                url: "{{ route('user.create') }}",
                data: {
                    _token: "{{ csrf_token() }}"
                },
                dataType: "json",
                beforeSend: function() {
                    $('#btnCreateUser').prop('disabled', true);
                },
                success: function(response) {
                    $('#btnCreateUser').prop('disabled', false);
                    $('.modalUser').html(response.view);
                    $('#createUser').modal('show');
                }
            });
        });

        function editUser(user_id) {
            $.ajax({
                type: "get",
                url: "{{ route('user.edit', '+ user_id +') }}",
                data: {
                    user_id: user_id,
                    _token: "{{ csrf_token() }}"
                },
                dataType: "json",
                success: function(response) {
                    $('.modalUser').html(response.view);
                    $('#editUser').modal('show');
                }
            });
        }

        function destroyUser(user_id) {
            Swal.fire({
                title: "Are you sure?",
                text: "Delete Admin User",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "delete",
                        url: "{{ route('user.destroy', '+ user_id +') }}",
                        data: {
                            _token: "{{ csrf_token() }}",
                            user_id: user_id
                        },
                        dataType: "json",
                        success: function(response) {
                            if (response.success) {
                                Swal.fire({
                                    title: "Deleted!",
                                    text: response.success,
                                    icon: "success"
                                });

                                setTimeout(() => {
                                    window.location.reload();
                                }, 1500);
                            }
                        }
                    });
                }
            })
        }
    </script>
</x-app-layout>
