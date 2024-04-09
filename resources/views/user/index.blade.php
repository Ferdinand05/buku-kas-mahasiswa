<x-app-layout title="User">

    @section('title')
        Users
    @endsection
    @section('card-title')
        Users
    @endsection

    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nama</th>
                <th scope="col">Email</th>
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
                    <td>{{ $user->created_at->diffForHumans() }}</td>
                    <td><button class="btn btn-sm btn-primary"><i class="fa fa-user-edit"></i></button></td>
                </tr>
            @endforeach
        </tbody>
    </table>


</x-app-layout>
