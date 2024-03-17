<div>
    <div class="card">
        <div class="card-body">
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
                                        style="background-image: url('{{ $category->imagePreview() }}')"
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
                                @if ($imageTmp || $category->image)
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
                        <span class="">{{ __('Parent category') }}</span>
                    </label>
                    <div>
                        <!--begin::Select2-->
                        <select wire:model="category.parent_id" multiple="multiple" class="form-select mb-2 @error('category.parent_id') invalid-feedback @enderror" style="height: 300px;">
                            <option value="0">{{ __('No parent category') }}</option>
                            @foreach ($categories as $categoryFhater)
                                <option {{ $categoryFhater->id == $category->id ? 'disabled' : ''  }} value="{{ $categoryFhater->id }}" style="font-weight: bold;">{{ $categoryFhater->name }}</option>
                                @include('admin.catalog.category.partials.form._category', ['categoryFhater' => $categoryFhater, 'style' => 'padding-left: 15px;'])
                            @endforeach
                        </select>
                    </div>
                    <!--end::Select2-->
                    @error('category.parent_id') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
                    <!--begin::Description-->
                    <div class="text-muted fs-7 mb-7">{{ __('You can select the parent category if required.') }}</div>
                    <!--end::Description-->
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="fv-row mb-7">
                    <label class="fs-6 fw-bold form-label mb-2">
                        <span class="required">{{ __('Name') }}</span>
                    </label>
                    <input type="text" required wire:model.defer="category.name.{{ translatable() }}" class="form-control form-control-solid @error('category.name.{{ translatable() }}') invalid-feedback @enderror" placeholder="Ejem: {{ __('Beauty') }}" name="" />
                    @error('category.name.{{ translatable() }}') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="fv-row mb-7">
                    <label class="fs-6 fw-bold form-label mb-2">
                        <span class="">{{ __('Description') }}</span>
                    </label>
                    <textarea wire:model.defer="category.description.{{ translatable() }}" class="form-control form-control-solid @error('category.description.{{ translatable() }}') invalid-feedback @enderror" placeholder="..."></textarea>
                    @error('category.description.{{ translatable() }}') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
                </div>
                <!--end::Input group-->
                <!--begin::Actions-->
                <div class="text-center pt-15">
                    <a href="{{ route('admin.catalog.category.index') }}" class="btn btn-light me-3" ><i class="fa fa-arrow-left"></i></a>
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
</div>
