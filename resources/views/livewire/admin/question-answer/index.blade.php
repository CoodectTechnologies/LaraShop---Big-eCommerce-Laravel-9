<div>
    <!--begin::FAQ card-->
    <div class="card">
        <!--begin::Card header-->
        <div class="card-header align-items-center py-5 gap-2 gap-md-5">
            <!--begin::Card title-->
            <div class="card-title">

            </div>
            <!--end::Card title-->
            <!--begin::Card toolbar-->
            <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                @include('admin.question-answer.create')
            </div>
            <!--end::Card toolbar-->
        </div>
        <!--end::Card header-->
        <!--begin::Body-->
        <div class="card-body p-10 p-lg-15">
            <!--begin::Classic content-->
            <div class="mb-13">
                <!--begin::Intro-->
                <div class="mb-15">
                    <!--begin::Title-->
                    <h4 class="fs-2x text-gray-800 w-bolder mb-6">{{ __('Frequent questions') }}</h4>
                    <!--end::Title-->
                    <!--begin::Text-->
                    <p class="fw-bold fs-4 text-gray-600 mb-2">{{ __("You will manage customers' most frequently asked questions by providing answers, so that information is always available to them.") }}</p>
                    <!--end::Text-->
                </div>
                <!--end::Intro-->
                <!--begin::Row-->
                <div class="row mb-12">
                    <!--begin::Col-->
                    <div class="col-md-12 pe-md-10 mb-10 mb-md-0">
                        <!--begin::Accordion-->
                        @foreach ($questionAnswers as $questionAnswer)
                            <!--begin::Section-->
                            <div class="m-0">
                                <!--begin::Heading-->
                                <div class="d-flex align-items-center collapsible py-3 toggle collapsed mb-0" data-bs-toggle="collapse" data-bs-target="#kt_question_answer_{{ $questionAnswer->id }}">
                                    <!--begin::Icon-->
                                    <div class="btn btn-sm btn-icon mw-20px btn-active-color-primary me-5">
                                        <!--begin::Svg Icon | path: icons/duotune/general/gen036.svg-->
                                        <span class="svg-icon toggle-on svg-icon-primary svg-icon-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="black" />
                                                <rect x="6.0104" y="10.9247" width="12" height="2" rx="1" fill="black" />
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->
                                        <!--begin::Svg Icon | path: icons/duotune/general/gen035.svg-->
                                        <span class="svg-icon toggle-off svg-icon-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="black" />
                                                <rect x="10.8891" y="17.8033" width="12" height="2" rx="1" transform="rotate(-90 10.8891 17.8033)" fill="black" />
                                                <rect x="6.01041" y="10.9247" width="12" height="2" rx="1" fill="black" />
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </div>
                                    <!--end::Icon-->
                                    <!--begin::Title-->
                                    <h4 class="text-gray-700 fw-bolder cursor-pointer mb-0">{{ $questionAnswer->question }}</h4>
                                    <!--end::Title-->
                                    <span class="text-end">
                                        @include('admin.question-answer.edit')
                                        @include('admin.question-answer.delete')
                                    </span>

                                </div>
                                <!--end::Heading-->
                                <!--begin::Body-->
                                <div id="kt_question_answer_{{ $questionAnswer->id }}" class="collapse fs-6 ms-1">
                                    <!--begin::Text-->
                                    <div class="mb-4 text-gray-600 fw-bold fs-6 ps-10">{{ $questionAnswer->answer }}</div>
                                    <!--end::Text-->
                                </div>
                                <!--end::Content-->
                                <!--begin::Separator-->
                                <div class="separator separator-dashed"></div>
                                <!--end::Separator-->
                            </div>
                            <!--end::Section-->
                        @endforeach
                        <!--end::Accordion-->
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Row-->
            </div>
            <!--end::Classic content-->
        </div>
        <!--end::Body-->
    </div>
    <!--end::FAQ card-->
    @push('footer')
        <script>
            Livewire.on('render', function(){
                $('.modal').modal('hide');
            });
        </script>
    @endpush
</div>
