<!-- Start of PageContent -->
<div class="page-content pt-2">
    <div class="container">
        <div class="tab tab-vertical row gutter-lg">

            @include('ecommerce.account.menu.index')

            <div class="tab-content mb-6">
                <div class="tab-pane active in" id="account-product-digital">
                    <div class="icon-box icon-box-side icon-box-light">
                        <span class="icon-box-icon icon-download">
                            <i class="w-icon-download"></i>
                        </span>
                        <div class="icon-box-content">
                            <h4 class="icon-box-title text-capitalize ls-normal mb-0">{{ $product->name }}</h4>
                        </div>
                    </div>
                    <div class="row product-wrapper mb-7 mt-5">

                        <div id="flipbook">
                            <p>Real 3D Flipbook has lightbox feature - book can be displayed in the same page with lightbox effect.</p>
                            <p>Click on a book cover to start reading.</p>
                            <img width="400" src="{{ $product->imagePreview() }}" />
                        </div>

                        {{-- <div id="container-pdf">
                            <p>Real 3D Flipbook has lightbox feature - book can be displayed in the same page with lightbox effect.</p>
                            <p>Click on a book cover to start reading.</p>
                            <img width="400" src="{{ $product->imagePreview() }}" />
                        </div> --}}

                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('footer')
        <script src="{{ asset('assets/ecommerce/vendor/flipbook/js/flipbook.min.js') }}"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                @if (!$product->getIsDownloadable())
                    $("#flipbook").flipBook({
                        pdfUrl: '{{ asset('').$product->getFileDigital() }}',
                        btnDownloadPages: {
                            enabled: false,
                        },
                        btnDownloadPdf: {
                            enabled: false
                        },
                        btnShare: {
                            enabled: false,
                        }
                    });
                @else
                    $("#flipbook").flipBook({
                        pdfUrl: '{{ asset('').$product->getFileDigital() }}'
                    });
                @endif

            })
        </script>
    @endpush

</div>
