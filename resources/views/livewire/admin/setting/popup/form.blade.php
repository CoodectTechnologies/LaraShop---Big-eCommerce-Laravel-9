<div>
    @include('admin.components.errors')
    <!--begin::Form-->
    <form class="form" wire:submit.prevent="{{ $method }}">
        <div class="card card-flush py-4">
            <div class="card-header">
                <div class="card-title">
                    <h2 class="required">{{ __('Image') }}</h2>
                </div>
            </div>
            <div class="card-body text-center pt-0">
                <div
                    x-data="{ isUploading: false, progress: 0 }"
                    x-on:livewire-upload-start="isUploading = true"
                    x-on:livewire-upload-finish="isUploading = false"
                    x-on:livewire-upload-error="isUploading = false"
                    x-on:livewire-upload-progress="progress = $event.detail.progress">
                    <!--begin::Label-->
                    <label class="fs-6 fw-bold mb-2">
                        <span class="">{{ __('Image') }}</span>
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
                                    style="background-image: url('{{ $popup->imagePreview() }}')"
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
                            @if ($imageTmp || $popup->image)
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
            </div>
        </div>
        <!--begin::Input group-->
        <div class="fv-row mb-7">
            <label class="fs-6 fw-bold form-label mb-2">
                <span class="">{{ __('Active?') }}</span>
            </label>
            <div class="form-check form-switch form-check-custom form-check-solid">
                <input wire:model.defer="popup.active" class="form-check-input @error('popup.active') invalid-feedback @enderror" type="checkbox" value="" id="flexSwitchDefault"/>
                <label class="form-check-label" for="flexSwitchDefault">

                </label>
            </div>
             @error('popup.active') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
        </div>
        <!--end::Input group-->
        <!--begin::Input group-->
        <div class="fv-row mb-7">
            <label class="fs-6 fw-bold form-label mb-2">
                <span class="required">{{ __('Title') }}</span>
            </label>
            <input wire:model.defer="popup.title" required class="form-control form-control-solid @error('popup.title') invalid-feedback @enderror" placeholder="" name="" />
            @error('popup.title') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
        </div>
        <!--end::Input group-->
        <!--begin::Input group-->
        <div class="fv-row mb-7">
            <label class="fs-6 fw-bold form-label mb-2">
                <span class="">Color del titulo</span>
            </label>
            <input wire:model.defer="popup.title_color" type="color" class="form-control form-control-solid @error('popup.title_color') invalid-feedback @enderror" placeholder="" name="" />
            @error('popup.title_color') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
        </div>
        <!--end::Input group-->
        <!--begin::Input group-->
        <div class="fv-row mb-7">
            <label class="fs-6 fw-bold form-label mb-2">
                <span class="">{{ __('Subtitle') }}</span>
            </label>
            <input wire:model.defer="popup.subtitle" class="form-control form-control-solid @error('popup.subtitle') invalid-feedback @enderror" placeholder="" name="" />
            @error('popup.subtitle') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
        </div>
        <!--end::Input group-->
        <!--begin::Input group-->
        <div class="fv-row mb-7">
            <label class="fs-6 fw-bold form-label mb-2">
                <span class="">Color del subtitulo</span>
            </label>
            <input wire:model.defer="popup.subtitle_color" type="color" class="form-control form-control-solid @error('popup.subtitle_color') invalid-feedback @enderror" placeholder="" name="" />
            @error('popup.subtitle_color') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
        </div>
        <!--end::Input group-->
        <!--begin::Input group-->
        <div class="fv-row mb-7">
            <label class="fs-6 fw-bold form-label mb-2">
                <span class="">{{ __('Description') }}</span>
            </label>
            <input wire:model.defer="popup.description" class="form-control form-control-solid @error('popup.description') invalid-feedback @enderror" placeholder="" name="" />
            @error('popup.description') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
        </div>
        <!--end::Input group-->
        <!--end::Input group-->
        <!--begin::Input group-->
        <div class="fv-row mb-7">
            <label class="fs-6 fw-bold form-label mb-2">
                <span class="">{{ __('Description color') }}</span>
            </label>
            <input wire:model.defer="popup.description_color" type="color" class="form-control form-control-solid @error('popup.description_color') invalid-feedback @enderror" placeholder="" name="" />
            @error('popup.description_color') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
        </div>
        <!--end::Input group-->
        <!--begin::Input group-->
        <div class="fv-row mb-7">
            <label class="fs-6 fw-bold form-label mb-2">
                <span class="">{{ __('Text color') }}</span>
            </label>
            <input wire:model.defer="popup.btn_text" class="form-control form-control-solid @error('popup.btn_text') invalid-feedback @enderror" placeholder="" name="" />
            @error('popup.btn_text') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
        </div>
        <!--end::Input group-->
        <!--begin::Input group-->
        <div class="fv-row mb-7">
            <label class="fs-6 fw-bold form-label mb-2">
                <span class="">{{ __('URL color') }}</span>
            </label>
            <input wire:model.defer="popup.btn_url" class="form-control form-control-solid @error('popup.btn_url') invalid-feedback @enderror" placeholder="" name="" />
            @error('popup.btn_url') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
        </div>
        <!--end::Input group-->
        <!--begin::Input group-->
        <div class="fv-row mb-7">
            <label class="fs-6 fw-bold form-label mb-2">
                <span class="">{{ __('Remove button and add newsletter') }}</span>
            </label>
            <div class="form-check form-switch form-check-custom form-check-solid">
                <input wire:model.defer="popup.newsletter" class="form-check-input @error('popup.newsletter') invalid-feedback @enderror" type="checkbox" value="" id="flexSwitchDefault"/>
                <label class="form-check-label" for="flexSwitchDefault">

                </label>
            </div>
                @error('popup.newsletter') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
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
