<x-app-layout title="User">
    @section('title')
        Profile
    @endsection

    @section('card-title')
        Detail
    @endsection


    <ul class="list-group list-group-flush">
        <li class="list-group-item"><small>Nama </small><br>{{ $user->name }}</li>
        <li class="list-group-item"><small>Email</small><br>{{ $user->email }}</li>
        <li class="list-group-item"><small>Tanggal Dibuat</small><br>{{ $user->created_at->format('d F Y') }}</li>
        <li class="list-group-item"><small>Roles</small><br>
            @if ($user->getRoleNames()[0] == 'super admin')
                <span class="badge badge-primary">{{ $user->getRoleNames()[0] }}</span>
            @else
                <span class="badge badge-success">{{ $user->getRoleNames()[0] }}</span>
            @endif
        </li>
    </ul>


</x-app-layout>
