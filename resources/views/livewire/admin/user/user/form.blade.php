<div>
    @include('admin.components.errors')
    <!--begin::Form-->
    <form class="form" wire:submit.prevent="{{ $method }}">
        <div wire:ignore.self class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_update_user" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_role_header" data-kt-scroll-wrappers="#kt_modal_update_user" data-kt-scroll-offset="300px">
            {{-- General --}}
            <!--begin::Details toggle-->
            <div class="d-flex flex-stack fs-4 py-3">
                <div class="fw-bolder rotate collapsible" data-bs-toggle="collapse" href="#kt_user_form_profile_general" role="button" aria-expanded="false" aria-controls="kt_user_form_profile_general">General
                <span class="ms-2 rotate-180">
                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
                    <span class="svg-icon svg-icon-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="black" />
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                </span></div>
            </div>
            <!--end::Details toggle-->
            <div class="separator"></div>
            <div class="mt-5"></div>
            <!--begin::Details content-->
            <div id="kt_user_form_profile_general" class="collapse show">
                <!--begin::Input group-->
                <div class="mb-7">
                    <div
                        x-data="{ isUploading: false, progress: 0 }"
                        x-on:livewire-upload-start="isUploading = true"
                        x-on:livewire-upload-finish="isUploading = false"
                        x-on:livewire-upload-error="isUploading = false"
                        x-on:livewire-upload-progress="progress = $event.detail.progress"
                    >
                        <!--begin::Label-->
                        <label class="fs-6 fw-bold mb-2">
                            <span>{{ __('Image') }}</span>
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
                                        style="background-image: url('{{ $user->imagePreview() }}')"
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
                                @if ($imageTmp || $user->image)
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
                        <span class="required">{{ __('Name') }}</span>
                    </label>
                    <input required wire:model.defer="user.name" class="form-control form-control-solid @error('user.name') invalid-feedback @enderror" placeholder="Ejem: Nombre completo" name="" />
                    @error('user.name') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="fv-row mb-7">
                    <label class="fs-6 fw-bold form-label mb-2">
                        <span class="required">{{ __('email') }}</span>
                    </label>
                    <input type="email" required wire:model.defer="user.email" class="form-control form-control-solid @error('user.email') invalid-feedback @enderror" placeholder="Ejem: Nombre completo" name="" />
                    @error('user.email') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="fv-row mb-7">
                    <label class="fs-6 fw-bold form-label mb-2">
                        <span class="">{{ __('Title') }}</span>
                    </label>
                    <input type="text" wire:model.defer="profile.title" class="form-control form-control-solid @error('profile.title') invalid-feedback @enderror" placeholder="Ejem: CEO" name="" />
                    @error('profile.title') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="fv-row mb-7">
                    <label class="fs-6 fw-bold form-label mb-2">
                        <span class="">{{ __('Biography') }}</span>
                    </label>
                    <textarea wire:model.defer="profile.biography"  class="form-control form-control-solid @error('profile.biography') invalid-feedback @enderror" placeholder="" cols="30" rows="10"></textarea>
                    @error('profile.biography') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="fv-row mb-7">
                    <label class="fs-6 fw-bold form-label mb-2">
                        <span class="">{{ __('Website') }}</span>
                    </label>
                    <input type="url" wire:model.defer="profile.website" class="form-control form-control-solid @error('profile.website') invalid-feedback @enderror" placeholder="Ejem: https://mipaginaweb.com" name="" />
                    @error('profile.website') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="fv-row mb-7">
                    <label class="fs-6 fw-bold form-label mb-2">
                        <span class="">Facebook</span>
                    </label>
                    <input type="url" wire:model.defer="profile.facebook" class="form-control form-control-solid @error('profile.facebook') invalid-feedback @enderror" placeholder="Ejem: {{ __('Your profile of') }} facebook" name="" />
                    @error('profile.facebook') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="fv-row mb-7">
                    <label class="fs-6 fw-bold form-label mb-2">
                        <span class="">Instagram</span>
                    </label>
                    <input type="url" wire:model.defer="profile.instagram" class="form-control form-control-solid @error('profile.instagram') invalid-feedback @enderror" placeholder="Ejem: {{ __('Your profile of') }} instagram" name="" />
                    @error('profile.instagram') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="fv-row mb-7">
                    <label class="fs-6 fw-bold form-label mb-2">
                        <span class="">Linkedin</span>
                    </label>
                    <input type="url" wire:model.defer="profile.linkedin" class="form-control form-control-solid @error('profile.linkedin') invalid-feedback @enderror" placeholder="Ejem: {{ __('Your profile of') }} linkedin" name="" />
                    @error('profile.linkedin') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="fv-row mb-7">
                    <label class="fs-6 fw-bold form-label mb-2">
                        <span class="">Twitter</span>
                    </label>
                    <input type="url" wire:model.defer="profile.twitter" class="form-control form-control-solid @error('profile.twitter') invalid-feedback @enderror" placeholder="Ejem: {{ __('Your profile of') }} twitter" name="" />
                    @error('profile.twitter') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="fv-row mb-7">
                    <label class="fs-6 fw-bold form-label mb-2">
                        <span class="">YouTube</span>
                    </label>
                    <input type="url" wire:model.defer="profile.youtube" class="form-control form-control-solid @error('profile.youtube') invalid-feedback @enderror" placeholder="Ejem: {{ __('Your profile of') }} YouTube" name="" />
                    @error('profile.youtube') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
                </div>
                <!--end::Input group-->
            </div>

            @can('roles')
            {{-- Roles --}}
            <!--begin::Details toggle-->
            <div class="d-flex flex-stack fs-4 py-3">
                <div class="fw-bolder rotate collapsible" data-bs-toggle="collapse" href="#kt_user_form_profile_roles" role="button" aria-expanded="false" aria-controls="kt_user_form_profile_roles">{{ __('Roles') }}
                <span class="ms-2 rotate-180">
                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
                    <span class="svg-icon svg-icon-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="black" />
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                </span></div>
            </div>
            <!--end::Details toggle-->
            <div class="separator"></div>
            <div class="mt-5"></div>
            <!--begin::Details content-->
            <div id="kt_user_form_profile_roles" class="collapse show">
                <!--begin::Input group-->
                <div class="fv-row mb-7">
                    <!--end::Label-->
                    @foreach ($roles as $role)
                        <!--begin::Input row-->
                        <div class="d-flex">
                            <!--begin::Radio-->
                            <div class="form-check form-check-custom form-check-solid">
                                <!--begin::Input-->
                                <input wire:model.defer="userRolesArray" class="form-check-input me-3" name="" type="checkbox" value="{{ $role->name }}" id="kt_modal_update_role_option_{{ $user->id }}_{{ $role->id }}"/>
                                <!--end::Input-->
                                <!--begin::Label-->
                                <label class="form-check-label" for="kt_modal_update_role_option_{{ $user->id }}_{{ $role->id }}">
                                    <div class="fw-bolder text-gray-800">{{ $role->name }}</div>
                                </label>
                                <!--end::Label-->
                            </div>
                            <!--end::Radio-->
                        </div>
                        <!--end::Input row-->
                        @error('userRolesArray') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
                        <div class='separator separator-dashed my-5'></div>
                    @endforeach
                </div>
                <!--end::Input group-->
            </div>
            @endcan

            {{-- Password --}}
            <!--begin::Details toggle-->
            <div class="d-flex flex-stack fs-4 py-3">
                <div class="fw-bolder rotate collapsible" data-bs-toggle="collapse" href="#kt_user_form_profile_password" role="button" aria-expanded="false" aria-controls="kt_user_form_profile_password">{{ __('Password') }}
                <span class="ms-2 rotate-180">
                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
                    <span class="svg-icon svg-icon-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="black" />
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                </span></div>
            </div>
            <!--end::Details toggle-->
            <div class="separator"></div>
            <div class="mt-5"></div>
            <!--begin::Details content-->
            <div id="kt_user_form_profile_password" class="collapse show">
                <!--begin::Notice-->
                <div class="notice d-flex bg-light-info rounded border-info border border-dashed mb-9 p-6">
                    <!--begin::Icon-->
                    <!--begin::Svg Icon | path: icons/duotune/general/gen044.svg-->
                    <span class="svg-icon svg-icon-2tx svg-icon-info me-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="black" />
                            <rect x="11" y="14" width="7" height="2" rx="1" transform="rotate(-90 11 14)" fill="black" />
                            <rect x="11" y="17" width="2" height="2" rx="1" transform="rotate(-90 11 17)" fill="black" />
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                    <!--end::Icon-->
                    <!--begin::Wrapper-->
                    <div class="d-flex flex-stack flex-grow-1">
                        <!--begin::Content-->
                        <div class="fw-bold">
                            <div class="fs-6 text-gray-700">
                            <strong class="me-1">{{ __('Information') }}!</strong> {{ __('Leaving the fields blank will not modify the password information.') }}</div>
                        </div>
                        <!--end::Content-->
                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--end::Notice-->
                <!--begin::Input group-->
                <div class="fv-row mb-7">
                    <label class="fs-6 fw-bold form-label mb-2">
                        <span class="required">{{ __('Password') }}</span>
                    </label>
                    <input type="password" wire:model.defer="password" class="form-control form-control-solid @error('password') invalid-feedback @enderror" placeholder="{{ __('New password') }}" name="" />
                    @error('password') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="fv-row mb-7">
                    <label class="fs-6 fw-bold form-label mb-2">
                        <span class="required">{{ __('Confirm password') }}</span>
                    </label>
                    <input type="password" wire:model.defer="password_confirmation" class="form-control form-control-solid @error('password_confirmation') invalid-feedback @enderror" placeholder="{{ __('Confirm password') }}" name="" />
                    @error('password_confirmation') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
                </div>
                <!--end::Input group-->
            </div>
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
