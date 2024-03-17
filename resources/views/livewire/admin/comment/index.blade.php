<div>
    <!--begin::Card header-->
    <div class="card-header cursor-pointer">
        <!--begin::Card title-->
        <div class="card-title m-0">
            <h3 class="fw-bolder m-0 me-4">{{ __('Comments') }}</h3>
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
                <input wire:model="searchComment" type="search" class="form-control form-control-solid w-250px ps-14" placeholder="{{ __('Search...') }}" />
            </div>
            <!--end::Search-->
        </div>
        <!--begin::Card title-->
        <!--begin::Card toolbar-->
        <div class="card-toolbar">
            @include('admin.comment.create')
        </div>
        <!--end::Card toolbar-->
    </div>
    <!--end::Card header-->

    <!--begin::Card body-->
    <div class="card-body py-4">
        @forelse ($comments as $comment)
            <!--begin::Header-->
            <div class="d-flex align-items-center mb-5">
                <!--begin::User-->
                <div class="d-flex align-items-center flex-grow-1">
                    <!--begin::Avatar-->
                    <div class="symbol symbol-45px me-5">
                        <img src="{{ $comment->imageUserPreview() }}" alt="{{ $comment->name }}" />
                    </div>
                    <!--end::Avatar-->
                    <!--begin::Info-->
                    <div class="d-flex flex-column">
                        <span class="text-gray-900 fs-6 fw-bolder">{{ $comment->name }}</span>
                        <span class="text-gray-900 fs-6 fw-bolder mf-5">
                            @for ($i = 1; $i <= $comment->stars; $i++)
                                <i class="fa fa-star text-warning"></i>
                            @endfor
                        </span>
                        <span class="text-gray-400 fw-bold">{{ $comment->email }}</span>
                        @if ($comment->approved)
                            <span class="badge badge-success mt-1">{{ __('Authorized') }}</span>
                        @else
                            <span class="badge badge-warning mt-1">{{ __('Not authorized') }}</span>
                        @endif
                    </div>
                    <!--end::Info-->
                </div>
                <!--end::User-->
                <!--begin::Menu-->
                <div class="my-0">
                    <div class="dropdown">
                        <button class="btn btn-sm btn-light-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen024.svg-->
                            <span class="svg-icon svg-icon-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="5" y="5" width="5" height="5" rx="1" fill="#000000" />
                                        <rect x="14" y="5" width="5" height="5" rx="1" fill="#000000" opacity="0.3" />
                                        <rect x="5" y="14" width="5" height="5" rx="1" fill="#000000" opacity="0.3" />
                                        <rect x="14" y="14" width="5" height="5" rx="1" fill="#000000" opacity="0.3" />
                                    </g>
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#kt_modal_update_comment_{{ $comment->id }}">{{ __('Update') }}</a></li>
                            @if ($comment->approved)
                                <li wire:click.prevent="refused({{ $comment->id }})"><a class="dropdown-item">{{  __('Refuse') }}</a></li>
                            @else
                                <li wire:click.prevent="approved({{ $comment->id }})"><a class="dropdown-item">{{  __('Approve') }}</a></li>
                            @endif
                            @include('admin.comment.delete')
                        </ul>
                        {{-- Modal edit comment --}}
                        @include('admin.comment.edit')
                      </div>
                </div>
                <!--end::Menu-->
            </div>
            <!--end::Header-->
            <!--begin::Post-->
            <div class="mb-5">
                <!--begin::Text-->
                <p class="text-gray-800 fw-normal mb-5" style="white-space: pre-wrap;">
                    {{ $comment->body }}
                </p>
                <!--end::Text-->
            </div>
            <!--end::Post-->
            <div class="border-gray-300 border-bottom-dashed mb-5"></div>
        @empty
            <!--begin::Alert-->
            <div class="alert alert-primary d-flex align-items-center p-5">
                <!--begin::Icon-->
                <span class="svg-icon svg-icon-2hx svg-icon-primary me-3">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path opacity="0.3" d="M2 4V16C2 16.6 2.4 17 3 17H13L16.6 20.6C17.1 21.1 18 20.8 18 20V17H21C21.6 17 22 16.6 22 16V4C22 3.4 21.6 3 21 3H3C2.4 3 2 3.4 2 4Z" fill="currentColor"></path>
                        <path d="M18 9H6C5.4 9 5 8.6 5 8C5 7.4 5.4 7 6 7H18C18.6 7 19 7.4 19 8C19 8.6 18.6 9 18 9ZM16 12C16 11.4 15.6 11 15 11H6C5.4 11 5 11.4 5 12C5 12.6 5.4 13 6 13H15C15.6 13 16 12.6 16 12Z" fill="currentColor"></path>
                    </svg>
                </span>
                <!--end::Icon-->
                <!--begin::Wrapper-->
                <div class="d-flex flex-column">
                    <!--begin::Title-->
                    <h4 class="mb-1 text-dark">{{ __('No comment') }}</h4>
                    <!--end::Title-->
                    <!--begin::Content-->
                    <span>
                        {{ __('No comment was found.') }}
                        @if ($searchComment)
                            "{{ $searchComment }}"
                        @endif
                    </span>
                    <!--end::Content-->
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Alert-->
        @endforelse
        {{ $comments->links() }}
    </div>
    @push('footer')
        <script>
            Livewire.on('render', function(){
                $('.modal').modal('hide');
            });
        </script>
    @endpush
</div>
