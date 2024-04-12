<x-app-layout title="User">

    @section('title')
        Users
    @endsection
    @section('card-title')
        <button type="submit" class="btn btn-success btn-sm">Create User <i class="fas fa-plus"></i></button>
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
                    <td><button class="btn btn-sm btn-primary"><i class="fa fa-user-edit"></i></button></td>
                </tr>
            @endforeach
        </tbody>
    </table>


</x-app-layout>
