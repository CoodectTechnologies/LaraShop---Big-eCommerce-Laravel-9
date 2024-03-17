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
                            class="image-input-wrapper w-125px h-125px"
                            @if ($imageTmp)
                                style="background-image: url('{{ $imageTmp->temporaryUrl() }}')"
                            @else
                                style="background-image: url('{{ $person->imagePreview() }}')"
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
                        @if ($imageTmp || $person->image)
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
                <span class="required">{{ __('Order') }}</span>
            </label>
            <input required wire:model.defer="person.order" class="form-control form-control-solid @error('person.order') invalid-feedback @enderror" placeholder="Ejem: 1" name="" />
            @error('person.order') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
        </div>
        <!--end::Input group-->
        <!--begin::Input group-->
        <div class="fv-row mb-7">
            <label class="fs-6 fw-bold form-label mb-2">
                <span class="required">{{ __('Name') }}</span>
            </label>
            <input required wire:model.defer="person.name" class="form-control form-control-solid @error('person.name') invalid-feedback @enderror" placeholder="Nombre del personal"/>
            @error('person.name') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
        </div>
        <!--end::Input group-->
        <!--begin::Input group-->
        <div class="fv-row mb-7">
            <label class="fs-6 fw-bold form-label mb-2">
                <span class="">{{ __('Position') }}</span>
            </label>
            <input wire:model.defer="person.position.{{ translatable() }}" class="form-control form-control-solid @error('person.position.{{ translatable() }}') invalid-feedback @enderror" placeholder="Ejem: Marketing" name="" />
            @error('person.position.{{ translatable() }}') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
        </div>
        <!--end::Input group-->
        <!--begin::Input group-->
        <div class="fv-row mb-7">
            <label class="fs-6 fw-bold form-label mb-2">
                <span class="">Facebook</span>
            </label>
            <input wire:model.defer="person.facebook" class="form-control form-control-solid @error('person.facebook') invalid-feedback @enderror" placeholder="" name="" />
            @error('person.facebook') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
        </div>
        <!--end::Input group-->
        <!--begin::Input group-->
        <div class="fv-row mb-7">
            <label class="fs-6 fw-bold form-label mb-2">
                <span class="">Twitter</span>
            </label>
            <input wire:model.defer="person.twitter" class="form-control form-control-solid @error('person.twitter') invalid-feedback @enderror" placeholder="" name="" />
            @error('person.twitter') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
        </div>
        <!--end::Input group-->
        <!--begin::Input group-->
        <div class="fv-row mb-7">
            <label class="fs-6 fw-bold form-label mb-2">
                <span class="">Linkedin</span>
            </label>
            <input wire:model.defer="person.linkedin" class="form-control form-control-solid @error('person.linkedin') invalid-feedback @enderror" placeholder="" name="" />
            @error('person.linkedin') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
        </div>
        <!--end::Input group-->
        <!--begin::Input group-->
        <div class="fv-row mb-7">
            <label class="fs-6 fw-bold form-label mb-2">
                <span class="">Instagram</span>
            </label>
            <input wire:model.defer="person.instagram" class="form-control form-control-solid @error('person.instagram') invalid-feedback @enderror" placeholder="" name="" />
            @error('person.instagram') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
        </div>
        <!--end::Input group-->
        <!--begin::Input group-->
        <div class="fv-row mb-7">
            <label class="fs-6 fw-bold form-label mb-2">
                <span class="">WhatsApp</span>
            </label>
            <input wire:model.defer="person.whatsapp" class="form-control form-control-solid @error('person.whatsapp') invalid-feedback @enderror" placeholder="" name="" />
            @error('person.whatsapp') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
        </div>
        <!--end::Input group-->
        <!--begin::Textarea group-->
        <div class="fv-row mb-7">
            <label class="fs-6 fw-bold form-label mb-2">
                <span class="required">{{ __('Biography') }}</span>
            </label>
            <textarea required wire:model.defer="person.biography.{{ translatable() }}" class="form-control form-control-solid @error('person.biography.{{ translatable() }}') invalid-feedback @enderror" placeholder="Ejem: {{ __('Short description of the person') }}" cols="30" rows="10">{{ $person->biography }}</textarea>
            @error('person.biography.{{ translatable() }}') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
        </div>
        <!--end::Textarea group-->
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
