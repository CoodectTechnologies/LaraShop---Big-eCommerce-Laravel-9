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
                @include('admin.team.create')
            </div>
            <!--end::Card toolbar-->
        </div>
        <!--end::Card header-->
        <!--begin::Card body-->
        <div class="card-body py-4">
           <!--begin::Team-->
            <div class="mb-18">
                <!--begin::Wrapper-->
                <div class="row row-cols-1 row-cols-sm-2 row-cols-xl-4 gy-10">
                    @foreach ($team as $person)
                        <!--begin::Item-->
                        <div class="col mb-9">
                            <div class="text-center">
                                <!--begin::Photo-->
                                <div class="octagon mx-auto mb-2 d-flex w-150px h-150px bgi-no-repeat bgi-size-contain bgi-position-center" style="background-image:url('{{ $person->imagePreview() }}')"></div>
                                <!--end::Photo-->
                                <!--begin::Person-->
                                <div class="mb-0">
                                    <!--begin::Name-->
                                    <a class="text-dark fw-bolder fs-3">{{ $person->name }}</a>
                                    <!--end::Name-->
                                    <!--begin::Position-->
                                    <div class="text-muted fs-6 fw-bold">{{ $person->position }}</div>
                                    <!--begin::Position-->
                                </div>
                                <!--end::Person-->
                                <a href="#" data-bs-toggle="modal" data-bs-target="#kt_modal_update_team_{{ $person->id }}" class="btn btn-light-success btn-shadow">{{ __('Update') }}</a>
                                <a href="#" onclick="event.preventDefault(); confirmDestroyTeam({{ $person->id }})" class="btn btn-light-danger btn-shadow ms-2">{{ __('Delete') }}</a>
                            </div>
                            @include('admin.team.edit')
                            @include('admin.team.delete')
                        </div>
                        <!--end::Item-->
                    @endforeach
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Team-->
            {{ $team->links() }}
        </div>
        <!--end::Card body-->
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
