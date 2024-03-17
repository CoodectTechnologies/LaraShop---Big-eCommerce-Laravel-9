<div>
    <div>
        @include('admin.components.errors')
        <!--begin::Form-->
        <form class="form" wire:submit.prevent="{{ $method }}">
            <!--begin::Input group-->
            <div class="fv-row mb-7">
                <label class="fs-6 fw-bold form-label mb-2">
                    <span class="required">{{ __('Name') }}</span>
                </label>
                <input type="text" required wire:model.defer="color.name.{{ translatable() }}" class="form-control form-control-solid @error('color.name.{{ translatable() }}') invalid-feedback @enderror" placeholder="Ejem: Rojo" name="" />
                @error('color.name.{{ translatable() }}') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="fv-row mb-7">
                <label class="fs-6 fw-bold form-label mb-2">
                    <span class="required">{{ __('Color') }}</span>
                </label>
                <input type="color" required wire:model.defer="color.hexadecimal" class="form-control form-control-solid @error('color.hexadecimal') invalid-feedback @enderror" placeholder="" name="" />
                @error('color.hexadecimal') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="fv-row mb-7">
                <label class="fs-6 fw-bold form-label mb-2">
                    <span class="required">{{ __('Quantity') }}</span>
                </label>
                <input type="number" required wire:model.defer="color.quantity" class="form-control form-control-solid @error('color.quantity') invalid-feedback @enderror" placeholder="Ejem: 1" name="" />
                @error('color.quantity') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="fv-row mb-7">
                <!--begin::Input group-->
                <div class="form-group row">
                    <!--begin::Label-->
                    <label class="col-lg-2 col-form-label text-lg-right">{{ __('Images') }}</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-10">
                        <!--begin::File-->
                        <div class="dropzone dropzone-queue mb-2">
                            <!--begin::Controls-->
                            <div class="dropzone-panel mb-lg-0 mb-2">
                                <label class="dropzone-select btn btn-sm btn-primary me-2" for="imagesTmp-{{ $imagesTmpInputId }}">
                                    {{ __('Choose images') }}
                                    <span wire:loading.attr="disabled" wire:loading.class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                </label>
                                <input wire:model="imagesTmp" type="file" class="d-none" multiple id="imagesTmp-{{ $imagesTmpInputId }}">
                            </div>
                            <!--end::Controls-->
                        </div>
                        <!--end::File-->
                        <!--begin::Hint-->
                        <span class="form-text text-muted">{{ __('Try to upload no more than 10 images.') }}<</span>
                        <!--end::Hint-->
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->
            </div>
            <!--begin::Input group-->
            <div class="row mb-7">
                @foreach ($imagesTmp as $key => $imageTmp)
                    <div class="col-lg-4 col-sm-4 col-12">
                        <!--begin::Image input wrapper-->
                        <div class="mt-1">
                            <!--begin::Image input-->
                            <div class="image-input image-input-outline">
                                <!--begin::Preview existing avatar-->
                                <div
                                    class="image-input-wrapper w-200px h-125px"
                                    style="background-image: url('{{ $imageTmp->temporaryUrl() }}')"
                                ></div>
                                <!--end::Preview existing avatar-->
                                <!--begin::Remove-->
                                <span wire:click.prevent="removeImageTemp('{{ $key }}')" class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="">
                                    <i wire:loading.remove wire:target="removeImageTemp('{{ $key }}')" class="bi bi-x fs-2"></i>
                                    <div wire:loading wire:target="removeImageTemp('{{ $key }}')" class="spinner-border text-primary" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                </span>
                                <!--end::Remove-->
                            </div>
                            <!--end::Image input-->
                        </div>
                    </div>
                @endforeach
                @foreach ($productImages as $image)
                    <div class="col-lg-4 col-sm-4 col-12">
                        <!--begin::Image input wrapper-->
                        <div class="mt-1">
                            <!--begin::Image input-->
                            <div class="image-input image-input-outline">
                                <!--begin::Preview existing avatar-->
                                <div
                                    class="image-input-wrapper w-200px h-125px"
                                    style="background-image: url('{{ $image->imagePreview() }}')"
                                ></div>
                                <!--end::Preview existing avatar-->
                                <!--begin::Remove-->
                                <span wire:click.prevent="removeImage('{{ $image->id }}')" class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="">
                                    <i wire:loading.remove wire:target="removeImage('{{ $image->id }}')" class="bi bi-x fs-2"></i>
                                    <div wire:loading wire:target="removeImage('{{ $image->id }}')" class="spinner-border text-primary" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                </span>
                                <!--end::Remove-->
                            </div>
                            <!--end::Image input-->
                        </div>
                    </div>
                @endforeach
            </div>
            <!--end::Input group-->
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
        <!--end::Form-->
    </div>
</div>
