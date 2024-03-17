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
                @include('admin.setting.access-mailchimp.edit')
            </div>
            <!--end::Card toolbar-->
        </div>
        <!--end::Card header-->
        <!--begin::Body-->
        <div class="card-body p-5 px-lg-19 py-lg-16">
            <div class="mb-14">
                <div class="mb-15">
                    <h1 class="fs-2x text-dark mb-6">{{ __("Mailchimp accesses") }}</h1>
                </div>
                <div class="shadow p-3 mb-5 bg-body rounded">
                    <div class="notice d-flex bg-light-info rounded border-info border border-dashed mb-9 p-6">
                        <div class="d-flex flex-stack flex-grow-1">
                            <div class="fw-bold">
                                <div class="fs-6">
                                    <img width="200" src="{{ asset('assets/admin/media/mailchimp/logo.png') }}" alt="Mailchimp">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container">
                        <h2 class="fw-bolder text-dark mb-8">{{ __('Status') }}</h2>
                        <div class="fs-4 fw-bold text-gray-700 mb-13">
                            @if (config('newsletter.status'))
                                <span class="badge badge-primary">{{ __('Active') }}</span>
                            @else
                                <span class="badge badge-secondary">{{ __('Off') }}</span>
                            @endif
                        </div>
                        <h2 class="fw-bolder text-dark mb-8">API KEY</h2>
                        <div class="fs-4 fw-bold text-gray-700 mb-13">
                            {{ config('newsletter.apiKey') }}
                        </div>
                        <h2 class="fw-bolder text-dark mb-8">LIST ID</h2>
                        <div class="fs-4 fw-bold text-gray-700 mb-13">
                            {{ config('newsletter.lists.subscribers.id') }}
                        </div>
                    </div>
                </div>
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
