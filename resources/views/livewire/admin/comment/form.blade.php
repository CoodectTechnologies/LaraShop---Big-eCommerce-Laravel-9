<div>
    <!--begin::Body-->
    {{-- <div class="card-body pb-0"> --}}
     <!--begin::Header-->
        <div class="d-flex align-items-center">
            <!--begin::User-->
            <div class="d-flex align-items-center flex-grow-1">
                <!--begin::Avatar-->
                <div class="symbol symbol-45px me-5">
                    <img src="{{ $userPresent->imagePreview() }}" alt="{{ $userPresent->name }}" />
                </div>
                <!--end::Avatar-->
                <!--begin::Info-->
                <div class="d-flex flex-column">
                    <a href="{{ route('admin.user.show', $userPresent) }}" class="text-gray-900 text-hover-primary fs-6 fw-bolder">{{ $userPresent->name }}</a>
                    <span class="text-gray-400 fw-bold">{{ $userPresent->email }}</span>
                </div>
                <!--end::Info-->
            </div>
            <!--end::User-->
        </div>
        <!--end::Header-->
        <!--begin::Form-->
        <form class="form pb-3" wire:submit.prevent="{{ $method }}">
            <div class="fv-row mt-7">
                <label class="form-label">Estrellas</label>
                <select wire:model.defer="comment.stars" class="comment.stars form-select mb-2" >
                    <option value="">{{ __('Select a option') }}</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
            </div>
            <!--begin::Input group-->
            <div class="fv-row mt-7">
                <label class="form-label">{{ __('Name') }}</label>
                <input  wire:model.defer="comment.name" placeholder="Nombre de la persona" class="@error('comment.name') 'invalid-feedback' @enderror form-control"/>
                @error('comment.name') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="fv-row mt-7">
                <textarea  wire:model.defer="comment.body" class="@error('comment.body') 'invalid-feedback' @enderror form-control" name="" id="" cols="30" rows="5"></textarea>
                @error('comment.body') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
            </div>
            <!--end::Input group-->
            <!--begin::Actions-->
            <div class="text-end pt-10">
                <button wire:loading.attr="disabled" wire:target="{{ $method }}" type="submit" class="btn btn-primary">
                    <span class="indicator-label">Guardar comentario</span>
                    <span wire:loading wire:target="{{ $method }}" class="spinner-border spinner-border-sm align-middle ms-2"></span>
                </button>
            </div>
            <!--end::Actions-->
        </form>
        <!--end::Form-->
    {{-- </div> --}}
    <!--end::Body-->
 </div>
