<div class="footer-newsletter pt-1 pb-1">
    <div class="">
        <div class="row justify-content-end align-items-center">
            <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12">
                <div class="icon-box icon-box-side text-white {{ config('configurator.budget_active') ? 'justify-content-between' : 'justify-content-end' }}">
                    @if(config('configurator.budget_active'))
                        <div>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalBudget">
                                {{ __('Open budgets') }}
                            </button>
                        </div>
                    @endif
                    <div class="icon-box-content">
                        <h4 class="icon-box-title text-white text-uppercase mb-0">{{ __('Subtotal') }}</h4>
                        <p class="text-white">
                            ${{ number_format($total, 2) }} {{ currency() }}
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
                <div class="input-wrapper input-wrapper-inline input-wrapper-rounded">
                    <button x-on:click="tabAddon" x-show="tab == 'tab-component'" class="btn btn-block btn-dark btn-rounded" type="button">
                        {{ __('Next') }}
                        <i class="w-icon-long-arrow-right"></i>
                    </button>
                    <button x-on:click="tabSummary" x-show="tab == 'tab-addon'" class="btn btn-block btn-dark btn-rounded" type="button">
                        {{ __('Next') }}
                        <i class="w-icon-long-arrow-right"></i>
                    </button>
                    <button
                        x-show="tab == 'tab-summary'"
                        wire:key="{{ rand() }}"
                        wire:click="addCart"
                        wire:target="addCart"
                        wire:loading.class="load-more-overlay loading"
                        wire:loading.disabled
                        class="btn btn-block btn-dark btn-rounded"
                        type="button">
                        {{ __('Add to cart') }}
                        <i class="w-icon-long-arrow-right"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
