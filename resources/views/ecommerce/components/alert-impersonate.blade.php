@if (session()->has('impersonated_by'))
    <form action="{{ route('impersonate.logout') }}" method="post">
        @csrf
        @method('delete')
        <strong>
            <button class="ml-3 btn btn-link btn-primary btn-simple"> Regresar a mi sesión</button>
        </strong>
    </form>
@endif
