@foreach ($errorsAddCart as $errorAddCart)
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Errores generales: </strong> {{ $errorAddCart }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endforeach
