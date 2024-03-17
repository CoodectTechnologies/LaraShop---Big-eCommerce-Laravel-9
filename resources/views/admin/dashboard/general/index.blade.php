@extends('admin.layouts.main')

@section('head')
    <title>Dashboard | General</title>
@endsection

@section('toolbar')
<!--begin::Container-->
<div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
    <!--begin::Page title-->
    <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
         <!--begin::Title-->
         <h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">Dashboard</h1>
         <!--end::Title-->
         <!--begin::Separator-->
         <span class="h-20px border-gray-300 border-start mx-4"></span>
         <!--end::Separator-->
         <!--begin::Breadcrumb-->
         <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
             <!--begin::Item-->
             <li class="breadcrumb-item text-muted">{{ __('General') }}</li>
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
    <div id="kt_content_container" class="container-xxl">
        @livewire('admin.dashboard.general.index')
    </div>
    <!--end::Container-->
@endsection

@section('footer')
    @livewireChartsScripts
@endsection
