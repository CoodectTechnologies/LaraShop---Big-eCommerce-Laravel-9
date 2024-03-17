@component('mail::message')
{{ __('Status') }}: {{ $order->status }}

@component('mail::button', ['url' => 'https://wa.me/'.config('contact.whatsapp')])
{{ __('Contact us on WhatsApp') }}
@endcomponent

{{ __('Thank you') }},<br>
{{ config('app.name') }}
@endcomponent
