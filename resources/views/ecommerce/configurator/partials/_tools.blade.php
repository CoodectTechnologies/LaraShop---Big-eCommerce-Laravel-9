<div class="row d-flex">
    <div class="col-lg-6">
        <h1 x-show="tab == 'tab-component' || tab == 'tab-summary'" class="font-bold text-white">{{ $buildStageComponent->name }}</h1>
        <h1 x-show="tab == 'tab-addon'" class="font-bold text-white">{{ $buildStageAddon->name }}</h1>
    </div>
    <div class="col-lg-6 d-flex justify-content-lg-end justify-content-sm-start">
        <div class="">
            @auth
                <button wire:click="saveCart" wire:loading.class="load-more-overlay loading" wire:loading.disabled
                    wire:target="saveCart" wire:key="{{ rand() }}" type="button" class="button-setting">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                        </path>
                    </svg>
                    {{ __('Save') }}
                </button>
                <button wire:click="restoreCart" wire:loading.class="load-more-overlay loading" wire:loading.disabled
                    wire:target="restoreCart" wire:key="{{ rand() }}" type="button" class="button-setting">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10">
                        </path>
                    </svg>
                    {{ __('Load') }}
                </button>
            @endauth
            <button wire:click="removeCart" wire:loading.class="load-more-overlay loading" wire:loading.disabled
                wire:target="removeCart" wire:key="{{ rand() }}" type="button" class="button-setting">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                    </path>
                </svg>
                {{ __('Restart') }}
            </button>
            <button wire:click="shareCart" wire:loading.class="load-more-overlay loading" wire:loading.disabled
                wire:target="shareCart" wire:key="{{ rand() }}" type="button" class="button-setting">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9.538 3.91a.75.75 0 01.102 1.492l-.102.007H3.439c-.878 0-1.608.684-1.683 1.545l-.006.145v13.416c0 .884.679 1.61 1.544 1.683l.145.007h13.417a1.69 1.69 0 001.683-1.544l.007-.146v-6.098a.75.75 0 011.493-.102l.007.102v6.098a3.19 3.19 0 01-3.009 3.185l-.18.005H3.438a3.19 3.19 0 01-3.184-3.009l-.005-.18V7.098a3.197 3.197 0 013.009-3.185l.18-.005h6.099zM22.955.25a.75.75 0 01.743.648l.007.102v7.318a.75.75 0 01-1.493.102l-.007-.102-.001-5.507-12.136 12.136a.75.75 0 01-1.133-.976l.073-.085L21.143 1.75h-5.507a.75.75 0 01-.743-.648L14.886 1a.75.75 0 01.649-.743l.101-.007h7.319z">
                    </path>
                </svg>
                {{ __('Share') }}
            </button>
        </div>
    </div>
</div>


<!-- Modal -->
<div wire:ignore.self class="modal fade" id="showModalShareCart" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('Public link') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body d-flex">
                <input type="text" id="linkInput" value="{{ route('ecommerce.configurator.index') }}?shareCart={{ $identifierSaveCartPublic }}" readonly class="form-control">
                <button id="buttonLink" onclick="copyLink()" class="btn btn-secondary text-end">{{ __('Copy link') }}</button>
            </div>
        </div>
    </div>
</div>

@push('footer')
    <script>
        function copyLink() {
            var input = document.getElementById("linkInput");
            input.select();
            document.execCommand("copy");
            $('#buttonLink').html("{{ __('Link copied') }}");
        }
    </script>
@endpush
