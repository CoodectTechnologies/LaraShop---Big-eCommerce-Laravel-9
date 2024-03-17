<!--begin::Card header-->
<div class="card-header cursor-pointer">
    <!--begin::Card title-->
    <div class="card-title m-0">
        <h3 class="fw-bolder m-0">{{ __('Details') }}</h3>
    </div>
    <!--end::Card title-->
</div>
<!--begin::Card header-->
<!--begin::Card body-->
<div class="card-body p-9">
    <!--begin::Input group-->
    <div class="row mb-7">
        <!--begin::Label-->
        <label class="col-lg-4 fw-bold text-muted">ID:</label>
        <!--end::Label-->
        <!--begin::Col-->
        <div class="col-lg-8">
            <span class="fw-bold fs-6 text-gray-800">{{ $product->id }}</span>
        </div>
        <!--end::Col-->
    </div>
    <!--end::Input group-->
    <!--begin::Input group-->
    <div class="row mb-7">
        <!--begin::Label-->
        <label class="col-lg-4 fw-bold text-muted">{{ __('User who registered the product') }}</label>
        <!--end::Label-->
        <!--begin::Col-->
        <div class="col-lg-8">
            <span class="fw-bold fs-6 text-gray-800">{{ $product->user ? $product->user->name : 'N/A' }}</span>
        </div>
        <!--end::Col-->
    </div>
    <!--end::Input group-->
    <!--begin::Row-->
    <div class="row mb-7">
        <!--begin::Label-->
        <label class="col-lg-4 fw-bold text-muted">{{ __('Categories') }}</label>
        <!--end::Label-->
        <!--begin::Col-->
        <div class="col-lg-8">
            <span class="fw-bolder fs-6 text-gray-800">
                @foreach ($product->productCategories as $category)
                    <span class="badge badge-primary">{{ $category->name }}</span>
                @endforeach
            </span>
        </div>
        <!--end::Col-->
    </div>
    <!--end::Row-->
    <!--begin::Row-->
    <div class="row mb-7">
        <!--begin::Label-->
        <label class="col-lg-4 fw-bold text-muted">{{ __('Gender') }}</label>
        <!--end::Label-->
        <!--begin::Col-->
        <div class="col-lg-8">
            <span class="fw-bolder fs-6 text-gray-800">
                @forelse ($product->productGenders as $productGender)
                    <a class="badge badge-success" href="{{ route('admin.catalog.gender.index', ['search' => $productGender->name]) }}">{{ $productGender->name }}</a>
                @empty
                    N/A
                @endforelse
            </span>
        </div>
        <!--end::Col-->
    </div>
    <!--end::Row-->
    <!--begin::Row-->
    <div class="row mb-7">
        <!--begin::Label-->
        <label class="col-lg-4 fw-bold text-muted">{{ __('Brand') }}</label>
        <!--end::Label-->
        <!--begin::Col-->
        <div class="col-lg-8">
            <span class="fw-bolder fs-6 text-gray-800">
                @if ($product->productBrand)
                    <a class="badge badge-success" href="{{ route('admin.catalog.brand.index', ['search' => $product->productBrand->name]) }}">{{ $product->productBrand->name }}</a>
                @else
                    N/A
                @endif
            </span>
        </div>
        <!--end::Col-->
    </div>
    <!--end::Row-->
    <!--begin::Row-->
    <div class="row mb-7">
        <!--begin::Label-->
        <label class="col-lg-4 fw-bold text-muted">{{ __('Shipping class') }}</label>
        <!--end::Label-->
        <!--begin::Col-->
        <div class="col-lg-8">
            <span class="fw-bolder fs-6 text-gray-800">
                @if ($product->shippingClass)
                    <a href="{{ route('admin.setting.shipping-class', ['search' => $product->shippingClass->name]) }}">{{ $product->shippingClass->name }}</a>
                @else
                    N/A
                @endif
            </span>
        </div>
        <!--end::Col-->
    </div>
    <!--end::Row-->
</div>
<!--end::Card body-->

<!--begin::Card header-->
<div class="card-header cursor-pointer">
    <!--begin::Card title-->
    <div class="card-title m-0">
        <h3 class="fw-bolder m-0">{{ __('General data') }}</h3>
    </div>
    <!--end::Card title-->
</div>
<!--begin::Card header-->
<!--begin::Card body-->
<div class="card-body p-9">
    <!--begin::Row-->
    <div class="row mb-7">
        <!--begin::Label-->
        <label class="col-lg-4 fw-bold text-muted">URL</label>
        <!--end::Label-->
        <!--begin::Col-->
        <div class="col-lg-8">
            @if (Route::has('ecommerce.product.index'))
                <span class="fw-bolder fs-6 text-gray-800"><a href="{{ route('ecommerce.product.show', $product) }}" target="_blank" rel="noopener noreferrer">{{ route('ecommerce.product.show', $product) }}</a></span>
            @endif
            @if (Route::has('web.product.index'))
                <span class="fw-bolder fs-6 text-gray-800"><a href="{{ route('web.product.show', $product) }}" target="_blank" rel="noopener noreferrer">{{ route('web.product.show', $product) }}</a></span>
            @endif
        </div>
        <!--end::Col-->
    </div>
    <!--end::Row-->
    <!--begin::Row-->
    <div class="row mb-7">
        <!--begin::Label-->
        <label class="col-lg-4 fw-bold text-muted">{{ __('Name of product') }}</label>
        <!--end::Label-->
        <!--begin::Col-->
        <div class="col-lg-8">
            <span class="fw-bolder fs-6 text-gray-800">{{ $product->name }}</span>
        </div>
        <!--end::Col-->
    </div>
    <!--end::Row-->
    <!--begin::Row-->
    <div class="row mb-7">
        <!--begin::Label-->
        <label class="col-lg-4 fw-bold text-muted">{{ __('SKU') }}</label>
        <!--end::Label-->
        <!--begin::Col-->
        <div class="col-lg-8">
            <span class="fw-bolder fs-6 text-gray-800">{{ $product->sku }}</span>
        </div>
        <!--end::Col-->
    </div>
    <!--end::Row-->
    <!--begin::Row-->
    <div class="row mb-7">
        <!--begin::Label-->
        <label class="col-lg-4 fw-bold text-muted">{{ __('Advanced search phrases') }}</label>
        <!--end::Label-->
        <!--begin::Col-->
        <div class="col-lg-8">
            <span class="fw-bolder fs-6 text-gray-800" style="white-space: pre-line;">{!! $product->search_advanced !!}</span>
        </div>
        <!--end::Col-->
    </div>
    <!--end::Row-->
    <!--begin::Row-->
    <div class="row mb-7">
        <!--begin::Label-->
        <label class="col-lg-4 fw-bold text-muted">{{ __('Quantity') }}</label>
        <!--end::Label-->
        <!--begin::Col-->
        <div class="col-lg-8">
            <span class="fw-bolder fs-6 text-gray-800">{{ $product->quantity === null ? 'Ilimitado' : $product->quantity }}</span>
        </div>
        <!--end::Col-->
    </div>
    <!--end::Row-->
    <!--begin::Input group-->
    <div class="row mb-7">
        <!--begin::Label-->
        <label class="col-lg-4 fw-bold text-muted">{{ __('Featured') }}</label>
        <!--end::Label-->
        <!--begin::Col-->
        <div class="col-lg-8">
            <span class="fw-bolder fs-6 text-gray-800">{{ $product->featured ? __('Yes') : 'No' }}</span>
        </div>
        <!--end::Col-->
    </div>
    <!--end::Input group-->
    <!--begin::Input group-->
    <div class="row mb-7">
        <!--begin::Label-->
        <label class="col-lg-4 fw-bold text-muted">{{ __('Status') }}</label>
        <!--end::Label-->
        <!--begin::Col-->
        <div class="col-lg-8">
            <span class="fw-bolder fs-6 text-gray-800">{{ $product->status }}</span>
        </div>
        <!--end::Col-->
    </div>
    <!--end::Input group-->
    <!--begin::Input group-->
    <div class="row mb-7">
        <!--begin::Label-->
        <label class="col-lg-4 fw-bold text-muted">{{ __('Type') }}</label>
        <!--end::Label-->
        <!--begin::Col-->
        <div class="col-lg-8">
            <span class="fw-bolder fs-6 text-gray-800">{{ $product->type }}</span>
        </div>
        <!--end::Col-->
    </div>
    <!--end::Input group-->
    <!--begin::Input group-->
    <div class="row mb-7">
        <!--begin::Label-->
        <label class="col-lg-4 fw-bold text-muted">{{ __('Wholesale rule to which it applies') }}
        </label>
        <!--end::Label-->
        <!--begin::Col-->
        <div class="col-lg-8">
            @if ($wholesale = $product->getWholesale())
                <span class="fw-bolder fs-6 text-primary-800">
                    <a href="{{ route('admin.wholesale.edit', $wholesale) }}">{{ $wholesale->name }}</a>
                </span>
            @else
                <span class="fw-bolder fs-6 text-gray-800">N/A</span>
            @endif
        </div>
        <!--end::Col-->
    </div>
    <!--end::Input group-->
    <!--begin::Input group-->
    <div class="row mb-7">
        <!--begin::Label-->
        <label class="col-lg-4 fw-bold text-muted">{{ __('Promotion to which you apply') }}
       </label>
        <!--end::Label-->
        <!--begin::Col-->
        <div class="col-lg-8">
            @if ($promotion = $product->getPromotion())
                <span class="fw-bolder fs-6 text-primary-800">
                    <a href="{{ route('admin.promotion.edit', $promotion) }}">{{ $promotion->name }} ({{ $product->getPromotionPercentage() }}%)</a>
                </span>
            @else
                <span class="fw-bolder fs-6 text-gray-800">N/A</span>
            @endif
        </div>
        <!--end::Col-->
    </div>
    <!--end::Input group-->
    <!--begin::Input group-->
    <div class="row mb-7">
        <!--begin::Label-->
        <label class="col-lg-4 fw-bold text-muted">Link Amazon</label>
        <!--end::Label-->
        <!--begin::Col-->
        <div class="col-lg-8">
            <span class="fw-bolder fs-6 text-gray-800"><a href="{{ $product->link_amazon }}" target="_blank" rel="noopener noreferrer">{{ $product->link_amazon }}</a></span>
        </div>
        <!--end::Col-->
    </div>
    <!--end::Input group-->
    <!--begin::Input group-->
    <div class="row mb-7">
        <!--begin::Label-->
        <label class="col-lg-4 fw-bold text-muted">Link Mercado pago</label>
        <!--end::Label-->
        <!--begin::Col-->
        <div class="col-lg-8">
            <span class="fw-bolder fs-6 text-gray-800"><a href="{{ $product->link_mercadolibre }}" target="_blank" rel="noopener noreferrer">{{ $product->link_mercadolibre }}</a></span>
        </div>
        <!--end::Col-->
    </div>
    <!--end::Input group-->
    <!--begin::Input group-->
    <div class="row mb-7">
        <!--begin::Label-->
        <label class="col-lg-4 fw-bold text-muted">{{ __('Is it downloadable?') }}</label>
        <!--end::Label-->
        <!--begin::Col-->
        <div class="col-lg-8">
            <span class="fw-bolder fs-6 text-gray-800">{{ $product->getIsDownloadable() ? __('Yes') : 'NO' }}</span>
        </div>
        <!--end::Col-->
    </div>
    <!--end::Input group-->
    <!--begin::Input group-->
    <div class="row mb-10">
        <!--begin::Label-->
        <label class="col-lg-4 fw-bold text-muted">{{ __('File digital') }}</label>
        <!--begin::Label-->
        <!--begin::Label-->
        <div class="col-lg-8">
            <span class="fw-bold fs-6 text-gray-800">
                @if ($product->file_digital)
                    <div class="embed-responsive embed-responsive-16by9">
                        <iframe class="embed-responsive-item" width="100%" height="400px" allowfullscreen src="{{ Storage::url($product->file_digital) }}"></iframe>
                    </div>
                @endif
            </span>
        </div>
        <!--begin::Label-->
    </div>
    <!--end::Input group-->
    <!--begin::Input group-->
    <div class="row mb-10">
        <!--begin::Label-->
        <label class="col-lg-4 fw-bold text-muted">Video Iframe</label>
        <!--begin::Label-->
        <!--begin::Label-->
        <div class="col-lg-8">
            <span class="fw-bold fs-6 text-gray-800">
                {!! $product->iframe_url !!}
            </span>
        </div>
        <!--begin::Label-->
    </div>
    <!--end::Input group-->
    <!--begin::Input group-->
    <div class="row mb-10">
        <!--begin::Label-->
        <label class="col-lg-4 fw-bold text-muted">{{ __('Data sheet') }}</label>
        <!--begin::Label-->
        <!--begin::Label-->
        <div class="col-lg-8">
            <span class="fw-bold fs-6 text-gray-800">
                @if ($product->technical_datasheet)
                    <div class="embed-responsive embed-responsive-16by9">
                        <iframe class="embed-responsive-item" width="100%" height="400px" allowfullscreen src="{{ Storage::url($product->technical_datasheet) }}"></iframe>
                    </div>
                @endif
            </span>
        </div>
        <!--begin::Label-->
    </div>
    <!--end::Input group-->
    <!--begin::Row-->
    <div class="row mb-7">
        <!--begin::Label-->
        <label class="col-lg-4 fw-bold text-muted">{{ __('Detail') }}</label>
        <!--end::Label-->
        <!--begin::Col-->
        <div class="col-lg-8">
            <span class="fw-bolder fs-6 text-gray-800" style="white-space: pre-line;">{!! $product->detail !!}</span>
        </div>
        <!--end::Col-->
    </div>
    <!--end::Row-->
    <!--begin::Row-->
    <div class="row mb-7">
        <!--begin::Label-->
        <label class="col-lg-4 fw-bold text-muted">{{ __('Description') }}</label>
        <!--end::Label-->
        <!--begin::Col-->
        <div class="col-lg-8">
            <span class="fw-bolder fs-6 text-gray-800">{!! $product->description !!}</span>
        </div>
        <!--end::Col-->
    </div>
    <!--end::Row-->
</div>
<!--end::Card body-->

<!--begin::Card header-->
<div class="card-header cursor-pointer">
    <!--begin::Card title-->
    <div class="card-title m-0">
        <h3 class="fw-bolder m-0">{{ __('Shipping information') }}</h3>
    </div>
    <!--end::Card title-->
</div>
<!--begin::Card header-->
<!--begin::Card body-->
<div class="card-body p-9">
    <!--begin::Input group-->
    <div class="row mb-10">
        <!--begin::Label-->
        <label class="col-lg-4 fw-bold text-muted">{{ __('Weight') }} (KL)</label>
        <!--begin::Label-->
        <!--begin::Label-->
        <div class="col-lg-8">
            <span class="fw-bold fs-6 text-gray-800">{{ $product->weight_kl }}</span>
        </div>
        <!--begin::Label-->
    </div>
    <!--end::Input group-->
    <!--begin::Input group-->
    <div class="row mb-10">
        <!--begin::Label-->
        <label class="col-lg-4 fw-bold text-muted">{{ __('Weight') }} (GR)</label>
        <!--begin::Label-->
        <!--begin::Label-->
        <div class="col-lg-8">
            <span class="fw-bold fs-6 text-gray-800">{{ $product->weight_gr }}</span>
        </div>
        <!--begin::Label-->
    </div>
    <!--end::Input group-->
    <!--begin::Input group-->
    <div class="row mb-10">
        <!--begin::Label-->
        <label class="col-lg-4 fw-bold text-muted">{{ __('Height') }}</label>
        <!--begin::Label-->
        <!--begin::Label-->
        <div class="col-lg-8">
            <span class="fw-bold fs-6 text-gray-800">{{ $product->height }}</span>
        </div>
        <!--begin::Label-->
    </div>
    <!--end::Input group-->
    <!--begin::Input group-->
    <div class="row mb-10">
        <!--begin::Label-->
        <label class="col-lg-4 fw-bold text-muted">{{ __('Width') }}</label>
        <!--begin::Label-->
        <!--begin::Label-->
        <div class="col-lg-8">
            <span class="fw-bold fs-6 text-gray-800">{{ $product->width }}</span>
        </div>
        <!--begin::Label-->
    </div>
    <!--end::Input group-->
    <!--begin::Input group-->
    <div class="row mb-10">
        <!--begin::Label-->
        <label class="col-lg-4 fw-bold text-muted">{{ __('Length') }}</label>
        <!--begin::Label-->
        <!--begin::Label-->
        <div class="col-lg-8">
            <span class="fw-bold fs-6 text-gray-800">{{ $product->length }}</span>
        </div>
        <!--begin::Label-->
    </div>
    <!--end::Input group-->
</div>
<!--end::Card body-->

<!--begin::Card header-->
<div class="card-header cursor-pointer">
    <!--begin::Card title-->
    <div class="card-title m-0">
        <h3 class="fw-bolder m-0">{{ __('Meta tags') }}</h3>
    </div>
    <!--end::Card title-->
</div>
<!--begin::Card header-->
<!--begin::Card body-->
<div class="card-body p-9">
    <!--begin::Input group-->
    <div class="row mb-10">
        <!--begin::Label-->
        <label class="col-lg-4 fw-bold text-muted">{{ __('Meta tag title') }}</label>
        <!--begin::Label-->
        <!--begin::Label-->
        <div class="col-lg-8">
            <span class="fw-bold fs-6 text-gray-800">{{ $product->meta_title }}</span>
        </div>
        <!--begin::Label-->
    </div>
    <!--end::Input group-->
    <!--begin::Input group-->
    <div class="row mb-10">
        <!--begin::Label-->
        <label class="col-lg-4 fw-bold text-muted">{{ __('Meta tag description') }}</label>
        <!--begin::Label-->
        <!--begin::Label-->
        <div class="col-lg-8">
            <span class="fw-bold fs-6 text-gray-800">{{ $product->meta_description }}</span>
        </div>
        <!--begin::Label-->
    </div>
    <!--end::Input group-->
    <!--begin::Input group-->
    <div class="row mb-10">
        <!--begin::Label-->
        <label class="col-lg-4 fw-bold text-muted">{{ __('Meta tag keywords') }}</label>
        <!--begin::Label-->
        <!--begin::Label-->
        <div class="col-lg-8">
            <span class="fw-bold fs-6 text-gray-800">{{ $product->meta_keywords }}</span>
        </div>
        <!--begin::Label-->
    </div>
    <!--end::Input group-->
</div>
<!--end::Card body-->

<!--begin::Card header-->
<div class="card-header cursor-pointer">
    <!--begin::Card title-->
    <div class="card-title m-0">
        <h3 class="fw-bolder m-0">{{ __('Gallery') }}</h3>
    </div>
    <!--end::Card title-->
</div>
<!--begin::Card header-->
<!--begin::Card body-->
<div class="card-body p-9">
    <!--end::Input group-->
    <div class="row">
        @foreach ($product->images as $image)
            <div class="col-lg-6">
                <!--begin::Overlay-->
                <a class="d-block overlay m-5" data-fslightbox="lightbox-basic" href="{{ $image->imagePreview() }}">
                    <!--begin::Image-->
                    <div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-175px"
                        style="background-image:url('{{ $image->imagePreview() }}')">
                    </div>
                    <!--end::Image-->

                    <!--begin::Action-->
                    <div class="overlay-layer card-rounded bg-dark bg-opacity-25 shadow">
                        <i class="bi bi-eye-fill text-white fs-3x"></i>
                    </div>
                    <!--end::Action-->
                </a>
                <!--end::Overlay-->
            </div>
        @endforeach
    </div>
</div>
