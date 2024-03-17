@extends('admin.layouts.main')

@section('head')
    <title>{{ $role->name }}</title>
@endsection

@section('toolbar')
    <!--begin::Container-->
    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
        <!--begin::Page title-->
        <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
            <!--begin::Title-->
            <h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1"><a href="{{ route('admin.setting.welcome') }}">{{ __('Settings') }}</a>
            <!--begin::Separator-->
            <span class="h-20px border-1 border-gray-200 border-start ms-3 mx-2 me-1"></span>
            <!--end::Separator-->
            <!--begin::Description-->
            <span class="text-muted fs-7 fw-bold mt-2"><a href="{{ route('admin.setting.role.index') }}">Roles</a></span>
            <!--end::Description--></h1>
             <!--begin::Separator-->
             <span class="h-20px border-1 border-gray-200 border-start ms-3 mx-2 me-1"></span>
             <!--end::Separator-->
             <!--begin::Description-->
             <span class="text-muted fs-7 fw-bold mt-2">{{ $role->name }}</span>
             <!--end::Description--></h1>
            <!--end::Title-->
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
            @livewire('admin.setting.role.show', ['role' => $role])
        </div>
        <!--end::Content -->
    </div>
    <!--end::Container-->
@endsection
