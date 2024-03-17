<!--begin::Navs-->
<ul class="nav nav-stretch nav-tabs nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bolder">
    <!--begin::Nav item-->
    <li class="nav-item mt-2">
        <a wire:ignore.self class="nav-link text-active-primary ms-0 me-10 py-5 {{ $submodule === null ? 'active' : '' }}"  data-bs-toggle="tab" href="#kt_product_general_tab">{{ __('General') }}</a>
    </li>
    <!--end::Nav item-->
    <!--begin::Nav item-->
    <li class="nav-item mt-2">
        <a wire:ignore.self class="nav-link text-active-primary ms-0 me-10 py-5 {{ $submodule === 'color' ? 'active' : '' }}"  data-bs-toggle="tab" href="#kt_product_color_tab">{{ __('Colors') }}</a>
    </li>
    <!--end::Nav item-->
    <!--begin::Nav item-->
    <li class="nav-item mt-2">
        <a wire:ignore.self class="nav-link text-active-primary ms-0 me-10 py-5 {{ $submodule === 'size' ? 'active' : '' }}"  data-bs-toggle="tab" href="#kt_product_size_tab">{{ __('Sizes') }}</a>
    </li>
    <!--end::Nav item-->
    <!--begin::Nav item-->
    <li class="nav-item mt-2">
        <a wire:ignore.self class="nav-link text-active-primary ms-0 me-10 py-5 {{ $submodule === 'similar' ? 'active' : '' }}"  data-bs-toggle="tab" href="#kt_product_similar_tab">{{ __('Similar') }}</a>
    </li>
    <!--end::Nav item-->
    <!--begin::Nav item-->
    <li class="nav-item mt-2">
        <a wire:ignore.self class="nav-link text-active-primary ms-0 me-10 py-5 {{ $submodule === 'comments' ? 'active' : '' }}" data-bs-toggle="tab" href="#kt_product_comment_tab">{{ __('Comments') }}</a>
    </li>
    <!--end::Nav item-->
    <!--begin::Nav item-->
    <li class="nav-item mt-2">
        <a wire:ignore.self class="nav-link text-active-primary ms-0 me-10 py-5 {{ $submodule === 'analytic' ? 'active' : '' }}" data-bs-toggle="tab" href="#kt_product_analytic_tab">{{ __('Statistical data') }}</a>
    </li>
    <!--end::Nav item-->
</ul>
<!--begin::Navs-->
