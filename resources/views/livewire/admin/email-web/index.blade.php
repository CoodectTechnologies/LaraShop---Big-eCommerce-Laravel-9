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
             <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                <div class="w-100 mw-150px">
                    <!--begin::Select2-->
                    <select wire:model="conversionFilter" class="form-select form-select-solid">
                        <option value="">{{ __('All') }}</option>
                        <option value="Si">{{ __('Yes') }}</option>
                        <option value="No">No</option>
                        <option value="En espera">{{ __('On hold') }}</option>
                    </select>
                    <!--end::Select2-->
                </div>
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
                            <th class="">ID</th>
                            <th class="">{{ __('Name') }}</th>
                            <th class="">{{ __('Subject') }}</th>
                            <th class="">{{ __('email') }}</th>
                            <th class="">{{ __('Phone') }}</th>
                            <th class="">WhatsApp</th>
                            <th class="">{{ __('Conversion') }}</th>
                            <th class="">{{ __('Date') }}</th>
                            <th class="">{{ __('Actions') }}</th>
                        </tr>
                        <!--end::Table row-->
                    </thead>
                    <!--end::Table head-->
                    <!--begin::Table body-->
                    <tbody class="text-gray-600 fw-bold">
                        @foreach ($emailWebs as $emailWeb)
                        <!--begin::Table row-->
                        <tr>
                            <td>{{ $emailWeb->id }}</td>
                            <td>{{ $emailWeb->name }}</td>
                            <td>{{ $emailWeb->subject }}</td>
                            <td><a href="mailto:{{ $emailWeb->email }}" target="_blank" rel="noopener noreferrer"><i class="fa fa-envelope"></i> {{ $emailWeb->email }}</a></td>
                            <td><i class="fa fa-phone"></i> <a href="tel:{{ $emailWeb->phone }}" target="_blank" rel="noopener noreferrer">{{ $emailWeb->phone }}</a></td>
                            <td><i class="fab fa-whatsapp"></i> <a href="https://wa.me/+52{{ $emailWeb->phone }}" target="_blank" rel="noopener noreferrer">https://wa.me/+52{{ $emailWeb->phone }}</a></td>
                            <td>{!! $emailWeb->conversionToString() !!}</td>
                            <td>{{ $emailWeb->dateToString() }}</td>
                            <!--begin::Action=-->
                            <td class="">
                                @include('admin.email-web.show')
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
            {{ $emailWebs->links() }}
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
