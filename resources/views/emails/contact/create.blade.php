@component('mail::message')

@component('mail::panel')
{{ __('You have a new message from the website') }}
@endcomponent

<p>{{ __('Name') }}: {{ $emailWeb->name }}</p>
<p>{{ __('Phone') }}: {{ $emailWeb->phone }}</p>
<p>{{ __('Email') }}: {{ $emailWeb->email }}</p>
<p>{{ __('Subject') }}: {{ $emailWeb->subject }}</p>
<p>{{ __('Message') }}: {{ $emailWeb->body }}</p>

@component('mail::button', ['url' => 'mailto:'.$emailWeb->email])
{{ __('Reply to email') }}
@endcomponent

@component('mail::button', ['url' => 'https://wa.me/+52'.$emailWeb->phone])
{{ __('Reply in WhatsApp') }}
@endcomponent

{{ config('app.name') }}
@endcomponent

