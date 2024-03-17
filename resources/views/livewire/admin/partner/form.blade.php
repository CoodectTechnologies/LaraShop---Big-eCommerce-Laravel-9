<div>
    @include('admin.components.errors')
    <!--begin::Form-->
    <form class="form" wire:submit.prevent="{{ $method }}">
        <!--begin::Input group-->
        <div class="mb-7">
            <div
                x-data="{ isUploading: false, progress: 0 }"
                x-on:livewire-upload-start="isUploading = true"
                x-on:livewire-upload-finish="isUploading = false"
                x-on:livewire-upload-error="isUploading = false"
                x-on:livewire-upload-progress="progress = $event.detail.progress">
                <!--begin::Label-->
                <label class="fs-6 fw-bold mb-2">
                    <span class="required">{{ __('Image') }}</span>
                    <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Tipo de archivo permitido: png, jpg, jpeg. gif, .webp"></i>
                </label>
                <!--end::Label-->
                <!--begin::Image input wrapper-->
                <div class="mt-1">
                    <!--begin::Image input-->
                    <div class="image-input image-input-outline">
                        <!--begin::Preview existing avatar-->
                        <div
                            class="image-input-wrapper w-200px h-125px"
                            @if ($imageTmp)
                                style="background-image: url('{{ $imageTmp->temporaryUrl() }}')"
                            @else
                                style="background-image: url('{{ $partner->imagePreview() }}')"
                            @endif
                        ></div>
                        <!--end::Preview existing avatar-->
                        <!--begin::Edit-->
                        <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow image-input" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="{{ __('Change image') }}">
                            <i class="bi bi-pencil-fill fs-7"></i>
                            <!--begin::Inputs-->
                            <input wire:model.defer="imageTmp" class="d-none" type="file" name="" accept=".png, .jpg, .jpeg, .gif, .webp" />
                            <!--end::Inputs-->
                        </label>
                        <!--end::Edit-->
                        @if ($imageTmp || $partner->image)
                        <!--begin::Remove-->
                        <span wire:click.prevent="removeImage()" class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="">
                            <i class="bi bi-x fs-2"></i>
                        </span>
                        <!--end::Remove-->
                        @endif
                    </div>
                    <!--end::Image input-->
                </div>
                @error('imageTmp') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
                <!-- Progress Bar -->
                <div x-show="isUploading" class="progress h-6px w-100">
                    <div class="progress-bar bg-primary" role="progressbar" :style="`width: ${progress}%;`" :aria-valuenow="`${progress}`" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
            <!--end::Image input wrapper-->
        </div>
        <!--end::Input group-->
        <!--begin::Input group-->
        <div class="fv-row mb-7">
            <label class="fs-6 fw-bold form-label mb-2">
                <span class="required">{{ __('Name') }}</span>
            </label>
            <input type="text" required wire:model.defer="partner.name.{{ translatable() }}" class="form-control form-control-solid @error('partner.name.{{ translatable() }}') invalid-feedback @enderror" placeholder="Ejem: {{ __('Name') }}" name="" />
            @error('partner.name.{{ translatable() }}') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
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
