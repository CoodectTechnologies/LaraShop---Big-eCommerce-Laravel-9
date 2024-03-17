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
                <div class="w-100 mw-150px">
                    <!--begin::Select2-->
                    <select wire:model="module" class="form-select form-select-solid">
                        <option value="">{{ __('All') }}</option>
                        @foreach ($modulesWeb as $moduleWeb)
                            <option value="{{ $moduleWeb->id }}">{{ $moduleWeb->name }}</option>
                        @endforeach
                    </select>
                    <!--end::Select2-->
                </div>
                @include('admin.gallery.create')
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
                            <th class="min-w-125px">{{ __('Images') }}</th>
                            <th class="min-w-100px">{{ __('Module') }}</th>
                            <th class="min-w-125px">{{ __('Date of creation') }}</th>
                            <th class="min-w-100px">{{ __('Actions') }}</th>
                        </tr>
                        <!--end::Table row-->
                    </thead>
                    <!--end::Table head-->
                    <!--begin::Table body-->
                    <tbody class="text-gray-600 fw-bold">
                        @foreach ($galleries as $gallery)
                        <!--begin::Table row-->
                        <tr>
                            <td>
                                <div class="symbol-group symbol-hover">
                                    @foreach ($gallery->images as $image)
                                    <div class="symbol symbol-circle symbol-50px">
                                        <img loading="lazy" src="{{ $image->imagePreview() }}" alt="{{ $image->name }}"/>
                                    </div>
                                    @endforeach
                                </div>
                            </td>
                            <td>{{ $gallery->moduleWeb ? $gallery->moduleWeb->name : 'N/A' }}</td>
                            <!--begin::Joined-->
                            <td>{{ $gallery->dateToString() }}</td>
                            <!--begin::Joined-->
                            <!--begin::Action=-->
                            <td class="">
                                @include('admin.gallery.edit')
                                @include('admin.gallery.delete')
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
