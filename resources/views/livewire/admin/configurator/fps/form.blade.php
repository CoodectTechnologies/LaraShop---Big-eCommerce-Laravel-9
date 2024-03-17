<div>
    @include('admin.components.errors')
    <!--begin::Form-->
    <form wire:submit.prevent="{{ $method }}" class="form d-flex flex-column flex-lg-row">
        <!--begin::Main column-->
        <div class="d-flex flex-column flex-lg-row-fluid">
            <!--begin::Order details-->
            <div class="card card-flush py-4">
                <!--begin::Card header-->
                <div class="card-header">
                    <div class="card-title">
                        <h2>{{ __('General data') }}</h2>
                    </div>
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <ul>
                        @foreach($fpsArray['games'] as $gameId => $game)
                            <li>
                                <img width="150" src="{{ $game['imagePreview'] }}" alt="{{ $game['name'] }}">
                            </li>
                            <ul>
                                @foreach($game['performances'] as $performanceId => $performance)
                                    <li>{{ __('Performance') }}: {{ $performance['name'] }}</li>
                                    <ul>
                                        @foreach($performance['budgets'] as $budgetId => $budget)
                                            <li>{{ __('Budget') }}: {{ $budget['amount'] }}</li>
                                            <ul>
                                                @foreach($budget['chipsets'] as $chipsetId => $chipset)
                                                    <li>
                                                        {{ __('Chipset') }}: {{ $chipset['name'] }}
                                                        <input wire:model.defer="fps.games.{{ $gameId }}.performances.{{ $performanceId }}.budgets.{{ $budgetId }}.chipsets.{{ $chipsetId }}.fps" type="number" placeholder="Coloca los FPS">
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endforeach
                                    </ul>
                                @endforeach
                            </ul>
                        @endforeach
                    </ul>
                </div>
                <!--end::Card header-->
            </div>
            <!--end::Order details-->
            <!--end::Meta options-->
            <div class="d-flex justify-content-end">
                <!--begin::Button-->
                <a href="{{ route('admin.configurator.stage.index') }}" class="btn btn-light me-5">{{ __('Cancel') }}</a>
                <!--end::Button-->
                <!--begin::Button-->
                <button wire:loading.attr="disabled" wire:target="{{ $method }}" type="submit" class="btn btn-primary">
                    <span class="indicator-label">{{ __('Save changes') }}</span>
                    <span wire:loading wire:target="{{ $method }}" class="spinner-border spinner-border-sm align-middle ms-2"></span>
                </button>
                <!--end::Button-->
            </div>
        </div>
        <!--end::Main column-->
    </form>
    <!--end::Form-->
</div>
