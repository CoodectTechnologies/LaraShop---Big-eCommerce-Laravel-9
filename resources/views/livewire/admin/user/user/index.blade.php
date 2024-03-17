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
                @include('admin.user.user.create')
            </div>
            <!--end::Card toolbar-->
        </div>
        <!--end::Card header-->
        <!--begin::Card body-->
        <div class="card-body py-4">
            <!--begin::Table-->
            <div class="table-responsive">
                <table class="table align-middle table-row-dashed fs-6 gy-5">
                    <!--begin::Table head-->
                    <thead>
                        <!--begin::Table row-->
                        <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                            <th class="min-w-125px">{{ __('User') }}</th>
                            <th class="min-w-10px">{{ __('Role') }}</th>
                            {{-- <th class="min-w-10px">{{ __('Last session') }}</th> --}}
                            <th class="min-w-10px">{{ __('Date of creation') }}</th>
                            <th class="min-w-100px">{{ __('Actions') }}</th>
                        </tr>
                        <!--end::Table row-->
                    </thead>
                    <!--end::Table head-->
                    <!--begin::Table body-->
                    <tbody class="text-gray-600 fw-bold">
                        @foreach ($users as $user)
                        <!--begin::Table row-->
                        <tr>
                            <!--begin::User=-->
                            <td class="d-flex align-items-center">
                                <!--begin:: Avatar -->
                                <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                    <a href="{{ route('admin.user.show', $user) }}">
                                        <div class="symbol-label">
                                            <img loading="lazy" src="{{ $user->imagePreview() }}" alt="{{ $user->name }}" class="w-100" />
                                        </div>
                                    </a>
                                </div>
                                <!--end::Avatar-->
                                <!--begin::User details-->
                                <div class="d-flex flex-column">
                                    <a href="{{ route('admin.user.show', $user) }}" class="text-gray-800 text-hover-primary mb-1">{{ $user->name }}</a>
                                    <span>{{ $user->email }}</span>
                                </div>
                                <!--begin::User details-->
                            </td>
                            <!--end::User=-->
                            <!--begin::Role=-->
                            <td>
                                @foreach ($user->roles as $role)
                                <a href="{{ route('admin.setting.role.show', $role) }}" class="badge badge-light-primary fs-7 m-1">{{ $role->name }}</a>
                                @endforeach
                            </td>
                            <!--end::Role=-->
                            {{-- <td>
                                {{ $user->session ? $user->session->lastSession() : ''  }} <br>
                                @if ($user->isOnline())
                                    <span class="badge badge-success">Online</span>
                                @endif
                               <span></span>
                            </td> --}}
                            <td>

                            </td>
                            <!--begin::Joined-->
                            <td>{{ $user->dateToString() }}</td>
                            <!--begin::Joined-->
                            <!--begin::Action=-->
                            <td class="">
                                @include('admin.user.user.edit')
                                @include('admin.user.user.delete')
                            </td>
                            <!--end::Action=-->
                        </tr>
                        <!--end::Table row-->
                        @endforeach
                    </tbody>
                    <!--end::Table body-->
                </table>
            </div>
            <!--end::Table-->
            {{ $users->links() }}
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
