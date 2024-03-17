<div>
    <!--begin::Card-->
    <div class="card">
        <!--begin::Card header-->
        <div class="card-header border-0 pt-6">
            <!--begin::Card title-->
            <div class="card-title">

            </div>
            <!--begin::Card title-->
            <!--begin::Card toolbar-->
            <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                @include('admin.video.create')
            </div>
            <!--end::Card toolbar-->
        </div>
        <!--end::Card header-->
        <!--begin::Card body-->
       <!--begin::Body-->
       <div class="card-body p-lg-20">
        <!--begin::Section-->
        <div class="mb-17">
            <!--begin::Row-->
            <div class="row g-10">
                @foreach ($videos as $video)
                    <!--begin::Col-->
                    <div class="col-md-4">
                        <!--begin::Feature post-->
                        <div class="card-xl-stretch me-md-6">
                            <!--begin::Video-->
                            <div class="mb-3">
                                {!! $video->getIframe() !!}
                            </div>
                            <!--end::Video-->
                            <!--begin::Body-->
                            <div class="m-0">
                                <!--begin::Content-->
                                <div class="fs-6 fw-bolder">
                                   @include('admin.video.edit')
                                   @include('admin.video.delete')
                                </div>
                                <!--end::Content-->
                            </div>
                            <!--end::Body-->
                        </div>
                        <!--end::Feature post-->
                    </div>
                    <!--end::Col-->
                @endforeach
            </div>
            <!--end::Row-->
        </div>
        <!--end::Section-->
    </div>
    <!--end::Body-->
    </div>
    <!--end::Card-->
    @push('footer')
    <script>
        Livewire.on('render', function(){
            $('.modal').modal('hide');
        });
    </script>
    @endpush
</div>
