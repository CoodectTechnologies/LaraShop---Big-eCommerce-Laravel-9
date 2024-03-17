<div>
    @include('admin.components.errors')
    <!--begin::Form-->
    <form wire:submit.prevent="{{ $method }}" class="form d-flex flex-column flex-lg-row">
        <!--begin::Aside column-->
        <div class="w-100 flex-lg-row-auto w-lg-300px mb-7 me-7 me-lg-10">
            <!--begin::Order details-->
            <div class="card card-flush py-4">
                <!--begin::Card header-->
                <div class="card-header">
                    <div class="card-title">
                        <h2>{{ __('Details') }}</h2>
                    </div>
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <div class="d-flex flex-column gap-10">
                        <!--begin::Input group-->
                        <div class="fv-row">
                            <!--begin::Label-->
                            <label class="form-label required">{{ __('Amount') }}</label>
                            <!--end::Label-->
                            <input wire:model="configuratorBudget.amount" type="number" required class="form-control mb-2 @error('configuratorBudget.amount') invalid-feedback @enderror">
                            @error('configuratorBudget.amount')<small class="form-text text-danger" role="alert">{{ $message }}</small>@enderror
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row">
                            <!--begin::Label-->
                            <label class="form-label required">{{ __('CHIPSET') }}</label>
                            <!--end::Label-->
                            <select required wire:model.defer="configuratorBudget.configurator_chipset_id" class="form-select mb-2 @error('configuratorBudget.configurator_chipset_id') invalid-feedback @enderror">
                                <option value="">{{ __('Select a option') }}</option>
                                @foreach ($chipsets as $chipset)
                                    <option value="{{ $chipset->id }}">{{ $chipset->name }}</option>
                                @endforeach
                            </select>
                            @error('configuratorBudget.configurator_chipset_id')<small class="form-text text-danger" role="alert">{{ $message }}</small>@enderror
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row">
                            <!--begin::Label-->
                            <label class="form-label required">{{ __('Performances') }}</label>
                            <!--end::Label-->
                            @foreach ($performances as $performance)
                                <div class="form-check form-check-custom form-check-success form-check-solid mb-2">
                                    <input wire:model.defer='performancesArray' id="performance-{{ $performance->id }}" class="form-check-input @error('performancesArray') invalid-feedback @enderror" type="checkbox" name="performancesArray[]" value="{{ $performance->id }}" />
                                    <label class="form-check-label" for="performance-{{ $performance->id }}">
                                        {{ $performance->name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        <!--end::Input group-->
                        @error('performancesArray')<small class="form-text text-danger" role="alert">{{ $message }}</small>@enderror
                    </div>
                </div>
            </div>
        </div>
        <!--end::Aside column-->
        <!--begin::Main column-->
        <div class="d-flex flex-column flex-lg-row-fluid gap-7 gap-lg-10">
            <!--begin::Order details-->
            <div class="card card-flush py-4">
                <!--begin::Card header-->
                <div class="card-header">
                    <div class="card-title">
                        <h2>{{ __('Componentes') }}</h2>
                    </div>
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <div class="d-flex flex-column gap-10">
                        @foreach ($stages as $stage)
                            <div class="fv-row">
                                <label class="form-label {{ !$stage->optional ? 'required' : '' }}">{{ $stage->name }}</label>
                                <select wire:model="productsArray.products.{{ $stage->id }}" class="form-select mb-2 @error('productsArray.products.{{ $stage->id }}') invalid-feedback @enderror">
                                    <option value="">{{ __('Select a option') }}</option>
                                    @foreach ($this->getProducts($stage->id) as $product)
                                        <option value="{{ $product->id }}">{!! $product->getPriceToString() !!} {{ $product->name }}</option>
                                    @endforeach
                                </select>
                                @error('productsArray.products.'.$stage->id)<small class="form-text text-danger" role="alert">{{ $message }}</small>@enderror
                            </div>
                        @endforeach
                    </div>
                    <div class="d-flex flex-column mt-5 text-end">
                        <h3>{{ __('Total') }}: ${{ number_format($total, 2) }}</h3>
                    </div>
                </div>
                <!--end::Card header-->
            </div>
            <!--end::Order details-->
            <!--end::Meta options-->
            <div class="d-flex justify-content-end">
                <!--begin::Button-->
                <a href="{{ route('admin.configurator.budget.index') }}" class="btn btn-light me-5">{{ __('Cancel') }}</a>
                <!--end::Button-->
                <!--begin::Button-->
                <button wire:loading.attr="disabled" wire:target="{{ $method }}" type="submit" class="btn btn-primary">
                    <span class="indicator-label">{{ __('Save changes') }}</span>
                    <span wire:loading wire:target="{{ $method }}" class="spinner-border spinner-border-sm align-middle ms-2"></span>
                </button>
                <!--end::Button-->
            </div>
        </div>
        <!--end::Main column-->
    </form>
    <!--end::Form-->
</div>
