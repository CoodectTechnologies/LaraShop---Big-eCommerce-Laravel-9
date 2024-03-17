@extends('install.layouts.main')

@section('content')
    <div class="d-flex flex-center flex-column flex-column-fluid">
        <div class="w-lg-700px p-10 p-lg-15 mx-auto">
            @include('admin.components.errors')
            <form action="{{ route('install.database.store') }}" class="my-auto pb-5" method="post" enctype="multipart/form-data">
                @csrf
                <div class="">
                    <!--begin::Wrapper-->
                    <div class="w-100">
                        <!--begin::Heading-->
                        <div class="pb-10 pb-lg-12">
                            <!--begin::Title-->
                            <h2 class="fw-bolder text-dark">Base de datos</h2>
                            <!--end::Title-->
                            <!--begin::Notice-->
                            <div class="text-muted fw-bold fs-6">Porfavor rellene la siguiente información</div>
                            <!--end::Notice-->
                        </div>
                        <!--end::Heading-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-10">
                            <!--begin::Label-->
                            <label class="form-label required">Conexión</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <select name="connection" required class="form-select form-select-lg form-select-solid" data-control="select2" data-placeholder="Conexión..." data-allow-clear="true" data-hide-search="true">
                                <option></option>
                                <option {{ old('connection', config('database.default')) == 'mysql' ? 'selected' : '' }} value="mysql">MySQL</option>
                                <option {{ old('connection', config('database.default')) == 'sqlite' ? 'selected' : '' }} value="sqlite">SQLite</option>
                                <option {{ old('connection', config('database.default')) == 'pgsql' ? 'selected' : '' }} value="pgsql">Postgress</option>
                                <option {{ old('connection', config('database.default')) == 'sqlsrv' ? 'selected' : '' }} value="sqlsrv">SQL Server</option>
                            </select>
                            <!--end::Input-->
                            @error('connection') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
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
                            <input name="host" value="{{ old('host', env('DB_HOST')) }}" required type="text" class="form-control form-control-lg form-control-solid" placeholder="Ejem: 127.0.0.1" />
                            <!--end::Input-->
                            @error('host') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-10">
                            <!--begin::Label-->
                            <label class="d-flex align-items-center form-label">
                                <span class="required">Puerto</span>
                            </label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input name="port" value="{{ old('port', env('DB_PORT')) }}" type="number" required class="form-control form-control-lg form-control-solid" placeholder="Ejem: 3306" />
                            <!--end::Input-->
                            @error('port') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-10">
                            <!--begin::Label-->
                            <label class="d-flex align-items-center form-label">
                                <span class="required">Base de datos</span>
                            </label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input name="database" value="{{ old('database', env('DB_DATABASE')) }}" required type="text" class="form-control form-control-lg form-control-solid" placeholder="Ejem: dbtest" />
                            <!--end::Input-->
                            @error('database') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-10">
                            <!--begin::Label-->
                            <label class="d-flex align-items-center form-label">
                                <span class="required">Usuario</span>
                            </label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input name="username" value="{{ old('username', env('DB_USERNAME')) }}" required type="text" class="form-control form-control-lg form-control-solid" placeholder="Ejem: root" />
                            <!--end::Input-->
                            @error('username') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-10">
                            <!--begin::Label-->
                            <label class="d-flex align-items-center form-label">
                                <span class="">Contraseña</span>
                            </label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input name="password" value="{{ old('password', env('DB_PASSWORD')) }}" type="password" class="form-control form-control-lg form-control-solid" placeholder="**********" />
                            <!--end::Input-->
                            @error('password') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
                        </div>
                        <!--end::Input group-->
                        <hr>
                        <!--begin::Input group-->
                        <div class="fv-row mb-10">
                            <div class="form-check form-check-custom form-check-solid">
                                <!--begin::Input-->
                                <input name="withSeeders" value="{{ old('withSeeders', true) }}" type="checkbox" class="form-check-input" id="withSeeders"/>
                                <!--end::Input-->
                                <label class="form-check-label" for="withSeeders">
                                    Habilitar datos de llenado (Creación de productos, categorias, Banners, etc.)
                                </label>
                                @error('withSeeders') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
                            </div>
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
