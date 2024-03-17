<div>
    @include('admin.components.errors')
    <!--begin::Form-->
    <form class="form" wire:submit.prevent="{{ $method }}">
        <div class="card card-flush py-4">
            <div class="card-header">
                <div class="card-title">
                    <h2 class="required">Logo</h2>
                </div>
            </div>
            <div class="card-body text-center pt-0">
                <div
                    x-data="{ isUploading: false, progress: 0 }"
                    x-on:livewire-upload-start="isUploading = true"
                    x-on:livewire-upload-finish="isUploading = false"
                    x-on:livewire-upload-error="isUploading = false"
                    x-on:livewire-upload-progress="progress = $event.detail.progress">
                    <div class="mt-1">
                        <div class="image-input image-input-outline">
                            <div
                                class="image-input-wrapper w-200px h-125px"
                                @if ($logoTmp)
                                    style="background-image: url('{{ $logoTmp->temporaryUrl() }}')"
                                @else
                                    style="background-image: url('{{ $this->logoPreview() }}')"
                                @endif
                            ></div>
                            <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow image-input" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="{{ __('Change image') }}">
                                <i class="bi bi-pencil-fill fs-7"></i>
                                <input wire:model.defer="logoTmp" class="d-none" type="file" name="" accept=".png, .jpg, .jpeg, .gif, .webp" />
                            </label>
                        </div>
                    </div>
                    @error('logoTmp') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
                    <div x-show="isUploading" class="progress h-6px w-100">
                        <div class="progress-bar bg-primary" role="progressbar" :style="`width: ${progress}%;`" :aria-valuenow="`${progress}`" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
                <div class="text-muted fs-7">Establezca el logotipo sin fondo. Solo se aceptan archivos de imagen *.png, *.jpg, *.jpeg, *gif</div>
            </div>
        </div>
        <div class="card card-flush py-4">
            <div class="card-header">
                <div class="card-title">
                    <h2 class="required">Marca de agua</h2>
                </div>
            </div>
            <div class="card-body text-center pt-0">
                <div
                    x-data="{ isUploading: false, progress: 0 }"
                    x-on:livewire-upload-start="isUploading = true"
                    x-on:livewire-upload-finish="isUploading = false"
                    x-on:livewire-upload-error="isUploading = false"
                    x-on:livewire-upload-progress="progress = $event.detail.progress">
                    <div class="mt-1">
                        <div class="image-input image-input-outline">
                            <div
                                class="image-input-wrapper w-200px h-125px"
                                @if ($watermarkTmp)
                                    style="background-image: url('{{ $watermarkTmp->temporaryUrl() }}')"
                                @else
                                    style="background-image: url('{{ $this->watermarkPreview() }}')"
                                @endif
                            ></div>
                            <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow image-input" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="{{ __('Change image') }}">
                                <i class="bi bi-pencil-fill fs-7"></i>
                                <input wire:model.defer="watermarkTmp" class="d-none" type="file" name="" accept=".png, .jpg, .jpeg, .gif, .webp" />
                            </label>
                        </div>
                    </div>
                    @error('watermarkTmp') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
                    <div x-show="isUploading" class="progress h-6px w-100">
                        <div class="progress-bar bg-primary" role="progressbar" :style="`width: ${progress}%;`" :aria-valuenow="`${progress}`" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
                <div class="text-muted fs-7">Establezca la marca de agua sin fondo. Solo se aceptan archivos de imagen *.png, *.jpg, *.jpeg, *gif</div>
            </div>
        </div>
        <div class="card card-flush py-4">
            <div class="card-header">
                <div class="card-title">
                    <h2 class="required">Firma</h2>
                </div>
            </div>
            <div class="card-body text-center pt-0">
                <div
                    x-data="{ isUploading: false, progress: 0 }"
                    x-on:livewire-upload-start="isUploading = true"
                    x-on:livewire-upload-finish="isUploading = false"
                    x-on:livewire-upload-error="isUploading = false"
                    x-on:livewire-upload-progress="progress = $event.detail.progress">
                    <div class="mt-1">
                        <div class="image-input image-input-outline">
                            <div
                                class="image-input-wrapper w-200px h-125px"
                                @if ($signatureTmp)
                                    style="background-image: url('{{ $signatureTmp->temporaryUrl() }}')"
                                @else
                                    style="background-image: url('{{ $this->signaturePreview() }}')"
                                @endif
                            ></div>
                            <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow image-input" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="{{ __('Change image') }}">
                                <i class="bi bi-pencil-fill fs-7"></i>
                                <input wire:model.defer="signatureTmp" class="d-none" type="file" name="" accept=".png, .jpg, .jpeg, .gif, .webp" />
                            </label>
                        </div>
                    </div>
                    @error('signatureTmp') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
                    <div x-show="isUploading" class="progress h-6px w-100">
                        <div class="progress-bar bg-primary" role="progressbar" :style="`width: ${progress}%;`" :aria-valuenow="`${progress}`" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
                <div class="text-muted fs-7">Establezca la firma sin fondo. Solo se aceptan archivos de imagen *.png, *.jpg, *.jpeg, *gif</div>
            </div>
        </div>
        <!--begin::Input group-->
        <div class="fv-row mb-7">
            <label class="fs-6 fw-bold form-label mb-2">
                <span class="">Nombre de la persona que ingresa la firma</span>
            </label>
            <input wire:model.defer="signatureName" class="form-control form-control-solid @error('signatureName') invalid-feedback @enderror" placeholder="" name="" />
            @error('signatureName') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
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
