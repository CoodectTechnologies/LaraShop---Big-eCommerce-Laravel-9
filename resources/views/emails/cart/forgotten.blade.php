@component('mail::message')

@component('mail::panel')
{{ __('Hello! you have a forgotten cart') }}
@endcomponent

@foreach ($products as $product)
    <p><a href="{{ route('ecommerce.product.show', $product) }}">{{ $product->name }}</a></p>
@endforeach


@component('mail::button', ['url' => route('login')])
{{ __('Log in') }}
@endcomponent

{{ config('app.name') }}
@endcomponent

