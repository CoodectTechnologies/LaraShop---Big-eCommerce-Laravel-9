<div>
    @include('admin.components.errors')
    <!--begin::Form-->
    <form class="form" wire:submit.prevent="{{ $method }}">
        <!--begin::Input group-->
        <div class="fv-row mb-7">
            <label class="fs-6 fw-bold form-label mb-2">
                <span class="required">{{ __('Module') }}</span>
            </label>
            <select wire:model.defer="gallery.module_web_id" class="form-select form-select-solid @error('gallery.module_web_id') invalid-feedback @enderror">
                <option value="">{{ __('Select a option') }}</option>
                @foreach ($modulesWeb as $moduleWeb)
                    <option value="{{ $moduleWeb->id }}">{{ $moduleWeb->name }}</option>
                @endforeach
            </select>
            @error('gallery.module_web_id') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
        </div>
        <!--end::Input group-->
        <div class="mb-7">
            <!--begin::Input group-->
            <div class="form-group row">
                <!--begin::Label-->
                <label class="col-lg-2 col-form-label text-lg-right required">{{ __('Images') }} </label>
                <!--end::Label-->
                <!--begin::Col-->
                <div class="col-lg-10">
                    <!--begin::File-->
                    <div class="dropzone dropzone-queue mb-2">
                        <!--begin::Controls-->
                        <div class="dropzone-panel mb-lg-0 mb-2">
                            <a wire:loading.attr="disabled" wire:target="imagesTmp" class="dropzone-select btn btn-sm btn-primary me-2">
                                <label for="imagesTmp-{{ $gallery->id }}">
                                    {{ __('Choose images') }}
                                    <span wire:loading.attr="disabled" wire:loading.class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                </label>
                            </a>
                            <input wire:model="imagesTmp" type="file" class="d-none" id="imagesTmp-{{ $gallery->id }}" multiple id="imagesTmp-{{ $imagesTmpInputId }}">
                        </div>
                        <!--end::Controls-->
                    </div>
                    <!--end::File-->
                    <!--begin::Hint-->
                    <span class="form-text text-muted">{{ __('Try to upload no more than 10 images at a time.') }}</span>
                    <!--end::Hint-->
                </div>
                <!--end::Col-->
                @error('imagesTmp') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
            </div>
            <!--end::Input group-->
        </div>
        <!--begin::Input group-->
        <div class="mb-7 row">
            @foreach ($imagesTmp as $key => $imageTmp)
                <div class="col-lg-6 col-12">
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
            @foreach ($galleryImages as $image)
                <div class="col-lg-6 col-12">
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
            <button wire:loading.attr="disabled" wire:target="{{ $method }}, imagesTmp" type="submit" class="btn btn-primary">
                <span class="indicator-label">{{ __('Save changes') }}</span>
                <span wire:loading wire:target="{{ $method }}" class="spinner-border spinner-border-sm align-middle ms-2"></span>
            </button>
        </div>
        <!--end::Actions-->
    </form>
    <!--end::Form-->
</div>
