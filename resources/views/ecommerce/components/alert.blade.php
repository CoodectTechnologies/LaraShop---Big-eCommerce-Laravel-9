@if (session()->has('alert'))
    <div class="alert alert-{{ session()->get('alert-type') }} alert-simple alert-inline">
        <h4 class="alert-title">{{ session()->get('alert') }}</h4>
    </div>
@endif
