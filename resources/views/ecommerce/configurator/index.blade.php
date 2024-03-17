
@extends('ecommerce.layouts.configurator.main')

@section('head')
<title>{{ __('Configurator') }} - {{ config('app.name') }} </title>
    <meta name="title" content="{{ config('app.name') }} - {{ __('Configurator') }}" />
    <meta name="description" content="{{ config('app.name') }} - {{ __('Configurator') }}" />
    <meta http-equiv="title" content="{{ config('app.name') }} - {{ __('Configurator') }}" />
    <meta property="og:title" content="{{ config('app.name') }} - {{ __('Configurator') }}" />
    <meta property="og:description" content="{{ config('app.name') }} - {{ __('Configurator') }}" />
    <meta name="description" content="{{ config('app.name') }} - {{ __('Configurator') }}" />
    <meta name="keywords" content="{{ config('app.name') }}, {{ __('Configurator') }}" />
    <meta property="og:url" content="{{ route('ecommerce.contact.index') }}" />
    <meta name="twitter:description" content="{{ config('app.name') }} - {{ __('Configurator') }}" />
    <meta name="twitter:title" content="{{ config('app.name') }} - {{ __('Configurator') }}" />
    <link rel="stylesheet" href="{{ asset('assets/ecommerce/css/configurator.css') }}">
@endsection

@section('content')
    @livewire('ecommerce.configurator.index')
@endsection
