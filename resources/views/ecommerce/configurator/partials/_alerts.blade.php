@foreach ($alerts as $alert)
    <div class="alert alert-{{ $alert['type'] }} alert-dismissible fade show" role="alert">
        <strong>{{ $alert['title'] }}: </strong> {{ $alert['message'] }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endforeach
