<!--begin::Modal - Add permissions-->
<div wire:ignore.self class="modal fade" id="kt_modal_show_log_{{ $log->id }}" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header">
                <!--begin::Modal title-->
                <h2 class="fw-bolder">{{ $log->description }}</h2>
                <!--end::Modal title-->
                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                    <span class="svg-icon svg-icon-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
                            <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black" />
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                </div>
                <!--end::Close-->
            </div>
            <!--end::Modal header-->
            <!--begin::Modal body-->
            <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                @if ($log->causer)
                    <div class="d-flex align-items-center">
                        <div class="symbol symbol-success mr-2">
                            <img loading="lazy" src="{{ $log->causer->imagePreview() }}"/>
                        </div>
                        <div class="d-flex flex-column text-left ms-5">
                            <span class="text-muted font-weight-bold">{{ $log->causer->name }}</span>
                            <span class="text-dark-75 font-weight-bold">{{ $log->causer->roles->pluck('name') }}</span>
                        </div>
                    </div>
                    <hr>
                @endif
                <pre>{{ json_encode($log->properties, JSON_PRETTY_PRINT) }}</pre>
            </div>
            <!--end::Modal body-->
        </div>
        <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
</div>
<!--end::Modal - Add permissions-->
