<div class="card card-flush py-4">
    <!--begin::Card header-->
    <div class="card-header">
        <!--begin::Card title-->
        <div class="card-title">
            <h2>Marketplace</h2>
        </div>
        <!--end::Card title-->
    </div>
    <!--end::Card header-->
    <!--begin::Amazon-->
    <div class="card-body pt-0">
        <div class="form-group mb-5">
            <!--begin::Input group-->
            <!--begin::Label-->
            <label class="form-label">Amazon</label>
            <!--end::Label-->
            <!--begin::Input-->
            <input wire:model.defer="product.link_amazon" type="text" class="form-control mb-2 @error('product.link_amazon') invalid-feedback @enderror" placeholder="Link del producto en amazon"/>
            <!--end::Input-->
            @error('product.link_amazon')<small class="form-text text-danger" role="alert">{{ $message }}</small>@enderror
            <!--end::Input group-->
        </div>
        <div class="form-group">
            <!--begin::Input group-->
            <!--begin::Label-->
            <label class="form-label">Mercado libre</label>
            <!--end::Label-->
            <!--begin::Input-->
            <input wire:model.defer="product.link_mercadolibre" type="text" class="form-control mb-2 @error('product.link_mercadolibre') invalid-feedback @enderror" placeholder="Link del producto en mercadolibre"/>
            <!--end::Input-->
            @error('product.link_mercadolibre')<small class="form-text text-danger" role="alert">{{ $message }}</small>@enderror
            <!--end::Input group-->
        </div>
    </div>
    <!--end::Amazon-->
</div>
