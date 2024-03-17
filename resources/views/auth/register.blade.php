@extends('auth.main')

@section('head')
<title>{{ __('Register') }}</title>
@endsection

@section('content')
<!--begin::Authentication - Sign-in -->
<div class="d-flex flex-column flex-lg-row flex-column-fluid">
    <!--begin::Aside-->
    <div class="d-flex flex-column flex-lg-row-auto w-xl-600px positon-xl-relative" style="background-image: url('{{ asset('assets/admin/media/auth/sing_up.png') }}'); background-size: cover;">
        <!--begin::Wrapper-->
        <div class="d-flex flex-column position-xl-fixed top-0 bottom-0 w-xl-600px scroll-y">
            <!--begin::Content-->
            <div class="d-flex flex-row-fluid flex-column text-center p-10 pt-lg-20">
                @php
                    if(Route::has('ecommerce.home.index')):
                        $route = route('ecommerce.home.index');
                    endif;
                @endphp
                <!--begin::Logo-->
                <a href="{{  $route }}" class="py-9 mb-5">
                    <img class="img-fluid"  alt="{{ config('app.name') }}" src="{{ asset(config('app.logo')) }}"/>
                </a>
                <!--end::Logo-->
                <!--begin::Title-->
                {{-- <h1 class="fw-bolder fs-2qx pb-5 pb-md-10" style="color: #fff;">Creación de cuenta</h1> --}}
                <!--end::Title-->
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
                <form class="form w-100" action="{{ route('register') }}" method="POST">
                    @csrf
                    <!--begin::Heading-->
                    <div class="text-center mb-10">
                        <!--begin::Title-->
                        <h1 class="text-dark mb-3">{{ __('Create an account') }}</h1>
                        <!--end::Title-->
                    </div>
                    <!--begin::Heading-->
                    <!--begin::Input group-->
                    <div class="fv-row mb-10">
                        <!--begin::Label-->
                        <label class="form-label fs-6 fw-bolder text-dark">{{ __('Full name') }}</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input required class="form-control form-control-lg form-control-solid @error('name') is-invalid @enderror" value="{{ old('name') }}" type="text" name="name" autocomplete="on" />
                        <!--end::Input-->
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="fv-row mb-10">
                        <!--begin::Label-->
                        <label class="form-label fs-6 fw-bolder text-dark">{{ __('Email') }}</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input required class="form-control form-control-lg form-control-solid @error('email') is-invalid @enderror" value="{{ old('email') }}" type="email" name="email" autocomplete="on" />
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
                        </div>
                        <!--end::Wrapper-->
                        <!--begin::Input-->
                        <input required class="form-control form-control-lg form-control-solid @error('password') is-invalid @enderror" value="{{ old('password') }}" type="password" name="password" autocomplete="off" />
                        <!--end::Input-->
                        @error('password')
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
                            <label class="form-label fw-bolder text-dark fs-6 mb-0">{{ __('Confirm password') }}</label>
                            <!--end::Label-->
                        </div>
                        <!--end::Wrapper-->
                        <!--begin::Input-->
                        <input required class="form-control form-control-lg form-control-solid @error('password_confirmation') is-invalid @enderror" type="password" name="password_confirmation" autocomplete="off" />
                        <!--end::Input-->
                        @error('password_confirmation')
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
                            <span class="indicator-label">{{ __('Create an account') }}</span>
                        </button>
                        <!--end::Submit button-->
                    </div>
                    <!--end::Actions-->
                    @if (Route::has('login.google') && config('services.google.status'))
                        <!--begin::Separator-->
                        <div class="text-center text-muted text-uppercase fw-bolder mb-5">Ó</div>
                        <!--end::Separator-->
                        <!--begin::Google link-->
                        <a href="{{ route('login.google') }}" class="btn btn-flex flex-center btn-light btn-lg w-100 mb-5">
                            <img alt="Registrate con Google" src="{{ asset('assets/admin/media/svg/brand-logos/google-icon.svg') }}" class="h-20px me-3" />
                            {{ __('Continued with Google') }}
                        </a>
                        <!--end::Google link-->
                    @endif
                    <p class="pt-5"><a href="{{ route('login') }}" rel="noopener noreferrer">{{ __('Back to login') }}</a></p>
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
