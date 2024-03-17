<div>
    <div x-data="configurator" class="page-content background-3">
        <div class="product product-single row">
            <div class="container-fluid">
                <div class="row min-height">
                    @include('ecommerce.configurator.partials._alerts')
                    @include('ecommerce.configurator.partials._errors')
                    <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12 boder-radius">
                        <div class="p-4 p-md-5 text-white">
                            @include('ecommerce.configurator.partials._tools')
                        </div>
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-lg-6">
                                    @include('ecommerce.configurator.partials._gallery')
                                </div>
                                <div class="col-lg-6">
                                    <div x-show="tab == 'tab-component' || tab == 'tab-summary'" class="row p-2">
                                        @foreach ($stagesComponent as $stageComponent)
                                            @php $product = $this->getCartItemStage($stageComponent->id); @endphp
                                            <div wire:click.prevent="buildStage({{ $stageComponent->id }}, '{{ $this->getStageTypeComponent() }}')" x-on:click="tabComponent" class="{{ (count($stagesComponent) % 2 != 0 && $loop->iteration == 1) ? 'col-12' : 'col-6' }}" style="cursor: pointer;">
                                                <div class="mb-3 background-2 border-radius background-hover {{ $this->buildStageComponent->id == $stageComponent->id ? 'background-active' : '' }}">
                                                    @include('ecommerce.configurator.partials._stage', ['stage' => $stageComponent, 'product' => $product])
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div x-show="tab == 'tab-addon'"  class="row p-2">
                                        @foreach ($stagesAddon as $stageAddon)
                                            @php $product = $this->getCartItemStage($stageAddon->id); @endphp
                                            <div wire:click.prevent="buildStage({{ $stageAddon->id }}, '{{ $this->getStageTypeAddon() }}')" x-on:click="tabAddon" class="{{ (count($stagesAddon) % 2 != 0 && $loop->iteration == 1) ? 'col-12' : 'col-6' }}" style="cursor: pointer;">
                                                <div class="mb-3 background-2 border-radius background-hover {{ $this->buildStageAddon->id == $stageAddon->id ? 'background-active' : '' }}">
                                                    @include('ecommerce.configurator.partials._stage', ['stage' => $stageAddon, 'product' => $product])
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 background-1 boder-radius">
                        <div class="row">
                            <div class="tab tab-nav-boxed tab-nav-underline">
                                <ul class="nav nav-tabs d-flex justify-content-center" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link" x-bind:class="tab == 'tab-component' ? 'active' : ''" x-on:click="tabComponent"  href="#tab2-1">{{ __('Components') }}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" x-bind:class="tab == 'tab-addon' ? 'active' : ''" x-on:click="tabAddon" href="#tab2-2">{{ __('Addons') }}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" x-bind:class="tab == 'tab-summary' ? 'active' : ''" x-on:click="tabSummary" href="#tab2-3">{{ __('Summary') }}</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane" x-bind:class="tab == 'tab-component' ? 'active' : ''" id="tab2-1">
                                        <div class="overflow">
                                            <div class="d-flex justify-content-center py-2 my-2" role="status">
                                                <div wire:loading wire:target="buildStage" class="spinner-grow"></div>
                                            </div>
                                            @foreach ($productsComponent as $productComponent)
                                                @include('ecommerce.configurator.partials._product', ['product' => $productComponent, 'stageType' => 'Componentes'])
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="tab-pane" x-bind:class="tab == 'tab-addon' ? 'active' : ''" id="tab2-2">
                                        <div class="overflow">
                                            <div class="d-flex justify-content-center py-2 my-2" role="status">
                                                <div wire:loading wire:target="buildStage" class="spinner-grow"></div>
                                            </div>
                                            @foreach ($productsAddon as $productAddon)
                                                @include('ecommerce.configurator.partials._product', ['product' => $productAddon, 'stageType' => 'Complementos'])
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="tab-pane" x-bind:class="tab == 'tab-summary' ? 'active' : ''" id="tab2-3">
                                        <div class="overflow">
                                            @include('ecommerce.configurator.partials._summary')
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('ecommerce.layouts.configurator.footer')
        </div>
        @include('ecommerce.configurator.partials._budget')
    </div>
    @push('footer')
        <script>
            document.addEventListener('alpine:init', () => {
                Alpine.data('configurator', () => ({
                    tab: 'tab-component',

                    tabComponent() {
                        this.tab = 'tab-component'
                    },
                    tabAddon() {
                        this.tab = 'tab-addon'
                    },
                    tabSummary() {
                        this.tab = 'tab-summary'
                    },
                }))
            })
            Livewire.on('closeModal', function(){
                $('.modal').modal('hide');
            });
            Livewire.on('showModalShareCart', function(){
                $('#showModalShareCart').modal('show');
            });
            @if(config('configurator.budget_active'))
                if(!window.location.href.includes('shareCart')) {
                    $('#modalBudget').modal('show');
                }
            @endif
        </script>
    @endpush
</div>
