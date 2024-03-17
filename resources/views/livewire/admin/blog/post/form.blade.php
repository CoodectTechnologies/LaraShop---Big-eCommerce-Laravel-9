<div>
    @push('head')
        <link rel="stylesheet" href="{{ asset('assets/admin/plugins/custom/ckeditor/ckeditor5.css') }}">
    @endpush

    @include('admin.components.errors')
    <form wire:submit.prevent="{{ $method }}" class="form d-flex flex-column flex-lg-row">
        <!--begin::Aside column-->
        <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10">
            <!--begin::Thumbnail settings-->
            <div class="card card-flush py-4">
                <!--begin::Card header-->
                <div class="card-header">
                    <!--begin::Card title-->
                    <div class="card-title">
                        <h2>{{ __('Image') }}</h2>
                    </div>
                    <!--end::Card title-->
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body text-center pt-0">
                    <div
                        x-data="{ isUploading: false, progress: 0 }"
                        x-on:livewire-upload-start="isUploading = true"
                        x-on:livewire-upload-finish="isUploading = false"
                        x-on:livewire-upload-error="isUploading = false"
                        x-on:livewire-upload-progress="progress = $event.detail.progress">
                        <!--begin::Label-->
                        <label class="fs-6 fw-bold mb-2">
                            <span class="required">{{ __('Image') }}</span>
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
                                        style="background-image: url('{{ $post->imagePreview() }}')"
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
                                @if ($imageTmp || $post->image)
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
                    <!--begin::Description-->
                    <div class="text-muted fs-7">{{ __('Set the main image. Only *.png, *.jpg, *.jpeg, *gif image files are accepted') }}</div>
                    <!--end::Description-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Thumbnail settings-->
            <!--begin::Status-->
            <div class="card card-flush py-4">
                <!--begin::Card header-->
                <div class="card-header">
                    <!--begin::Card title-->
                    <div class="card-title">
                        <h2>{{ __('Status') }}</h2>
                    </div>
                    <!--end::Card title-->
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <!--begin::Select2-->
                    <select required wire:model.defer="post.status" class="form-select mb-2">
                        <option value="">{{ __('Select a option') }}</option>
                        <option value="Publicado">{{ __('Published') }}</option>
                        <option value="Borrador">{{ __('Draft') }}</option>
                    </select>
                    <!--end::Select2-->
                    @error('post.status')<small class="form-text text-danger" role="alert">{{ $message }}</small>@enderror
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Status-->
            <!--begin::Category & tags-->
            <div class="card card-flush py-4">
                <!--begin::Card header-->
                <div class="card-header">
                    <!--begin::Card title-->
                    <div class="card-title">
                        <h2>{{ __('Details') }}</h2>
                    </div>
                    <!--end::Card title-->
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body pt-0" wire:ignore>
                    <!--begin::Input group-->
                    <!--begin::Label-->
                    <label class="form-label">{{ __('Categories') }}</label>
                    <!--end::Label-->
                    <!--begin::Select2-->
                    <select wire:model.defer="postCategoryArray" class="postCategoryArray form-select mb-2" data-control="select2" data-placeholder="{{ __('Select a option') }}" data-allow-clear="true" multiple="multiple">
                        <option value="">{{ __('Select a option') }}</option>
                        @foreach ($blogCategories as $blogCategory)
                            <option value="{{ $blogCategory->id }}">{{ $blogCategory->name }}</option>
                        @endforeach
                    </select>
                    <!--end::Select2-->
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <!--begin::Label-->
                    <label class="form-label d-block">{{ __('Tags') }}</label>
                    <!--end::Label-->
                    <!--begin::Select2-->
                    <select wire:model.defer="postTagArray" class="postTagArray form-select mb-2" data-control="select2" data-placeholder="{{ __('Select a option') }}" data-allow-clear="true" multiple="multiple">
                        <option value="">{{ __('Select a option') }}</option>
                        @foreach ($blogTags as $blogTag)
                            <option value="{{ $blogTag->id }}">{{ $blogTag->name }}</option>
                        @endforeach
                    </select>
                    <!--end::Select2-->
                    <!--end::Input group-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Category & tags-->
        </div>
        <!--end::Aside column-->
        <!--begin::Main column-->
        <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
            <!--begin::General options-->
            <div class="card card-flush py-4">
                <!--begin::Card header-->
                <div class="card-header">
                    <div class="card-title">
                        <h2>{{ __('General') }}</h2>
                    </div>
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <!--begin::Input group-->
                    <div class="mb-10 fv-row">
                        <!--begin::Label-->
                        <label class="required form-label">{{ __('Name') }}</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input wire:model.defer="post.name.{{ translatable() }}" required type="text" class="form-control mb-2 @error('post.name.{{ translatable() }}') invalid-feedback @enderror" placeholder="{{ __('Post title') }}"/>
                        <!--end::Input-->
                        @error('post.name.{{ translatable() }}')<small class="form-text text-danger" role="alert">{{ $message }}</small>@enderror
                        <!--begin::Description-->
                        <div class="text-muted fs-7">{{ __('A blog name is required and it is recommended that it be unique.') }}</div>
                        <!--end::Description-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div>
                        <!--begin::Label-->
                        <label class="form-label required">{{ __('Fragment') }}</label>
                        <!--end::Label-->
                        <!--begin::Editor-->
                        <textarea wire:model.defer="post.fragment.{{ translatable() }}" required cols="10" rows="5" class="form-control @error('post.fragment.{{ translatable() }}') invalid-feedback @enderror">{{ $post->fragment }}</textarea>
                        <!--end::Editor-->
                        @error('post.fragment.{{ translatable() }}') <small class="form-text text-danger" role="alert">{{ $message }}</small>@enderror
                        <!--begin::Description-->
                        <div class="text-muted fs-7">{{ __('Attractive little description of the post.') }}</div>
                        <!--end::Description-->
                    </div>
                    <!--end::Input group-->
                </div>
                <!--end::Card header-->
            </div>
            <!--end::General options-->
            <!--begin::General options-->
            <div class="card card-flush py-4">
                <!--begin::Card header-->
                <div class="card-header">
                    <div class="card-title">
                        <h2>{{ __('Content') }}</h2>
                    </div>
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <!--begin::Input group-->
                    <div wire:ignore wire:key="post.body.{{ translatable() }}">
                        <!--begin::Label-->
                        <label class="form-label required">{{ __('Content') }}</label>
                        <!--end::Label-->
                        <!--begin::Editor-->
                        <textarea wire:model.defer="post.body.{{ translatable() }}" required cols="10" rows="5" class="form-control ckeditor5 @error('post.body.{{ translatable() }}') invalid-feedback @enderror">{{ $post->body }}</textarea>
                        <!--end::Editor-->
                    </div>
                    <!--end::Input group-->
                    @error('post.body.{{ translatable() }}') <small class="form-text text-danger" role="alert">{{ $message }}</small>@enderror
                </div>
                <!--end::Card header-->
            </div>
            <!--end::General options-->
            <!--begin::Meta options-->
            <div class="card card-flush py-4">
                <!--begin::Card header-->
                <div class="card-header">
                    <div class="card-title">
                        <h2>{{ __('Meta options') }}</h2>
                    </div>
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <!--begin::Input group-->
                    <div class="mb-10">
                        <!--begin::Label-->
                        <label class="form-label">{{ __('Meta tag title') }}</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input wire:model.defer="post.meta_title.{{ translatable() }}" type="text" class="form-control mb-2 @error('post.meta_title.{{ translatable() }}') invalid-feedback @enderror" placeholder="" />
                        <!--end::Input-->
                        @error('post.meta_title.{{ translatable() }}')<small class="form-text text-danger" role="alert">{{ $message }}</small>@enderror
                        <!--begin::Description-->
                        <div class="text-muted fs-7">{{ __('Set a meta tag title. It is recommended that they be simple and precise keywords.') }}</div>
                        <!--end::Description-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="mb-10">
                        <!--begin::Label-->
                        <label class="form-label">{{ __('Meta tag description') }}</label>
                        <!--end::Label-->
                        <!--begin::Editor-->
                        <textarea wire:model.defer="post.meta_description.{{ translatable() }}" cols="10" rows="5" class="form-control @error('post.meta_description.{{ translatable() }}') invalid-feedback @enderror">{{ $post->meta_description }}</textarea>
                        <!--end::Editor-->
                        @error('post.meta_description.{{ translatable() }}') <small class="form-text text-danger" role="alert">{{ $message }}</small>@enderror
                    </div>
                    <!--end::Input group-->
                     <!--begin::Input group-->
                     <div class="mb-10">
                        <!--begin::Label-->
                        <label class="form-label">{{ __('Meta tag keywords') }}</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input wire:model.defer="post.meta_keywords.{{ translatable() }}" type="text" class="form-control mb-2 @error('post.meta_keywords.{{ translatable() }}') invalid-feedback @enderror"/>
                        <!--end::Input-->
                        @error('post.meta_keywords.{{ translatable() }}')<small class="form-text text-danger" role="alert">{{ $message }}</small>@enderror
                        <!--begin::Description-->
                        <div class="text-muted fs-7">Establezca una lista de palabras clave con las que se relaciona el post. Separe las palabras clave agregando una coma
                            <code>,</code>{{ __('between each key phrase.') }}</div>
                        <!--end::Description-->
                    </div>
                    <!--end::Input group-->
                </div>
                <!--end::Card header-->
            </div>
            <!--end::Meta options-->
            <div class="d-flex justify-content-end">
                <!--begin::Button-->
                <a href="{{ route('admin.blog.post.index') }}" class="btn btn-light me-5">{{ __('Cancel') }}</a>
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

    @push('footer')
        <script src="{{ asset('assets/admin/plugins/custom/ckeditor/ckeditor5.js') }}"></script>
        <script src="{{ asset('assets/admin/plugins/custom/ckeditor/ckeditor5-configuration.js') }}"></script>
        <script>
            $(document).ready(function(){
                ClassicEditor
                .create(document.querySelector(".ckeditor5"), CKEDITOR5_CONFIGURATION)
                .then(editor => {
                    editor.editing.view.document.on('change:isFocused', ( evt, data, isFocused ) => {
                        if(!isFocused){
                            @this.set('post.body.{{ translatable() }}', editor.getData());
                        }
                    })
                });
                $('.postCategoryArray').select2().on('change', function (e) {
                    let data = $(this).select2("val");
                    @this.set('postCategoryArray', data);
                });
                $('.postTagArray').select2().on('change', function (e) {
                    let data = $(this).select2("val");
                    @this.set('postTagArray', data);
                });
            });
        </script>
    @endpush
</div>
