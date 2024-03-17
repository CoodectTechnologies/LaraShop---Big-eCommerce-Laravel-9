<!--begin::Aside-->
<div class="d-flex flex-column flex-lg-row-auto w-xl-500px bg-lighten shadow-sm">
    <!--begin::Wrapper-->
    <div class="d-flex flex-column position-xl-fixed top-0 bottom-0 w-xl-500px scroll-y">
        <!--begin::Header-->
        <div class="d-flex flex-row-fluid flex-column flex-center p-10 pt-lg-20">
            <!--begin::Logo-->
            <a href="{{ route('install.general.index') }}" class="mb-10 mb-lg-20">
                <img alt="Install sistem" src="{{ asset(config('app.logo')) }}"/>
            </a>
            <!--end::Logo-->
            <!--begin::Nav-->
            <div class="stepper-nav">
                <a href="{{ route('install.general.index') }}">
                    <!--begin::Step 1-->
                    <div class="stepper-item {{ active('install.general.index') }}">
                        <!--begin::Line-->
                        <div class="stepper-line w-40px"></div>
                        <!--end::Line-->
                        <!--begin::Icon-->
                        <div class="stepper-icon w-40px h-40px">
                            <i class="stepper-check fas fa-check"></i>
                            <span class="stepper-number">1</span>
                        </div>
                        <!--end::Icon-->
                        <!--begin::Label-->
                        <div class="stepper-label">
                            <h3 class="stepper-title">Información general</h3>
                            <div class="stepper-desc fw-bold">Ingresa la información basica</div>
                        </div>
                        <!--end::Label-->
                    </div>
                </a>
                <!--end::Step 1-->
                <a href="{{ route('install.database.index') }}">
                    <!--begin::Step 2-->
                    <div class="stepper-item {{ active('install.database.index') }}">
                        <!--begin::Line-->
                        <div class="stepper-line w-40px"></div>
                        <!--end::Line-->
                        <!--begin::Icon-->
                        <div class="stepper-icon w-40px h-40px">
                            <i class="stepper-check fas fa-check"></i>
                            <span class="stepper-number">2</span>
                        </div>
                        <!--end::Icon-->
                        <!--begin::Label-->
                        <div class="stepper-label">
                            <h3 class="stepper-title">Base de datos</h3>
                            <div class="stepper-desc fw-bold">Ingresa los accesos a la base de datos</div>
                        </div>
                        <!--end::Label-->
                    </div>
                </a>
                <!--end::Step 2-->
                <!--begin::Step 3-->
                <a href="{{ route('install.email.index') }}">
                    <div class="stepper-item {{ active('install.email.index') }}">
                        <!--begin::Line-->
                        <div class="stepper-line w-40px"></div>
                        <!--end::Line-->
                        <!--begin::Icon-->
                        <div class="stepper-icon w-40px h-40px">
                            <i class="stepper-check fas fa-check"></i>
                            <span class="stepper-number">3</span>
                        </div>
                        <!--end::Icon-->
                        <!--begin::Label-->
                        <div class="stepper-label">
                            <h3 class="stepper-title">Correo electronico</h3>
                            <div class="stepper-desc fw-bold">Ingresa los accesos de tu proveedor de correo</div>
                        </div>
                        <!--end::Label-->
                    </div>
                </a>
                <!--end::Step 3-->
                <!--begin::Step 4-->
                <a href="{{ route('install.user.index') }}">
                    <div class="stepper-item {{ active('install.user.index') }}">
                        <!--begin::Line-->
                        <div class="stepper-line w-40px"></div>
                        <!--end::Line-->
                        <!--begin::Icon-->
                        <div class="stepper-icon w-40px h-40px">
                            <i class="stepper-check fas fa-check"></i>
                            <span class="stepper-number">4</span>
                        </div>
                        <!--end::Icon-->
                        <!--begin::Label-->
                        <div class="stepper-label">
                            <h3 class="stepper-title">Usuario</h3>
                            <div class="stepper-desc fw-bold">Registro de administrador</div>
                        </div>
                        <!--end::Label-->
                    </div>
                </a>
                <!--end::Step 4-->
                <!--begin::Step 5-->
                <a href="{{ route('install.complete.index') }}">
                    <div class="stepper-item {{ active('install.complete.index') }}">
                        <!--begin::Line-->
                        <div class="stepper-line w-40px"></div>
                        <!--end::Line-->
                        <!--begin::Icon-->
                        <div class="stepper-icon w-40px h-40px">
                            <i class="stepper-check fas fa-check"></i>
                            <span class="stepper-number">5</span>
                        </div>
                        <!--end::Icon-->
                        <!--begin::Label-->
                        <div class="stepper-label">
                            <h3 class="stepper-title">Completado</h3>
                            <div class="stepper-desc fw-bold">Pasos completados</div>
                        </div>
                        <!--end::Label-->
                    </div>
                </a>
                <!--end::Step 5-->
            </div>
            <!--end::Nav-->
        </div>
        <!--end::Header-->
    </div>
    <!--end::Wrapper-->
</div>
<!--begin::Aside-->
