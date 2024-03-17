<div>
    @include('admin.components.errors')
    <!--begin::Form-->
    <form class="form" wire:submit.prevent="{{ $method }}">
        <div class="card shadow p-3 mb-5 bg-body rounded">
            <div class="card-header">
                <img width="200" src="{{ asset('assets/admin/media/google/logo.png') }}" alt="Google">
            </div>
            <div class="card-body">
                <div class="fv-row mb-7">
                    <label class="fs-6 fw-bold form-label mb-2">
                        <span class="required">{{ __('Status') }}</span>
                    </label>
                    <select wire:model.defer="googleStatus" class="form-control form-control-solid @error('googleStatus') invalid-feedback @enderror">
                        <option value="">{{ __('Select a option') }}</option>
                        <option value="true">{{ __('Active') }}</option>
                        <option value="false">{{ __('Off') }}</option>
                    </select>
                    @error('googleStatus') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
                </div>
                <!--begin::Input group-->
                <div class="fv-row mb-7">
                    <label class="fs-6 fw-bold form-label mb-2">
                        <span class="">Google - CLIENT ID</span>
                    </label>
                    <input wire:model.defer="googleClientId" class="form-control form-control-solid @error('googleClientId') invalid-feedback @enderror" placeholder="Ejem: 855x663c7b04e76de53f119g2cd84474-us30" name="" />
                    @error('googleClientId') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
                </div>
                <!--begin::Input group-->
                <div class="fv-row mb-7">
                    <label class="fs-6 fw-bold form-label mb-2">
                        <span class="">Google - CLIENT SECRET</span>
                    </label>
                    <input wire:model.defer="googleClientSecret" class="form-control form-control-solid @error('googleClientSecret') invalid-feedback @enderror" placeholder="Ejem: 5eff199cc4" name="" />
                    @error('googleClientSecret') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
                </div>
                <span>
                    <a target="blank" href="https://medium.com/automationmaster/getting-google-oauth-access-token-using-google-apis-18b2ba11a11a">Click aqui para averiguar el como obtener sus accesos.</a>
                </span>
                <p>Google redirect url: <span class="badge badge-primary">{{ env('GOOGLE_REDIRECT_URL') }}</span></p>
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
