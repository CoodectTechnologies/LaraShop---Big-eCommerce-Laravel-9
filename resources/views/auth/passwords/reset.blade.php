@extends('auth.main')

@section('head')
<title>{{ __('Reset password') }}</title>
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
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <!--begin::Logo-->
                @php
                    if(Route::has('ecommerce.home.index')):
                        $route = route('ecommerce.home.index');
                    endif;
                @endphp
                <div class="text-center my-5">
                    <a href="{{ $route }}" class="py-9 mb-5">
                        <img class="img-fluid" alt="{{ config('app.name') }}" src="{{ asset(config('app.logo')) }}" />
                    </a>
                </div>
                <!--begin::Form-->
                <form class="form w-100" action="{{ route('password.update') }}" method="POST">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <!--begin::Heading-->
                    <div class="text-center mb-10">
                        <h1 class="text-dark mb-3">{{ __('Reset Password') }}</h1>
                    </div>
                    <div class="fv-row mb-10">
                        <label class="form-label fs-6 fw-bolder text-dark">{{ __('Email') }}</label>
                        <input class="form-control form-control-lg form-control-solid @error('email') is-invalid @enderror" value="{{ $email ?? old('email') }}" type="email" name="email" autocomplete="on" autofocus required/>
                        @error('email')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                    </div>
                    <div class="fv-row mb-10">
                        <label class="form-label fs-6 fw-bolder text-dark">{{ __('Password') }}</label>
                        <input class="form-control form-control-lg form-control-solid @error('password') is-invalid @enderror" id="password" type="password" name="password" required/>
                        @error('password')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                    </div>
                    <div class="fv-row mb-10">
                        <label class="form-label fs-6 fw-bolder text-dark">{{ __('Confirm Password') }}</label>
                        <input class="form-control form-control-lg form-control-solid @error('password') is-invalid @enderror" id="password-confirm" type="password" name="password_confirmation" required/>
                        @error('password')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                    </div>
                    <div class="text-center">
                        <!--begin::Submit button-->
                        <button type="submit" class="btn btn-lg btn-primary w-100 mb-5">
                            <span class="indicator-label">{{ __('Reset Password') }}</span>
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

