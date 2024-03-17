<div>
    @push('head')
        <link rel="stylesheet" href="{{ asset('assets/admin/plugins/custom/ckeditor/ckeditor5.css') }}">
    @endpush

    @include('admin.components.errors')

    <form wire:submit.prevent="{{ $method }}" class="form d-flex flex-column flex-lg-row pt-5">
        <!--begin::Aside column-->
        <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10">
            <!--begin::Image-->
            @include('admin.catalog.product.product.partials.form._image')
            <!--end::Image-->
            <!--begin::Technical datasheet-->
            @include('admin.catalog.product.product.partials.form._technical-datasheet')
            <!--end::Technical datasheet-->
            <!--begin::Marketplaces-->
            @include('admin.catalog.product.product.partials.form._marketplace')
            <!--end::Marketplaces-->
            <!--begin::Fetured-->
            @include('admin.catalog.product.product.partials.form._featured')
            <!--end::Fetured-->
            <!--begin:: Details-->
            @include('admin.catalog.product.product.partials.form._detail')
            <!--end:: Details-->
        </div>
        <!--end::Aside column-->
        <!--begin::Main column-->
        <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
            <!--begin::General-->
            @include('admin.catalog.product.product.partials.form._general')
            <!--end::General-->
            <!--begin::Description-->
            @include('admin.catalog.product.product.partials.form._description')
            <!--end::Description-->
            <!--begin::Gallery-->
            @include('admin.catalog.product.product.partials.form._gallery')
            <!--end::Gallery-->
            <!--begin::Shipping class-->
            @include('admin.catalog.product.product.partials.form._shipping-class')
            <!--end::Shipping class-->
            <!--begin::Dimension-->
            @include('admin.catalog.product.product.partials.form._dimension')
            <!--end::Dimension-->
            <!--begin::Meta options-->
            @include('admin.catalog.product.product.partials.form._meta-tag')
            <!--end::Meta options-->
            <!--end:: Save changes-->
            <div class="d-flex justify-content-end py-5">
                <!--begin::Button-->
                <a href="{{ route('admin.catalog.product.index') }}" class="btn btn-light me-5">{{ __('Cancel') }}</a>
                <!--end::Button-->
                <!--begin::Button-->
                <button wire:loading.attr="disabled" wire:target="{{ $method }}" type="submit" class="btn btn-primary">
                    <span class="indicator-label">{{ __('Save changes') }}</span>
                    <span wire:loading wire:target="{{ $method }}" class="spinner-border spinner-border-sm align-middle ms-2"></span>
                </button>
                <!--end::Button-->
            </div>
            <!--end:: Save changes-->
        </div>
        <!--end::Main column-->
    </form>

    <!-- Modals -->
    @include('admin.catalog.product.product.partials.form._modal')
    @push('footer')
        <script src="{{ asset('assets/admin/plugins/custom/ckeditor/ckeditor5.js') }}"></script>
        <script src="{{ asset('assets/admin/plugins/custom/ckeditor/ckeditor5-configuration.js') }}"></script>
        <script>
            $(document).ready(function(){
                ClassicEditor
                .create(document.querySelector(".ckeditor5"), CKEDITOR5_CONFIGURATION)
                .then(editor => {
                    editor.editing.view.document.on('change:isFocused', ( evt, data, isFocused ) => {
                        if(!isFocused){
                            @this.set('product.description.{{ translatable() }}', editor.getData());
                        }
                    })
                });
                Livewire.on('render', function(){
                    $('.modal').modal('hide');
                });
            });
        </script>
    @endpush
</div>
