<div>
    <div>
        @include('admin.components.errors')
        <!--begin::Form-->
        <form class="form" wire:submit.prevent="update">
            <!--begin::Input group-->
            <div class="fv-row mb-7">
                <!--end::Label-->
                @foreach ($permissions as $permission)
                    <!--begin::Input row-->
                    <div class="d-flex">
                        <!--begin::Radio-->
                        <div class="form-check form-check-custom form-check-solid">
                            <!--begin::Input-->
                            <input wire:model.defer="userPermissionsDirectArray" class="form-check-input me-3" name="" type="checkbox" value="{{ $permission->name }}" id="kt_modal_update_permission_direct_option_{{ $user->id }}_{{ $permission->id }}"/>
                            <!--end::Input-->
                            <!--begin::Label-->
                            <label class="form-check-label" for="kt_modal_update_permission_direct_option_{{ $user->id }}_{{ $permission->id }}">
                                <div class="fw-bolder text-gray-800">{{ $permission->name }}</div>
                            </label>
                            <!--end::Label-->
                        </div>
                        <!--end::Radio-->
                    </div>
                    <!--end::Input row-->
                    @error('userPermissionsDirectArray') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
                    <div class='separator separator-dashed my-5'></div>
                @endforeach
            </div>
            <!--end::Input group-->
            <!--begin::Actions-->
            <div class="text-center pt-15">
                <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal"><i class="fa fa-arrow-left"></i></button>
                <button wire:loading.attr="disabled" wire:target="update" type="submit" class="btn btn-primary">
                    <span class="indicator-label">{{ __('Save changes') }}</span>
                    <span wire:loading wire:target="update" class="spinner-border spinner-border-sm align-middle ms-2"></span>
                </button>
            </div>
            <!--end::Actions-->
        </form>
        <!--end::Form-->
    </div>
</div>
