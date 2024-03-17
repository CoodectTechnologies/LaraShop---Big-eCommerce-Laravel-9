<div>
    @include('admin.components.errors')
    <!--begin::Form-->
    <form class="form" wire:submit.prevent="{{ $method }}">
        <div wire:ignore.self class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_role_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_role_header" data-kt-scroll-wrappers="#kt_modal_add_role_scroll" data-kt-scroll-offset="300px">
            <div class="fv-row mb-7">
                <label class="fs-6 fw-bolder form-label mb-2">
                    <span class="required">Nombre de rol</span>
                </label>
                <input wire:model.defer="role.name" class="form-control form-control-solid @error('role.name') invalid-feedback @enderror" placeholder="Ejem: Marketing" />
                @error('role.name') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
            </div>
            <div class="fv-row">
                <label class="fs-5 fw-bolder form-label mb-2">Role Permissions</label>
                <div class="table-responsive">
                    <!--begin::Table-->
                    <table class="table align-middle table-row-dashed fs-6 gy-5">
                        <!--begin::Table body-->
                        <tbody class="text-gray-600 fw-bold">
                            @foreach ($permissions as $permission)
                                <!--begin::Table row-->
                                <tr>
                                    <!--begin::Label-->
                                    <td class="text-gray-800">{{ $permission->name }}</td>
                                    <!--end::Label-->
                                    <!--begin::Options-->
                                    <td>
                                        <!--begin::Wrapper-->
                                        <div class="d-flex">
                                            <!--begin::Checkbox-->
                                            <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                <input wire:model.defer="permissionsArray" class="form-check-input" type="checkbox" value="{{ $permission->name }}" />
                                                <span class="form-check-label">Seleccionar</span>
                                            </label>
                                            <!--end::Checkbox-->
                                        </div>
                                        <!--end::Wrapper-->
                                    </td>
                                    <!--end::Options-->
                                </tr>
                                <!--end::Table row-->
                            @endforeach

                        </tbody>
                        <!--end::Table body-->
                    </table>
                    <!--end::Table-->
                </div>
                <!--end::Table wrapper-->
            </div>
            <!--end::Permissions-->
        </div>
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
