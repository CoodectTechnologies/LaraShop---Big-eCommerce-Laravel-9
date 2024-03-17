 <!--begin::Card-->
 <div class="card pt-4 mb-6 mb-xl-9">
    <!--begin::Card header-->
    <div class="card-header border-0">
        <!--begin::Card title-->
        <div class="card-title">
            <h2>{{ __('Profile') }}</h2>
        </div>
        <div class="card-toolbar">
            @include('admin.user.user.edit')
        </div>
        <!--end::Card title-->
    </div>
    <!--end::Card header-->
    <!--begin::Card body-->
    <div class="card-body pt-0 pb-5">
        <!--begin::Table wrapper-->
        <div class="table-responsive">
            <!--begin::Table-->
            <table class="table align-middle table-row-dashed gy-5">
                <!--begin::Table body-->
                <tbody class="fs-6 fw-bold text-gray-600">
                    <tr>
                        <td>{{ __('Name') }}</td>
                        <td>{{ $user->name }}</td>
                    </tr>
                    <tr>
                        <td>{{ __('email') }}</td>
                        <td>{{ $user->email }}</td>
                    </tr>
                    <tr>
                        <td>{{ __('Password') }}</td>
                        <td>******</td>
                    </tr>
                    <tr>
                        <td>{{ __('Assigned functions') }}</td>
                        <td>
                            @foreach ($user->roles as $role)
                                <a href="{{ route('admin.setting.role.show', $role) }}"><div class="badge badge-lg badge-light-primary d-inline">{{ $role->name }}</div></a>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
                <!--end::Table body-->
            </table>
            <!--end::Table-->
        </div>
        <!--end::Table wrapper-->
    </div>
    <!--end::Card body-->
</div>
<!--end::Card-->
