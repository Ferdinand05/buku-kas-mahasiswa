<x-app-layout title="Activity Log">
    @section('title')
        Activity Log
    @endsection
    @section('card-title')
        Reports
    @endsection


    <div class="accordion" id="accordionExample">
        @foreach ($logs as $log)
            <div class="card">
                <div class="card-header" id="heading">
                    <h2 class="mb-0">
                        <button class="btn  btn-block text-left collapsed" type="button" data-toggle="collapse"
                            data-target="#collapse{{ $log->id }}" aria-expanded="false" aria-controls="collapse">
                            @if ($log->event == 'deleted')
                                <span class=" badge badge-danger">{{ $log->event }}</span>
                            @elseif ($log->event == 'Updated')
                                <span class=" badge badge-primary">{{ $log->event }}</span>
                            @else
                                <span class=" badge badge-success">{{ $log->event }}</span>
                            @endif

                            {{ $log->created_at->format('d M Y H:i') }} <code> {{ $log->description }}</code>
                        </button>
                    </h2>
                </div>
                <div id="collapse{{ $log->id }}" class="collapse" aria-labelledby="heading"
                    data-parent="#accordionExample">
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><small>Subject</small><br>{{ $log->subject }}</li>
                            <li class="list-group-item"><small>Properties</small><br>{{ $log->properties }}</li>
                            <li class="list-group-item"><small>Caused by</small><br>{{ $log->causer->email }} -
                                {{ $log->causer->name }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        @endforeach

    </div>



    </tbody>
    </table>
</x-app-layout>
