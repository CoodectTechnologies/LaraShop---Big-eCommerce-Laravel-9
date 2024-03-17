@extends('install.layouts.main')

@section('content')
    <div class="d-flex flex-center flex-column flex-column-fluid">
        <div class="w-lg-700px p-10 p-lg-15 mx-auto">
            @include('admin.components.errors')
            <form action="{{ route('install.email.store') }}" class="my-auto pb-5" method="post" enctype="multipart/form-data">
                @csrf
                <div class="">
                    <!--begin::Wrapper-->
                    <div class="w-100">
                        <!--begin::Heading-->
                        <div class="pb-10 pb-lg-12">
                            <!--begin::Title-->
                            <h2 class="fw-bolder text-dark">Correo electronico</h2>
                            <!--end::Title-->
                            <!--begin::Notice-->
                            <div class="text-muted fw-bold fs-6">Porfavor rellene la siguiente información</div>
                            <!--end::Notice-->
                        </div>
                        <!--end::Heading-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-10">
                            <!--begin::Label-->
                            <label class="form-label required">Salida</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <select name="mailer" required class="form-select form-select-lg form-select-solid" data-control="select2" data-placeholder="Salida..." data-allow-clear="true" data-hide-search="true">
                                <option></option>
                                <option {{ old('mailer', config('mail.default')) == 'smtp' ? 'selected' : '' }} value="smtp">SMTP</option>
                                <option {{ old('mailer', config('mail.default')) == 'sendmail' ? 'selected' : '' }} value="sendmail">SENDMAIL</option>
                                <option {{ old('mailer', config('mail.default')) == 'mailgun' ? 'selected' : '' }} value="mailgun">MAILGUN</option>
                                <option {{ old('mailer', config('mail.default')) == 'ses' ? 'selected' : '' }} value="ses">SES</option>
                                <option {{ old('mailer', config('mail.default')) == 'postmark' ? 'selected' : '' }} value="postmark">POSTMARK</option>
                                <option {{ old('mailer', config('mail.default')) == 'log' ? 'selected' : '' }} value="log">LOG</option>
                                <option {{ old('mailer', config('mail.default')) == 'array' ? 'selected' : '' }} value="array">ARRAY</option>
                                <option {{ old('mailer', config('mail.default')) == 'failover' ? 'selected' : '' }} value="failover">FAILOVER</option>
                            </select>
                            <!--end::Input-->
                            @error('mailer') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-10">
                            <!--begin::Label-->
                            <label class="d-flex align-items-center form-label">
                                <span class="required">host</span>
                            </label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input name="host" value="{{ old('host', env('MAIL_HOST')) }}" required type="text" class="form-control form-control-lg form-control-solid" placeholder="Ejem: smtp.tupagina.com" />
                            <!--end::Input-->
                            @error('host') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-10">
                            <!--begin::Label-->
                            <label class="form-label required">Puerto</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <select name="port" required class="form-select form-select-lg form-select-solid" data-control="select2" data-placeholder="Puerto..." data-allow-clear="true" data-hide-search="true">
                                <option></option>
                                <option {{ old('port', env('MAIL_PORT')) == '465' ? 'selected' : '' }} value="465">465</option>
                                <option {{ old('port', env('MAIL_PORT')) == '587' ? 'selected' : '' }} value="587">587</option>
                            </select>
                            <!--end::Input-->
                            @error('port') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-10">
                            <!--begin::Label-->
                            <label class="d-flex align-items-center form-label">
                                <span class="required">Correo de salida</span>
                            </label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input name="username" value="{{ old('username', env('MAIL_USERNAME')) }}" required type="text" class="form-control form-control-lg form-control-solid" placeholder="Ejem: hola@tupagina.com" />
                            <!--end::Input-->
                            @error('username') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-10">
                            <!--begin::Label-->
                            <label class="d-flex align-items-center form-label">
                                <span class="required">Contraseña</span>
                            </label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input name="password" required value="{{ old('password', env('MAIL_PASSWORD')) }}" type="password" class="form-control form-control-lg form-control-solid" placeholder="**********" />
                            <!--end::Input-->
                            @error('password') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-10">
                            <!--begin::Label-->
                            <label class="form-label required">Encriptación</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <select name="encriptation" required class="form-select form-select-lg form-select-solid" data-control="select2" data-placeholder="Salida..." data-allow-clear="true" data-hide-search="true">
                                <option></option>
                                <option {{ old('encriptation', env('MAIL_ENCRYPTION')) == 'ssl' ? 'selected' : '' }} value="ssl">SSL</option>
                                <option {{ old('encriptation', env('MAIL_ENCRYPTION')) == 'tls' ? 'selected' : '' }} value="tls">TLS</option>
                            </select>
                            <!--end::Input-->
                            @error('encriptation') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
                        </div>
                        <!--end::Input group-->
                    </div>
                    <!--end::Wrapper-->
                </div>
                <div class="d-flex justify-content-end pt-15">
                    <button type="submit" class="btn btn-lg btn-primary">
                        Continuar
                        <span class="svg-icon svg-icon-4 ms-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <rect opacity="0.5" x="18" y="13" width="13" height="2" rx="1" transform="rotate(-180 18 13)" fill="black" />
                                <path d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z" fill="black" />
                            </svg>
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
