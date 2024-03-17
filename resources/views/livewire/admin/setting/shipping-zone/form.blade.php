<div class="flex-lg-row-fluid ms-lg-7 ms-xl-10">
    @include('admin.components.errors')
    <div class="card card-flush">
        <div class="card-body pt-0">
            <div class="card">
                <div class="card-body">
                    <form class="form" wire:submit.prevent="{{ $method }}">
                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-bold form-label mb-2">
                                <span class="required">Nombre de la zona</span>
                            </label>
                            <input wire:model.defer="shippingZone.name" class="form-control form-control-solid @error('shippingZone.name') invalid-feedback @enderror" placeholder="Ejem: Guadalajara"  />
                            @error('shippingZone.name') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
                        </div>
                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-bold form-label mb-2">
                                <span class="required">Alias (Visible a publico)</span>
                            </label>
                            <input wire:model.defer="shippingZone.alias" class="form-control form-control-solid @error('shippingZone.alias') invalid-feedback @enderror" placeholder="Ejem: Estafeta"  />
                            @error('shippingZone.alias') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="fv-row mb-7">
                                    <label class="fs-6 fw-bold form-label mb-2">
                                        <span class="required">{{ __('Shipping price') }}</span>
                                    </label>
                                    <input wire:model.defer="shippingZone.price" class="form-control form-control-solid @error('shippingZone.price') invalid-feedback @enderror" placeholder="Ejem: 90"  />
                                    @error('shippingZone.price') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="fv-row mb-7">
                                    <label class="fs-6 fw-bold form-label mb-2">
                                        <span class="required">{{ __('SHIPPING DAYS') }}</span>
                                    </label>
                                    <input wire:model.defer="shippingZone.shipping_days" type="number" class="form-control form-control-solid @error('shippingZone.shipping_days') invalid-feedback @enderror" placeholder="Ejem: 5"  />
                                    @error('shippingZone.shipping_days') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-bold form-label mb-2">
                                <span class="">Precio de envío gratis en una compra mayor o igual a</span> <br>
                                <span class="badge badge-light">Dejar en blanco en caso de no aplicar</span>
                            </label>
                            <input wire:model.defer="shippingZone.free_shipping_over_to" type="number" class="form-control form-control-solid @error('shippingZone.free_shipping_over_to') invalid-feedback @enderror" placeholder="Ejem: 90"  />
                            @error('shippingZone.free_shipping_over_to') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="fv-row mb-7">
                                    <div wire:ignore>
                                        <label class="fs-6 fw-bold form-label mb-2">
                                            <span class="required">{{ __('Country') }}</span>
                                        </label>
                                        <select wire:model.defer="countryId" class="countryId form-select form-select-solid @error('countryId') invalid-feedback @enderror" data-control="select2" data-placeholder="Selecciona los estados" data-allow-clear="true">
                                            <option value="">{{ __('Select a option') }}</option>
                                            @foreach ($countries as $country)
                                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('countryId') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="fv-row mb-7">
                                    <div>
                                        <label class="fs-6 fw-bold form-label mb-2">
                                            <span class="required">{{ __('State') }}</span>
                                        </label>
                                        <select wire:model.defer="shippingZoneStatesArray" class="shippingZonestatesArray form-select form-select-solid @error('shippingZoneStatesArray') invalid-feedback @enderror" multiple="multiple">
                                            <option value="">Selecciona los estados</option>
                                            @foreach ($states as $state)
                                                <option value="{{ $state->id }}">{{ $state->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('shippingZoneStatesArray') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-bold form-label mb-2">
                                <span class="">Limitar a codigos postales especificos</span>
                            </label>
                            <textarea wire:model.defer="shippingZone.zip_codes" cols="10" rows="10" class="form-control form-control-solid @error('shippingZone.zip_codes') invalid-feedback @enderror" placeholder="Escribe los códigos postales separados por comas, Los códigos postales que contienen rangos totalmente numéricos (p.ej.: 90210...99000) también son compatibles.">{{ $shippingZone->zip_codes }}</textarea>
                            @error('shippingZone.zip_codes') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
                        </div>

                        @if (count($shippingClasses))
                            {{-- Shipping Classes --}}
                            @foreach ($shippingClasses as $shippingClass)
                                <h5>{{ $shippingClass->name }}</h5>
                                <div class="row">
                                    <div class="col-6 fv-row mb-7">
                                        <label class="fs-6 fw-bold form-label mb-2">
                                            <span class="">{{ __('Shipping price') }}</span>
                                        </label>
                                        <input wire:model.defer="shippingZonesClassArray.{{ $shippingClass->id }}.price" class="form-control form-control-solid @error('shippingZonesClassArray.{{ $shippingClass->id }}.price') invalid-feedback @enderror" placeholder="Ejem: 90"/>
                                        @error('shippingZonesClassArray.{{ $shippingClass->id }}.price') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
                                    </div>
                                    <div class="col-6 fv-row mb-7">
                                        <label class="fs-6 fw-bold form-label mb-2">
                                            <span class="">* [qty]</span>
                                        </label>
                                        <input wire:model.defer="shippingZonesClassArray.{{ $shippingClass->id }}.multiply_quantity" type="number" class="form-control form-control-solid @error('shippingZonesClassArray.{{ $shippingClass->id }}.multiply_quantity') invalid-feedback @enderror" value="" id="flexSwitchDefault-{{ $shippingZone->id }}-{{ $shippingClass->id }}"/>
                                        <span class="badge-secondary">Si rellenas este campo será usado para multiplicar el precio de envio por cada "n" productos.</span>
                                        @error('shippingZonesClassArray.{{ $shippingClass->id }}.multiply_quantity') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
                                    </div>
                                </div>
                            @endforeach
                        @endif
                        <!--begin::Actions-->
                        <div class="text-left pt-15">
                            <button wire:loading.attr="disabled" wire:target="{{ $method }}" type="submit" class="btn btn-primary">
                                <span class="indicator-label">{{ __('Save changes') }}</span>
                                <span wire:loading wire:target="{{ $method }}" class="spinner-border spinner-border-sm align-middle ms-2"></span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @push('footer')
        <script>
            // $('.shippingZonestatesArray').select2().on('change', function (e) {
            //     var data = $(this).select2("val");
            //     @this.set('shippingZoneStatesArray', data);
            // });
            $('.countryId').select2().on('change', function (e) {
                var data = $(this).select2("val");
                @this.set('countryId', data);
            });
            Livewire.on('renderJs', function(){
                // $('.shippingZonestatesArray').select2();
                $('.countryId').select2();
            });
        </script>
    @endpush
</div>
