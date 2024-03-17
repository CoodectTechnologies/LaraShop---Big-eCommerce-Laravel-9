 <!--begin::Thumbnail settings-->
 <div class="card card-flush py-4">
    <!--begin::Card header-->
    <div class="card-header">
        <!--begin::Card title-->
        <div class="card-title">
            <h2>{{ __('Data sheet') }}</h2>
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
            <!--begin::Image input wrapper-->
            <div class="mt-1">
                <!--begin::Image input-->
                <div class="image-input image-input-outline">
                    @if ($technicalDatasheetTmp)
                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe class="embed-responsive-item" width="100%" height="400px" allowfullscreen src="{{ $technicalDatasheetTmp->temporaryUrl() }}"></iframe>
                        </div>
                    @elseif ($product->technical_datasheet &&  Storage::exists($product->technical_datasheet))
                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe class="embed-responsive-item" width="100%" height="400px" allowfullscreen src="{{ Storage::url($product->technical_datasheet) }}"></iframe>
                        </div>
                    @else
                        <div class="image-input-wrapper w-125px h-125px" style="background-image: url('{{ asset('assets/admin/media/icons/pdf.png') }}')"></div>
                    @endif
                    <!--end::Preview existing avatar-->
                    <!--begin::Edit-->
                    <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow image-input" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="{{ __('Change data sheet') }}">
                        <i class="bi bi-pencil-fill fs-7"></i>
                        <!--begin::Inputs-->
                        <input wire:model.defer="technicalDatasheetTmp" class="d-none" type="file" name="" accept=".pdf" />
                        <!--end::Inputs-->
                    </label>
                    <!--end::Edit-->
                    @if ($technicalDatasheetTmp || $product->technical_datasheet)
                        <!--begin::Remove-->
                        <span wire:click.prevent="removeTechnicalDatasheet()" class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="">
                            <i class="bi bi-x fs-2"></i>
                        </span>
                        <!--end::Remove-->
                    @endif
                </div>
                <!--end::Image input-->
            </div>
            @error('technicalDatasheetTmp') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
            <!-- Progress Bar -->
            <div x-show="isUploading" class="progress h-6px w-100">
                <div class="progress-bar bg-primary" role="progressbar" :style="`width: ${progress}%;`" :aria-valuenow="`${progress}`" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
        </div>
        <!--begin::Description-->
        <div class="text-muted fs-7">{{ __('Set the digital file. Only .pdf files are accepted') }}</div>
        <!--end::Description-->
    </div>
    <!--end::Card body-->
</div>
<!--end::Thumbnail settings-->
