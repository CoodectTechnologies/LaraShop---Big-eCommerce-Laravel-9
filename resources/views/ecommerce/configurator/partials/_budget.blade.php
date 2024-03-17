<!-- Modal -->
<div wire:ignore.self class="modal fade" id="modalBudget" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered " role="document">
        <div class="modal-content border-radius pb-5">
            <div class="modal-header text-center">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @include('ecommerce.components.alert')
            <div class="">
                <h3 class="text-center mb-0">{{ __('Mount your pc') }}</h3>
                <p class="text-center lead mb-0">{{ __('Select your chipset and budget') }}</p>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card background-4 border-radius">
                                <div class="">
                                    <h4 class="text-center pt-3">{{ __('Performance') }}</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        @foreach ($games as $game)
                                            <div class="col-6">
                                                <div class="p-3 bg-white border-radius m-1">
                                                    <img width="157" src="{{ $game->imagePreview() }}" alt="{{ $game->name }}">
                                                </div>
                                                @if ($fps = $this->getFPS($game->id))
                                                    <p class="text-center mb-0 text-white">
                                                        <span class="text-secondary">{{ $fps }}</span>
                                                        {{ __('FPS') }}
                                                    </p>
                                                @else
                                                    <p class="text-center mb-0 text-white">
                                                        <span class="text-info">N/A</span>
                                                    </p>
                                                @endif
                                            </div>
                                        @endforeach
                                        <p class="text-secondary text-center m-0">{{ __('Expected performance') }}</p>
                                    </div>
                                    <div class="background-5 border-radius d-flex justify-content-center">
                                        <div class="row justify-content-center">
                                            @foreach ($performances as $performance)
                                                <div class="col col-lg-4 text-center">
                                                    <button
                                                        wire:click="buildPerformance({{ $performance->id }})"
                                                        wire:target="buildPerformance({{ $performance->id }})"
                                                        wire:loading.class="load-more-overlay loading"
                                                        wire:loading.disabled
                                                        class="{{ $performance->id == $buildPerformance->id ? 'btn-active' : ''}} btn btn-secondary btn-outline border-0 border-radius light btn-sm">
                                                        {{ $performance->name }}
                                                    </button>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row justify-content-center">
                                <h4 class="text-center mt-3">{{ __('CHIPSET') }}</h4>
                                <div class="background-5 border-radius d-flex justify-content-center">
                                    <div class="row justify-content-center">
                                        @foreach ($chipsets as $chipset)
                                            <div class="col col-lg-6 text-center">
                                                <button
                                                    wire:click="buildChipset({{ $chipset->id }})"
                                                    wire:target="buildChipset({{ $chipset->id }})"
                                                    wire:loading.class="load-more-overlay loading"
                                                    wire:loading.disabled
                                                    class="{{ $chipset->id == $buildChipset->id ? 'btn-active' : ''}} btn btn-secondary btn-outline border-0 border-radius light btn-sm">
                                                    {{ $chipset->name }}
                                                </button>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <h4 class="text-center mt-5">{{ __('Budget') }}</h4>
                                <div class="header-search hs-expanded hs-round d-md-flex input-wrapper">
                                    <button
                                        {{ !$buildBudgetBefore->exists ? 'disabled' : '' }}
                                        wire:click="buildBudget({{ $buildBudgetBefore->id }})"
                                        wire:target="buildBudget({{ $buildBudgetBefore->id }})"
                                        wire:loading.disabled
                                        class="btn btn-search btn-secondary btn-sm"
                                        type="button">
                                            <i class="w-icon-long-arrow-left"></i>
                                    </button>
                                    <input value="{{ $buildBudget->amountToString() }}" type="text" readonly class="form-control text-center" style="font-size: 2rem"/>
                                    <button
                                        {{ !$buildBudgetAfter->exists ? 'disabled' : '' }}
                                        wire:click="buildBudget({{ $buildBudgetAfter->id }})"
                                        wire:target="buildBudget({{ $buildBudgetAfter->id }})"
                                        wire:loading.disabled
                                        class="btn btn-search btn-secondary btn-sm"
                                        type="button">
                                            <i class="w-icon-long-arrow-right"></i>
                                    </button>
                                </div>
                                <div class="mt-5">
                                    <button
                                        wire:click="buildProductsByBudget"
                                        wire:target="buildProductsByBudget"
                                        wire:loading.class="load-more-overlay loading"
                                        wire:loading.disabled
                                        class="btn btn-secondary btn-block border-radius">
                                        {{ __('Continue') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
