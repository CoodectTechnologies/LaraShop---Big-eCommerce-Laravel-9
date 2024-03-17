@extends('admin.layouts.main')

@section('head')
    <title>{{ $shippingZone->name }}</title>
@endsection

@section('toolbar')
    <!--begin::Container-->
    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
       <!--begin::Page title-->
       <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
            <!--begin::Title-->
            <h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">{{ $shippingZone->name }}</h1>
            <!--end::Title-->
            <!--begin::Separator-->
            <span class="h-20px border-gray-300 border-start mx-4"></span>
            <!--end::Separator-->
            <!--begin::Breadcrumb-->
            <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                <!--begin::Item-->
                <li class="breadcrumb-item text-muted">
                    <a href="{{ route('admin.setting.shipping-zone.index') }}" class="text-muted text-hover-primary">{{ __("Shipping zones") }}</a>
                </li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-300 w-5px h-2px"></span>
                </li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item text-muted"><a href="{{ route('admin.setting.shipping-zone.show', $shippingZone) }}">{{ $shippingZone->name }}</a></li>
                <!--end::Item-->
            </ul>
            <!--end::Breadcrumb-->
        </div>
    <!--end::Page title-->
    </div>
    <!--end::Container-->
@endsection

@section('content')
    <!--begin::Container-->
    <div id="kt_content_container" class="container-fluid">
        <!--begin::Content -->
        <div class="d-flex flex-column flex-lg-row">
            @include('admin.setting.menu.index')
            @livewire('admin.setting.shipping-zone.form', ['shippingZone' => $shippingZone, 'method' => 'update'])
        </div>
        <!--end::Content -->
    </div>
    <!--end::Container-->
@endsection
