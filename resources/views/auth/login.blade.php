@extends('auth.main')

@section('head')
<title>{{ __('Log in') }}</title>
@endsection

@section('content')
<!--begin::Authentication - Sign-in -->
<div class="d-flex flex-column flex-lg-row flex-column-fluid">
    <!--begin::Aside-->
    <div class="d-flex flex-column flex-lg-row-auto w-xl-600px positon-xl-relative" style="background-image: url('{{ asset('assets/admin/media/auth/sing_in.png') }}'); background-size: cover;">
        <!--begin::Wrapper-->
        <div class="d-flex flex-column position-xl-fixed top-0 bottom-0 w-xl-600px scroll-y">
            <!--begin::Content-->
            <div class="d-flex flex-row-fluid flex-column text-center p-10 pt-lg-20">
                <!--begin::Logo-->
                @php
                    if(Route::has('ecommerce.home.index')):
                        $route = route('ecommerce.home.index');
                    else:
                        $route = '#';
                    endif;
                @endphp
                <a href="{{ $route }}" class="py-9 mb-5">
                    <img class="img-fluid" alt="{{ config('app.name') }}" src="{{ asset(config('app.logo')) }}" />
                </a>
                <!--end::Logo-->
                <!--begin::Title-->
                {{-- <h1 class="fw-bolder fs-2qx pb-5 pb-md-10" style="color: #fff;">Inicio de sesión</h1> --}}
                <!--end::Title-->
                <!--begin::Description-->
                {{-- <p class="fw-bold fs-2" style="color: #fff;">Ingresa sesión o continua como invitado <br>
                El iniciar sesión te ahorra pasos en el futuro</p> --}}
                <!--end::Description-->
            </div>
            <!--end::Content-->
        </div>
        <!--end::Wrapper-->
    </div>
    <!--end::Aside-->
    <!--begin::Body-->
    <div class="d-flex flex-column flex-lg-row-fluid py-10">
        <!--begin::Content-->
        <div class="d-flex flex-center flex-column flex-column-fluid">
            <!--begin::Wrapper-->
            <div class="w-lg-500px p-10 p-lg-15 mx-auto">
                <!--begin::Form-->
                <form class="form w-100" action="{{ route('login') }}" method="POST">
                    @csrf
                    <!--begin::Heading-->
                    <div class="text-center mb-10">
                        <!--begin::Title-->
                        <h1 class="text-dark mb-3">{{ __('Log in') }}</h1>
                        <!--end::Title-->
                        @if (Route::has('register'))
                            <!--begin::Link-->
                            <div class="text-gray-400 fw-bold fs-4">{{ __("Don't have an account?") }}
                            <a href="{{ route('register') }}" class="link-primary fw-bolder">{{ __('Create an account') }}</a></div>
                            <!--end::Link-->
                        @endif
                    </div>
                    @if (Route::has('ecommerce.checkout.guest'))
                        <a href="{{ route('ecommerce.checkout.guest') }}" class="btn btn-primary btn-flex flex-center btn-light btn-lg w-100 mb-5">
                            {{ __('Continue as a guest') }}
                        </a>
                        <!--begin::Heading-->
                        <!--begin::Separator-->
                        <div class="text-center text-muted text-uppercase fw-bolder mb-5">Ó</div>
                    @endif
                    <!--end::Separator-->
                    @if (Route::has('login.google') && config('services.google.status'))
                        <!--begin::Google link-->
                        <a href="{{ route('login.google') }}" class="btn btn-flex flex-center btn-light btn-lg w-100 mb-5">
                            <img alt="Iniciar sesión con Google" src="{{ asset('assets/admin/media/svg/brand-logos/google-icon.svg') }}" class="h-20px me-3" />{{ __('Continued with Google') }}
                        </a>
                        <!--end::Google link-->
                    @endif
                    <!--begin::Input group-->
                    <div class="fv-row mb-10">
                        <!--begin::Label-->
                        <label class="form-label fs-6 fw-bolder text-dark">{{ __('Email') }}</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input class="form-control form-control-lg form-control-solid @error('email') is-invalid @enderror" value="{{ old('email') }}" type="email" name="email" autocomplete="on" />
                        <!--end::Input-->
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="fv-row mb-10">
                        <!--begin::Wrapper-->
                        <div class="d-flex flex-stack mb-2">
                            <!--begin::Label-->
                            <label class="form-label fw-bolder text-dark fs-6 mb-0">{{ __('Password') }}</label>
                            <!--end::Label-->
                            <!--begin::Link-->
                            <a href="{{ route('password.request') }}" class="link-primary fs-6 fw-bolder">{{ __('Forgot your password?') }}</a>
                            <!--end::Link-->
                        </div>
                        <!--end::Wrapper-->
                        <!--begin::Input-->
                        <input class="form-control form-control-lg form-control-solid @error('password') is-invalid @enderror" value="{{ old('password') }}" type="password" name="password" autocomplete="off" />
                        <!--end::Input-->
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <!--end::Input group-->
                    <!--begin::Actions-->
                    <div class="text-center">
                        <!--begin::Submit button-->
                        <button type="submit" class="btn btn-lg btn-primary w-100 mb-5">
                            <span class="indicator-label">{{ __('Enter') }}</span>
                        </button>
                        <!--end::Submit button-->
                    </div>
                    <!--end::Actions-->
                </form>
                <!--end::Form-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Content-->
    </div>
    <!--end::Body-->
</div>
<!--end::Authentication - Sign-in-->
@endsection
