<div>
    <!--begin::Card-->
    <div class="card">
        <!--begin::Card header-->
        <div class="card-header border-0 pt-6">
            <!--begin::Card title-->
            <div class="card-title">
                <!--begin::Search-->
                <div class="d-flex align-items-center position-relative my-1">
                    <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                    <span class="svg-icon svg-icon-1 position-absolute ms-6">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="black" />
                            <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="black" />
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                    <input wire:model="search" type="search" class="form-control form-control-solid w-250px ps-14" placeholder="{{ __('Search...') }}" />
                </div>
                <!--end::Search-->
            </div>
            <!--begin::Card title-->
            <!--begin::Card toolbar-->
            <div class="card-toolbar">
                <!--begin::Button-->
                <a href="{{ route('admin.blog.post.create') }}" class="btn btn-light-primary">
                    <!--begin::Svg Icon | path: icons/duotune/general/gen035.svg-->
                    <span class="svg-icon svg-icon-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="black" />
                                <rect x="10.8891" y="17.8033" width="12" height="2" rx="1" transform="rotate(-90 10.8891 17.8033)" fill="black" />
                            <rect x="6.01041" y="10.9247" width="12" height="2" rx="1" fill="black" />
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                    {{ __('New') }}
                </a>
                <!--end::Button-->
            </div>
            <!--end::Card toolbar-->
        </div>
        <!--end::Card header-->
        <!--begin::Card body-->
        <div class="card-body py-4">
            <div class="row g-10">
                @foreach ($posts as $post)
                    <!--begin::Col-->
                    <div class="col-md-4">
                        <!--begin::Hot sales post-->
                        <div class="card-xl-stretch me-md-6">
                            <!--begin::Overlay-->
                            <a class="d-block overlay" href="{{ route('admin.blog.post.show', $post) }}">
                                <!--begin::Image-->
                                <div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-175px" style="background-image:url('{{ $post->imagePreview() }}')"></div>
                                <!--end::Image-->
                                <!--begin::Action-->
                                <div class="overlay-layer card-rounded bg-dark bg-opacity-25">
                                    <i class="bi bi-eye-fill fs-2x text-white"></i>
                                </div>
                                <!--end::Action-->
                            </a>
                            <!--end::Overlay-->
                            <!--begin::Body-->
                            <div class="mt-5">
                                <!--begin::Title-->
                                <a href="{{ route('admin.blog.post.show', $post) }}" class="fs-4 text-dark fw-bolder text-hover-primary text-dark lh-base">{{ $post->name }}</a>
                                <!--end::Title-->
                                <!--begin::Text-->
                                <div class="fw-bold fs-5 text-gray-600 text-dark mt-3">{{ $post->detail }}</div>
                                <!--end::Text-->
                                @foreach ($post->blogCategories as $blogCategory)
                                    <!--begin::Label-->
                                    <span class="badge badge-light-primary fw-bolder my-2">{{ $blogCategory->name }}</span>
                                    <!--end::Label-->
                                @endforeach
                                <!--begin::Text-->
                                <div class="fs-6 fw-bolder mt-5 mb-5 d-flex flex-stack">
                                    <!--begin::Label-->
                                    <span class="badge border border-dashed fs-2 fw-bolder text-dark p-2">
                                        <span class="fs-6 fw-bold text-gray-400">
                                            <i class="fa fa-eye me-2"></i>
                                        </span> {{ $post->viewUniques() }}
                                        <span class="fs-6 ms-4 fw-bold text-gray-400">
                                        <i class="fa fa-solid fa-comments me-2"></i>
                                        </span> {{ $post->comments()->count() }}
                                    </span>
                                    <!--end::Label-->
                                </div>
                                <!--end::Text-->
                            </div>
                            <!--end::Body-->
                            <!--begin::Footer-->
                            <div class="d-flex flex-stack flex-wrap">
                                <!--begin::Item-->
                                <div class="d-flex align-items-center pe-2">
                                    @if ($post->user)
                                        <!--begin::Avatar-->
                                        <div class="symbol symbol-35px symbol-circle me-3">
                                            <img alt="{{ $post->user->name }}" src="{{ $post->user->imagePreview() }}" />
                                        </div>
                                        <!--end::Avatar-->
                                        <!--begin::Text-->
                                        <div class="fs-5 fw-bolder">
                                            <a href="{{ route('admin.user.show', $post->user) }}" class="text-gray-700">{{ $post->user->name }} </a>
                                        </div>
                                        <!--end::Text-->
                                    @endif
                                    <span class="text-muted ms-4"> {{ $post->dateToString() }}</span>
                                </div>
                                <!--end::Item-->
                            </div>
                            <!--end::Footer-->
                            <div class="text-center">
                                <a href="{{ route('admin.blog.post.edit', $post) }}" class="btn btn-light-success btn-shadow">{{ __('Update') }}</a>
                                @include('admin.blog.post.delete')
                            </div>
                        </div>
                        <!--end::Hot sales post-->
                    </div>
                    <!--end::Col-->
                @endforeach
            </div>
            {{ $posts->links() }}
        </div>
        <!--end::Card body-->
    </div>
    <!--end::Card-->
</div>
