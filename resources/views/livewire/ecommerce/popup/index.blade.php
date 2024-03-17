<div style="border-radius: 40px;">
    @if ($popup->image)
        <style>
            .newsletter-popup {
                background-image: url('{{ $popup->imagePreview() }}');
            }
            @media (max-width: 767px){
                .newsletter-popup {
                    background-image: url('{{ $popup->imagePreview() }}');
                }
            }
        </style>
    @endif
    <div class="newsletter-popup" wire:ignore.self>
        <div class="newsletter-content">
            <h4 class="text-uppercase font-weight-normal ls-25">
                <span class="" style="color: {{ $popup->title_color }}">{{ $popup->title }}</span>
            </h4>
            <h2 class="ls-25" style="color: {{ $popup->subtitle }}">{{ $popup->subtitle }}</h2>
            @if ($popup->description)
                <p class="ls-10" style="color: {{ $popup->description_color }}">{{ $popup->description }}</p>
            @endif
            @if ($popup->newsletter)
                @livewire('ecommerce.subscriber.popup')
            @else
                <a href="{{ $popup->btn_url }}" class="btn btn-dark mb-5">{{ $popup->btn_text }}</a>
            @endif
            <div class="form-checkbox justify-content-center d-flex align-items-center">
                <input type="checkbox" class="custom-checkbox" id="hide-newsletter-popup" name="hide-newsletter-popup" required="">
                <label for="hide-newsletter-popup" class="font-size-sm text-light">{{ __("Don't show this popup again.") }}</label>
            </div>
        </div>
    </div>
</div>
