<div>
    <!-- Start of PageContent -->
    <div class="page-content pt-2">
        <div class="container">
            <div class="tab tab-vertical row gutter-lg">

                @include('ecommerce.account.menu.index')

                <div class="tab-content mb-6">
                    <div class="tab-pane active in" id="account-details">
                        <div class="row mb-5">
                            <h4 class="title title-underline ls-25 font-weight-bold">
                                {{ __('Profile') }}
                            </h4>
                        </div>
                        <form wire:submit.prevent="update()" class="form account-details-form">
                            @include('ecommerce.components.alert')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{ __('Full name') }} *</label>
                                        <input wire:model.defer="user.name" name="name" required type="text" class="form-control form-control-md @error('user.name') invalid-feedback @enderror"/>
                                        @error('user.name') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{ __('Email') }} *</label>
                                        <input wire:model.defer="user.email" name="email" required type="text" class="form-control form-control-md @error('user.email') invalid-feedback @enderror"/>
                                        @error('user.email') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
                                    </div>
                                </div>
                            </div>
                            <button
                                wire:target.prevent="update()"
                                wire:loading.class="load-more-overlay loading"
                                wire:loading.disabled
                                type="submit"
                                class="btn btn-dark btn-rounded btn-sm mb-4">
                                {{ __('Save changes') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End of PageContent -->
</div>
