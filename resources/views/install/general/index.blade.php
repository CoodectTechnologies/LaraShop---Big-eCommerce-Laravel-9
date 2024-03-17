@extends('install.layouts.main')

@section('content')
    <div class="d-flex flex-center flex-column flex-column-fluid">
        <div class="w-lg-700px p-10 p-lg-15 mx-auto">
            @include('admin.components.errors')
            <form action="{{ route('install.general.store') }}" class="my-auto pb-5" method="post" enctype="multipart/form-data">
                @csrf
                <div class="">
                    <!--begin::Wrapper-->
                    <div class="w-100">
                        <!--begin::Heading-->
                        <div class="pb-10 pb-lg-12">
                            <!--begin::Title-->
                            <h2 class="fw-bolder text-dark">Información general</h2>
                            <!--end::Title-->
                            <!--begin::Notice-->
                            <div class="text-muted fw-bold fs-6">Porfavor rellene la siguiente información</div>
                            <!--end::Notice-->
                        </div>
                        <!--end::Heading-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-10">
                            <!--begin::Label-->
                            <label class="form-label required">Nombre de la web</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input name="appName" value="{{ old('appName', config('app.name')) }}" type="text" class="form-control form-control-lg form-control-solid" placeholder="Ejem: El nombre de tu negocio." />
                            <!--end::Input-->
                            @error('appName') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-10">
                            <!--begin::Label-->
                            <label class="d-flex align-items-center form-label">
                                <span class="required">URL de la web</span>
                            </label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input name="appUrl" value="{{ old('appUrl', config('app.url')) }}" type="url" class="form-control form-control-lg form-control-solid" placeholder="Ejem: https://tupaginaweb.com" />
                            <!--end::Input-->
                            @error('appUrl') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
                        </div>
                        <!--end::Input group-->
                        <div class="row">
                            <div class="col-lg-4">
                                <!--begin::Logo original-->
                                <div class="fv-row mb-10">
                                    <!--begin::Label-->
                                    <label class="d-flex align-items-center form-label">
                                        <span class="required">Logotipo</span>
                                    </label>
                                    <!--end::Label-->
                                    <!--begin::Image input-->
                                    <div class="image-input image-input-empty" data-kt-image-input="true"
                                        @if(!public_path(config('app.logo')))
                                            style="background-image: url({{ asset('assets/admin/media/svg/files/blank-image.svg') }})"
                                        @endif>
                                        <!--begin::Image preview wrapper-->
                                        <div class="image-input-wrapper w-125px h-125px"
                                            @if(public_path(config('app.logo')))
                                                style="background-image: url({{ asset(config('app.logo')) }})"
                                            @endif>
                                        </div>
                                        <!--end::Image preview wrapper-->

                                        <!--begin::Edit button-->
                                        <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                            data-kt-image-input-action="change"
                                            data-bs-toggle="tooltip"
                                            data-bs-dismiss="click"
                                            title="Cambiar">
                                            <i class="bi bi-pencil-fill fs-7"></i>

                                            <!--begin::Inputs-->
                                            <input type="file" name="logo" accept=".png, .jpg, .jpeg, .webp" />
                                            <input type="hidden" name="logo_remove" />
                                            <!--end::Inputs-->
                                        </label>
                                        <!--end::Edit button-->

                                        <!--begin::Cancel button-->
                                        <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                            data-kt-image-input-action="cancel"
                                            data-bs-toggle="tooltip"
                                            data-bs-dismiss="click"
                                            title="Cancelar">
                                            <i class="bi bi-x fs-2"></i>
                                        </span>
                                        <!--end::Cancel button-->

                                        <!--begin::Remove button-->
                                        <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                            data-kt-image-input-action="remove"
                                            data-bs-toggle="tooltip"
                                            data-bs-dismiss="click"
                                            title="Remover">
                                            <i class="bi bi-x fs-2"></i>
                                        </span>
                                        <!--end::Remove button-->
                                    </div>
                                    <!--end::Image input-->
                                    @error('logo') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
                                </div>
                                <!--end::Logo original-->
                            </div>
                            <div class="col-lg-4">
                                <!--begin::Logo white-->
                                <div class="fv-row mb-10">
                                    <!--begin::Label-->
                                    <label class="d-flex align-items-center form-label">
                                        <span class="required">Logotipo blanco</span>
                                    </label>
                                    <!--end::Label-->
                                    <!--begin::Image input-->
                                    <div class="image-input image-input-empty" data-kt-image-input="true"
                                        @if(!public_path(config('app.logo_white')))
                                            style="background-image: url({{ asset('assets/admin/media/svg/files/blank-image.svg') }})"
                                        @endif>
                                        <!--begin::Image preview wrapper-->
                                        <div class="image-input-wrapper w-125px h-125px"
                                            @if(public_path(config('app.logo_white')))
                                                style="background-image: url({{ asset(config('app.logo_white')) }})"
                                            @endif>
                                        </div>
                                        <!--end::Image preview wrapper-->

                                        <!--begin::Edit button-->
                                        <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                            data-kt-image-input-action="change"
                                            data-bs-toggle="tooltip"
                                            data-bs-dismiss="click"
                                            title="Cambiar">
                                            <i class="bi bi-pencil-fill fs-7"></i>

                                            <!--begin::Inputs-->
                                            <input type="file" name="logoWhite" accept=".png, .jpg, .jpeg, .webp" />
                                            <input type="hidden" name="logo_white_remove" />
                                            <!--end::Inputs-->
                                        </label>
                                        <!--end::Edit button-->

                                        <!--begin::Cancel button-->
                                        <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                            data-kt-image-input-action="cancel"
                                            data-bs-toggle="tooltip"
                                            data-bs-dismiss="click"
                                            title="Cancelar">
                                            <i class="bi bi-x fs-2"></i>
                                        </span>
                                        <!--end::Cancel button-->

                                        <!--begin::Remove button-->
                                        <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                            data-kt-image-input-action="remove"
                                            data-bs-toggle="tooltip"
                                            data-bs-dismiss="click"
                                            title="Remover">
                                            <i class="bi bi-x fs-2"></i>
                                        </span>
                                        <!--end::Remove button-->
                                    </div>
                                    <!--end::Image input-->
                                    @error('logoWhite') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
                                </div>
                                <!--end::Logo white-->
                            </div>
                            <div class="col-lg-4">
                                <!--begin::Logo white-->
                                <div class="fv-row mb-10">
                                    <!--begin::Label-->
                                    <label class="d-flex align-items-center form-label">
                                        <span class="required">Logotipo favicon</span>
                                    </label>
                                    <!--end::Label-->
                                    <!--begin::Image input-->
                                    <div class="image-input image-input-empty" data-kt-image-input="true"
                                        @if(!public_path(config('app.logo_favicon')))
                                            style="background-image: url({{ asset('assets/admin/media/svg/files/blank-image.svg') }})"
                                        @endif>
                                        <!--begin::Image preview wrapper-->
                                        <div class="image-input-wrapper w-125px h-125px"
                                            @if(public_path(config('app.logo_favicon')))
                                                style="background-image: url({{ asset(config('app.logo_favicon')) }})"
                                            @endif>
                                        </div>
                                        <!--end::Image preview wrapper-->

                                        <!--begin::Edit button-->
                                        <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                            data-kt-image-input-action="change"
                                            data-bs-toggle="tooltip"
                                            data-bs-dismiss="click"
                                            title="Cambiar">
                                            <i class="bi bi-pencil-fill fs-7"></i>

                                            <!--begin::Inputs-->
                                            <input type="file" name="logoFavicon" accept=".png, .jpg, .jpeg, .webp" />
                                            <input type="hidden" name="logo_favicon_remove" />
                                            <!--end::Inputs-->
                                        </label>
                                        <!--end::Edit button-->

                                        <!--begin::Cancel button-->
                                        <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                            data-kt-image-input-action="cancel"
                                            data-bs-toggle="tooltip"
                                            data-bs-dismiss="click"
                                            title="Cancelar">
                                            <i class="bi bi-x fs-2"></i>
                                        </span>
                                        <!--end::Cancel button-->

                                        <!--begin::Remove button-->
                                        <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                            data-kt-image-input-action="remove"
                                            data-bs-toggle="tooltip"
                                            data-bs-dismiss="click"
                                            title="Remover">
                                            <i class="bi bi-x fs-2"></i>
                                        </span>
                                        <!--end::Remove button-->
                                    </div>
                                    <!--end::Image input-->
                                    @error('logoFavicon') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
                                </div>
                                <!--end::Logo white-->
                            </div>
                        </div>
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
