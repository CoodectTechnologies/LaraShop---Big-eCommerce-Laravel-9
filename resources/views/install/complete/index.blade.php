@extends('install.layouts.main')

@section('content')
    <div class="d-flex flex-center flex-column flex-column-fluid">
        <div class="w-lg-700px p-10 p-lg-15 mx-auto">
            <div class="w-100">
                <!--begin::Heading-->
                <div class="pb-8 pb-lg-10">
                    <!--begin::Title-->
                    <h2 class="fw-bolder text-dark">¡Listo!</h2>
                    <!--end::Title-->
                    <!--begin::Notice-->
                    <div class="text-muted fw-bold fs-6">La instalación a finalizado, ahora puedes
                    <a href="{{ route('admin.dashboard.general.index') }}" class="link-primary fw-bolder">Iniciar sesión</a>.</div>
                    <!--end::Notice-->
                </div>
                <!--end::Heading-->
            </div>
        </div>
    </div>
@endsection
