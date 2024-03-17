<div class="flex-lg-row-fluid ms-lg-7 ms-xl-10">
    <!--begin::Content-->
    <!--begin::Card-->
    <div class="card card-flush">
         <!--begin::Card header-->
         <div class="card-header align-items-center py-5 gap-2 gap-md-5">
            <!--begin::Card title-->
            <div class="card-title">

            </div>
            <!--end::Card title-->
            <!--begin::Card toolbar-->
            <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                @include('admin.setting.contact.edit')
            </div>
            <!--end::Card toolbar-->
        </div>
        <!--end::Card header-->
        <!--begin::Body-->
        <div class="card-body p-5 px-lg-19 py-lg-16">
            <!--begin::Content main-->
            <div class="mb-14">
                <!--begin::Heading-->
                <div class="mb-15">
                    <!--begin::Title-->
                    <h1 class="fs-2x text-dark mb-6">{{ __("Contact information") }}</h1>
                    <!--end::Title-->
                </div>
                <!--end::Heading-->
                <!--begin::Body-->
                <!--begin::Block-->
                <div class="mb-20 pb-lg-20">
                    <!--begin::Title-->
                    <h2 class="fw-bolder text-dark mb-8">{{ __('Phone') }}</h2>
                    <!--end::Title-->
                    <div class="fs-4 fw-bold text-gray-700 mb-13">
                        <a href="tel:{{ config('contact.phone') }}">{{ config('contact.phone') }}</a>
                    </div>
                    <!--end::Text-->
                    <!--begin::Title-->
                    <h2 class="fw-bolder text-dark mb-7">{{ __('email') }}</h2>
                    <!--end::Title-->
                    <!--begin::Text-->
                    <div class="fs-4 fw-bold text-gray-700 mb-13">
                        <a href="mailto:{{ config('contact.email') }}">{{ config('contact.email') }}</a>
                    </div>
                    <!--end::Text-->
                    <!--begin::Title-->
                    <h2 class="fw-bolder text-dark mb-7">Facebook</h2>
                    <!--end::Title-->
                    <!--begin::Text-->
                    <div class="fs-4 fw-bold text-gray-700 mb-13">
                        <a href="{{ config('contact.facebook') }}" target="_blank" rel="noopener noreferrer">{{ config('contact.facebook') }}</a>
                    </div>
                    <!--end::Text-->
                    <h2 class="fw-bolder text-dark mb-7">Twitter</h2>
                    <!--end::Title-->
                    <!--begin::Text-->
                    <div class="fs-4 fw-bold text-gray-700 mb-13">
                        <a href="{{ config('contact.twitter') }}" target="_blank" rel="noopener noreferrer">{{ config('contact.twitter') }}</a>
                    </div>
                    <!--end::Text-->
                    <!--end::Text-->
                    <h2 class="fw-bolder text-dark mb-7">Instagram</h2>
                    <!--end::Title-->
                    <!--begin::Text-->
                    <div class="fs-4 fw-bold text-gray-700 mb-13">
                        <a href="{{ config('contact.instagram') }}" target="_blank" rel="noopener noreferrer">{{ config('contact.instagram') }}</a>
                    </div>
                    <!--end::Text-->
                    <!--end::Text-->
                    <h2 class="fw-bolder text-dark mb-7">YouTube</h2>
                    <!--end::Title-->
                    <!--begin::Text-->
                    <div class="fs-4 fw-bold text-gray-700 mb-13">
                        <a href="{{ config('contact.youtube') }}" target="_blank" rel="noopener noreferrer">{{ config('contact.youtube') }}</a>
                    </div>
                    <!--end::Text-->
                    <!--end::Text-->
                    <h2 class="fw-bolder text-dark mb-7">WhatsApp</h2>
                    <!--end::Title-->
                    <!--begin::Text-->
                    <div class="fs-4 fw-bold text-gray-700 mb-13">
                        <a href="https://wa.me/{{ config('contact.whatsapp') }}" target="_blank" rel="noopener noreferrer">{{ config('contact.whatsapp') }}</a>
                    </div>
                    <!--end::Text-->
                    <!--end::Text-->
                    <h2 class="fw-bolder text-dark mb-7">Linkedin</h2>
                    <!--end::Title-->
                    <!--begin::Text-->
                    <div class="fs-4 fw-bold text-gray-700 mb-13">
                        <a href="{{ config('contact.linkedin') }}" target="_blank" rel="noopener noreferrer">{{ config('contact.linkedin') }}</a>
                    </div>
                    <!--end::Text-->
                    <!--end::Text-->
                    <h2 class="fw-bolder text-dark mb-7">{{ __("Map") }}</h2>
                    <!--end::Title-->
                    <!--begin::Text-->
                    <div class="fs-4 fw-bold text-gray-700 mb-13">
                        {{ config('contact.map') }}
                    </div>
                    <!--end::Text-->
                </div>
                <!--end::Block-->
                <!--end::Body-->
            </div>
            <!--end::Content main-->
        </div>
        <!--end::Body-->
    </div>
    <!--end::About card-->
    @push('footer')
    <script>
        Livewire.on('render', function(){
            $('.modal').modal('hide');
        });
    </script>
    @endpush
</div>
