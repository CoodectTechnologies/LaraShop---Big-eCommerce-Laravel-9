<div class="flex-lg-row-fluid ms-lg-7 ms-xl-10">
    <!--begin::Content-->
    <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 g-5 g-xl-9">
        @include('admin.setting.role.create')
        @foreach ($roles as $role)
            <!--begin::Col-->
            <div class="col-md-4">
                <!--begin::Card-->
                <div class="card card-flush h-md-100">
                    <!--begin::Card header-->
                    <div class="card-header">
                        <!--begin::Card title-->
                        <div class="card-title">
                            <h2>{{ $role->name }}</h2>
                        </div>
                        <!--end::Card title-->
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body pt-1">
                        <!--begin::Users-->
                        <div class="fw-bolder text-gray-600 mb-5">{{ __('Total number of users with this role:') }} {{ count($role->users) }}</div>
                        <!--end::Users-->
                        <!--begin::Permissions-->
                        <div class="d-flex flex-column text-gray-600">
                            @foreach ($role->permissions as $permission)
                                @if ($loop->iteration == 6 && count($role->permissions) > 6 )
                                    <div class="d-flex align-items-center py-2">
                                    <span class="bullet bg-primary me-3"></span><a href="{{ route('admin.setting.role.show', $role) }}">Y {{ count($role->permissions) - 6 }} más</a></div>
                                    @break
                                @endif
                                <div class="d-flex align-items-center py-2">
                                <span class="bullet bg-primary me-3"></span>{{ $permission->name }}</div>
                            @endforeach
                        </div>
                        <!--end::Permissions-->
                    </div>
                    <!--end::Card body-->
                    <!--begin::Card footer-->
                    <div class="card-footer flex-wrap pt-0">
                        <a href="{{ route('admin.setting.role.show', $role) }}" class="btn btn-light btn-active-primary my-1 me-2">Ver</a>
                        @include('admin.setting.role.edit')
                        @include('admin.setting.role.delete')
                    </div>
                    <!--end::Card footer-->
                </div>
                <!--end::Card-->
            </div>
            <!--end::Col-->
        @endforeach
    </div>
    <!--end::Card-->
    @push('footer')
    <script>
            Livewire.on('render', function(){
                $('.modal').modal('hide');
            });
    </script>
    @endpush
    <!--end::Content-->
</div>
