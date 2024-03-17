<div>
    @include('ecommerce.components.alert')
    <form wire:submit.prevent="sendEmail" class="">
        <div class="row">
            <div class="form-group col-lg-6">
                <label for="name">{{ __('Name') }} *</label>
                <input
                  wire:model.defer="emailWeb.name"
                  required
                  type="text"
                  class="form-control required name @error('emailWeb.name') is-invalid @enderror"
                  placeholder="{{ __('Enter the name') }}"
                />
                @error('emailWeb.name')
                  <span class="text-danger" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
            </div>
            <div class="form-group col-lg-6">
                <label for="name">{{ __('Phone') }} (WhatsApp) *</label>
                <input
                  wire:model.defer="emailWeb.phone"
                  required
                  type="text"
                  class="form-control required name @error('emailWeb.phone') is-invalid @enderror"
                  placeholder="{{ __('Enter the phone') }}"
                />
                @error('emailWeb.phone')
                  <span class="text-danger" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
            </div>
            <div class="form-group col-md-6">
                <label for="subject">{{ __('Subject') }} *</label>
                <input
                  wire:model.defer="emailWeb.subject"
                  required
                  type="text"
                  class="form-control required name @error('emailWeb.subject') is-invalid @enderror"
                  placeholder="{{ __('Enter the subject') }}"
                />
                @error('emailWeb.subject')
                <span class="text-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group col-md-6">
                <label>{{ __('Email') }} *</label>
                <input
                wire:model.defer="emailWeb.email"
                required
                type="email"
                class="form-control required email @error('emailWeb.email') is-invalid @enderror"
                placeholder="{{ __('Enter the email') }}"
                />
                @error('emailWeb.email')
                    <span class="text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group">
          <label for="body">{{ __('Message') }} *</label>
          <textarea
            wire:model.defer="emailWeb.body"
            required
            rows="8"
            class="form-control required"
            placeholder="{{ __('Enter the message') }}"
          ></textarea>
          @error('emailWeb.message')
              <span class="text-danger" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
          @enderror
        </div>
        <x-honey recaptcha="contact"/>
        <div class="form-group d-flex justify-content-end">
          <button type="submit" class="btn">{{ __('Send message') }}
              <i wire:loading.remove wire:target="sendEmail" class="icon-send"></i>
              <i wire:loading.class="spinner-grow spinner-grow-sm" wire:target="sendEmail"></i>
          </button>
        </div>
    </form>
</div>
