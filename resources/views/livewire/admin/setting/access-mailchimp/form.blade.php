<div>
    @include('admin.components.errors')
    <!--begin::Form-->
    <form class="form" wire:submit.prevent="{{ $method }}">
        <div class="card shadow p-3 mb-5 bg-body rounded">
            <div class="card-header">
                <img width="200" src="{{ asset('assets/admin/media/mailchimp/logo.png') }}" alt="Mailchimp">
            </div>
            <div class="card-body">
                <div class="fv-row mb-7">
                    <label class="fs-6 fw-bold form-label mb-2">
                        <span class="required">{{ __('Status') }}</span>
                    </label>
                    <select wire:model.defer="mailchimpStatus" class="form-control form-control-solid @error('mailchimpStatus') invalid-feedback @enderror">
                        <option value="">{{ __('Select a option') }}</option>
                        <option value="true">{{ __('Active') }}</option>
                        <option value="false">{{ __('Off') }}</option>
                    </select>
                    @error('mailchimpStatus') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
                </div>
                <!--begin::Input group-->
                <div class="fv-row mb-7">
                    <label class="fs-6 fw-bold form-label mb-2">
                        <span class="">Mailchimp - API KEY</span>
                    </label>
                    <input wire:model.defer="mailchimpApiKey" class="form-control form-control-solid @error('mailchimpApiKey') invalid-feedback @enderror" placeholder="Ejem: 855x663c7b04e76de53f119g2cd84474-us30" name="" />
                    @error('mailchimpApiKey') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
                    <span>
                        <a href="https://us10.admin.mailchimp.com/account/api-key-popup/." target="_blank" rel="noopener noreferrer">Click aqui para averiguar cual es mi API KEY</a>
                    </span>
                </div>
                <!--begin::Input group-->
                <div class="fv-row mb-7">
                    <label class="fs-6 fw-bold form-label mb-2">
                        <span class="">Mailchimp - LIST ID</span>
                    </label>
                    <input wire:model.defer="mailchimpListId" class="form-control form-control-solid @error('mailchimpListId') invalid-feedback @enderror" placeholder="Ejem: 5eff199cc4" name="" />
                    @error('mailchimpListId') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
                    <span class="badge badge-secondary">
                        <a href="http://kb.mailchimp.com/lists/managing-subscribers/find-your-list-id" target="_blank" rel="noopener noreferrer">Click aqui para averiguar cual es mi LIST ID</a>
                    </span>
                </div>
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
