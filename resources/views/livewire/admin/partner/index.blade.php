<div>
    <div class="card card-flush">
        <!--begin::Card header-->
        <div class="card-header align-items-center py-5 gap-2 gap-md-5">
            <!--begin::Card title-->
            <div class="card-title">

            </div>
            <!--end::Card title-->
            <!--begin::Card toolbar-->
            <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                @include('admin.partner.create')
            </div>
            <!--end::Card toolbar-->
        </div>
        <!--end::Card header-->
        <!--begin::Card body-->
        <div class="card-body pt-0">
            <div class="row">
                @foreach ($partners as $partner)
                    <div class="col-lg-3">
                        <!--begin::Card-->
                        <div class="card  overlay overflow-hidden">
                            <div class="card-body p-0">
                                <div class="overlay-wrapper">
                                    <img loading="lazy" src="{{ $partner->imagePreview() }}" class="w-100 rounded"/>
                                </div>
                                <div class="bg-dark bg-opacity-25 align-items-end justify-content-center">
                                    <div class="d-flex flex-grow-1 flex-center  py-5">
                                        @include('admin.partner.edit')
                                        @include('admin.partner.delete')
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end::Card-->
                    </div>
                @endforeach
            </div>
        </div>
        <!--end::Card body-->
    </div>
    @push('footer')
    <script>
        Livewire.on('render', function(){
            $('.modal').modal('hide');
        });
    </script>
    @endpush
    <!--end::Content-->
</div>
