@component('mail::message')

<img loading="lazy" src="{{ asset('').$model->imagePreview() }}" class="img-fluid" alt="{{ $model->name }}">

@component('mail::panel')
{{ $title }}
@endcomponent

<p>{{ __('Name') }}: {{ $comment->name }}</p>
<p>{{ __('Email') }}: {{ $comment->email }}</p>
<p>{{ __('Message') }}: {{ $comment->body }}</p>

@component('mail::button', ['url' => $url])
{{ __('View comment') }}
@endcomponent

{{ config('app.name') }}
@endcomponent

