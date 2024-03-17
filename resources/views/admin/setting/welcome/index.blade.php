@extends('admin.layouts.main')

@section('head')
    <title>{{ __('Settings') }}</title>
@endsection

@section('toolbar')
    <!--begin::Container-->
    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
        <!--begin::Page title-->
        <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
            <!--begin::Title-->
            <h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">
                {{ __('Settings') }}
            </h1>
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
            <!--begin::Content-->
            <div class="flex-lg-row-fluid ms-lg-7 ms-xl-10">
                <!--begin::Card-->
                <div class="card" style="background: #1C325E;">
                    <!--begin::Body-->
                    <div class="card-body d-flex ps-xl-15">
                        <!--begin::Action-->
                        <div class="m-0">
                            <!--begin::Title-->
                            <div class="position-relative fs-2x z-index-2 fw-bolder text-white mb-7">
                            <span class="me-2">{{ __('Hello') }}
                            <span class="position-relative d-inline-block text-danger">
                                <a href="#" class="text-danger opacity-75-hover">{{ auth()->user()->name }}</a>
                                <!--begin::Separator-->
                                <span class="position-absolute opacity-50 bottom-0 start-0 border-4 border-danger border-bottom w-100"></span>
                                <!--end::Separator-->
                            </span></span>.
                            <br>{{ __('Learn about the different configurations that can be made within the system.') }}</div>
                            <!--end::Title-->
                            <!--begin::Action-->
                            <div class="mb-3">
                                <a href="{{ route('admin.setting.permission') }}" class="btn btn-danger fw-bold me-2">{{ __('Start') }}</a>
                                {{-- <a href="../../demo1/dist/apps/support-center/overview.html" class="btn btn-color-white bg-body bg-opacity-15 bg-hover-opacity-25 fw-bold">How to</a> --}}
                            </div>
                            <!--begin::Action-->
                        </div>
                        <!--begin::Action-->
                        <!--begin::Illustration-->
                        <img loading="lazy" src="{{ asset('assets/admin') }}/media/illustrations/sigma-1/9.png" class="position-absolute me-3 bottom-0 end-0 h-200px" alt="">
                        <!--end::Illustration-->
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Card-->
            </div>
            <!--end::Content-->
        </div>
        <!--end::Content -->
    </div>
    <!--end::Container-->
@endsection
