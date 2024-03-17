<!--begin::Details-->
<div class="d-flex flex-wrap flex-sm-nowrap mb-3">
    <!--begin: Pic-->
    <div class="me-7 mb-4">
        <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
            <img src="{{ $product->imagePreview() }}" alt="{{ $product->name }}" />
        </div>
    </div>
    <!--end::Pic-->
    <!--begin::Info-->
    <div class="flex-grow-1">
        <!--begin::Title-->
        <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
            <!--begin::User-->
            <div class="d-flex flex-column">
                <!--begin::Name-->
                <div class="d-flex align-items-center mb-2">
                    <a href="#" class="text-gray-900 text-hover-primary fs-2 fw-bolder me-1">{{ $product->name }}</a>
                    {{-- Featured --}}
                    @if ($product->featured)
                        <span class="btn btn-sm btn-primary fw-bolder ms-2 fs-8 py-1 px-3">HOT</span>
                    @endif
                    {{-- Status --}}
                    @if ($product->status == 'Publicado')
                        <span class="btn btn-sm btn-primary fw-bolder ms-2 fs-8 py-1 px-3">{{ __('Published') }}</span>
                    @else
                        <span class="btn btn-sm btn-secondary fw-bolder ms-2 fs-8 py-1 px-3">{{ __('Draft') }}</span>
                    @endif
                </div>
                <!--end::Name-->
                <!--begin::Info-->
                <div class="fw-bold fs-6 mb-4 pe-2">
                    <div class="fw-bold fs-5 text-gray-400">{{  __('Sales') }}: {{ count($product->orders) }}</div>
                    <br>
                    <div class="fw-bold fs-5 text-gray-400">{{ __('Views') }} {{ $product->viewUniques() }}</div>
                </div>
                <!--end::Info-->
            </div>
            <!--end::User-->
            <!--begin::Actions-->
            <div class="d-flex my-4">
                <!--begin::Menu-->
                {{-- <div class="me-0">
                    <button wire:ignore.self class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                        <i class="bi bi-three-dots fs-3"></i>
                    </button>
                    <!--begin::Menu 3-->
                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800  fw-bold w-200px py-3" data-kt-menu="true">
                        <!--begin::Heading-->
                        <div class="menu-item px-3">
                            <div class="menu-content text-muted pb-2 px-3 fs-7 text-uppercase">Opciones</div>
                        </div>
                        <!--begin::Menu item-->
                        <div class="menu-item px-3">
                            <a href="#" class="menu-link px-3" >En espera de opciones</a>
                        </div>
                    </div>
                    <!--end::Menu 3-->
                </div> --}}
                <!--end::Menu-->
            </div>
            <!--end::Actions-->
        </div>
        <!--end::Title-->
        <!--begin::Stats-->
        <div class="d-flex flex-wrap flex-stack">
            <!--begin::Wrapper-->
            <div class="d-flex flex-column flex-grow-1 pe-8">
                <!--begin::Stats-->
                <div class="d-flex flex-wrap">
                    <!--begin::Stat-->
                    <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                        <!--begin::Number-->
                        <div class="d-flex align-items-center">
                            <div class="fs-2 fw-bolder">{!! $product->getPriceToString() !!}</div>
                        </div>
                        <!--end::Number-->
                        <!--begin::Label-->
                        <div class="fw-bold fs-6 text-gray-400">{{ __('Price') }}</div>
                        <!--end::Label-->
                    </div>
                    <!--end::Stat-->
                    <div class="symbol-group symbol-hover mb-3">
                        @foreach ($product->images()->get() as $image)
                            <!--begin::User-->
                            <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="{{ $product->name }}" data-bs-original-title="{{ $product->name }}">
                                <img alt="{{ $product->name }}" src="{{ $image->imagePreview() }}">
                            </div>
                            <!--end::User-->
                        @endforeach
                    </div>
                </div>
                <!--end::Stats-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Stats-->
    </div>
    <!--end::Info-->
</div>
