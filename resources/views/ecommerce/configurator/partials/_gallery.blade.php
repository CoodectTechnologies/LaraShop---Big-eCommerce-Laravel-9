<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
        @foreach ($gallery as $image)
            <div class="carousel-item {{ $loop->iteration == 1 ? 'active' : '' }}">
                <img src="{{ $image }}" class="d-block w-100" alt="{{ config('app.name') }}">
            </div>
        @endforeach
    </div>
    <button class="carousel-control-prev" type="button" data-target="#carouselExampleControls" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">{{ __('Previous') }}</span>
    </button>
    <button class="carousel-control-next" type="button" data-target="#carouselExampleControls" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">{{ __('Next') }}</span>
    </button>
</div>
