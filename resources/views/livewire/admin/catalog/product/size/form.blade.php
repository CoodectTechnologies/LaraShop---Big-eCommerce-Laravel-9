<div>
    @include('admin.components.errors')
    <form class="form" wire:submit.prevent="{{ $method }}">
        <!--::NAME SIZE-->
        <div class="fv-row mb-7">
            <label class="fs-6 fw-bold form-label mb-2">
                <span class="required">{{ __('Name') }}</span>
            </label>
            <input type="text" required wire:model.defer="size.name.{{ translatable() }}" class="form-control form-control-solid @error('size.name.{{ translatable() }}') invalid-feedback @enderror" placeholder="Ejem: XL" name="" />
            @error('size.name.{{ translatable() }}') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
        </div>
        <!--::NAME SIZE-->
        <div class="fv-row mb-7">
            <label class="fs-6 fw-bold form-label mb-2">
                <span class="required">{{ __('Price') }}</span>
            </label>
            <input type="text" required wire:model.defer="size.price" class="form-control form-control-solid @error('size.price') invalid-feedback @enderror" placeholder="{{ __('Price') }}" name="" />
            @error('size.price') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
        </div>
        <!--::¿TENDRÁ RELACIONES CON COLORES?-->
        <div class="fv-row mb-7">
            <label class="fs-6 fw-bold form-label mb-2">
                <span class="required">{{ __('Is it related to colors?') }}</span>
            </label>
            <select wire:model="size.relation_with_colors" class="form-control form-control-solid @error('size.relation_with_colors') invalid-feedback @enderror" required>
                <option value="">{{ __('Select a option') }}</option>
                <option value="SI">{{ __('Yes') }}</option>
                <option value="NO">NO</option>
            </select>
            @error('size.relation_with_colors') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
        </div>
        <div class="{{ $size->relation_with_colors == 'SI' ? 'd-block' : 'd-none' }}">
            <!--::COLORES-->
            <div class="fv-row mb-7">
                <label class="fs-6 fw-bold form-label mb-2">
                    <span class="required">{{ __('Related colors') }}</span>
                </label>
                <select wire:model.defer="sizeColors" class="sizeColors form-select mb-2 @error('sizeColors') invalid-feedback @enderror" data-control="select2" data-placeholder="{{ __('Select a option') }}" multiple="multiple">
                    <option></option>
                    @foreach ($colors as $color)
                        <option value="{{ $color->id }}">{{ $color->name }}</option>
                    @endforeach
                </select>
                @error('sizeColors') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
                <div class="text-muted fs-7 mb-7">{{ __('Add color(s) related to the measurement.') }}</div>
            </div>
            <div class="d-block">
                <table class="table g-5 gs-0 mb-0 fw-bolder text-gray-700">
                    <thead>
                        <tr class="border-bottom fs-7 fw-bolder text-gray-700 text-uppercase">
                            <th>{{ __('Color') }}</th>
                            <th>{{ __('Quantity') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sizeColorsTMP as $colorId => $sizeColorTMP)
                            <tr class="border-bottom border-bottom-dashed">
                                <td class="pe-7" style="align-items: center; display: flex; margin-top: 13px;">
                                    {{ $sizeColorsTMP[$colorId]['color'] }}
                                </td>
                                <td class="pe-7">
                                    <input type="text" required wire:model.defer="sizeColorsTMP.{{$colorId}}.quantity"  class="form-control form-control-solid mb-2" placeholder="Ej. 1">
                                    @error('sizeColorsTMP.'.$colorId.'.quantity') <span class="form-text text-danger">{{ $message }}</span> @enderror
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @error('sizeColorsTMP')<small class="form-text text-danger" role="alert">{{ $message }}</small>@enderror
        </div>
        <div class="{{ $size->relation_with_colors == 'NO' ? 'd-block' : 'd-none' }}">
            <!--::CANTIDAD, APLICA SIN COLORES RELACIONES-->
            <div class="fv-row mb-7">
                <label class="fs-6 fw-bold form-label mb-2">
                    <span class="required">{{ __('Quantity') }}</span>
                </label>
                <input type="number" wire:model.defer="size.quantity" class="form-control form-control-solid @error('size.quantity') invalid-feedback @enderror" placeholder="Ejem: 1" name="" />
                @error('size.quantity') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
            </div>
        </div>
        <!--begin::Actions-->
        <div class="text-center pt-15">
            <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal"><i class="fa fa-arrow-left"></i></button>
            <button wire:loading.attr="disabled" wire:target="{{ $method }}" type="submit" class="btn btn-primary">
                <span class="indicator-label">{{ __('Save changes') }}</span>
                <span wire:loading wire:target="{{ $method }}" class="spinner-border spinner-border-sm align-middle ms-2"></span>
            </button>
        </div>
        <!--end::Actions-->
    </form>
    @push('footer')
        <script>
            $('.sizeColors').select2().on('change', function (e) {
                let data = $(this).select2("val");
                @this.set('sizeColors', data);
            });
            Livewire.on('renderJs', function(){
                $('.sizeColors').select2();
            });
        </script>
    @endpush
</div>
