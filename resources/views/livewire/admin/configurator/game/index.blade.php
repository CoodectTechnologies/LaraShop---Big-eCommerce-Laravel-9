<div>
    <!--begin::Card-->
    <div class="card">
        <!--begin::Card header-->
        <div class="card-header align-items-center py-5 gap-2 gap-md-5">
            <!--begin::Card title-->
            <div class="card-title">

            </div>
            <!--end::Card title-->
            <!--begin::Card toolbar-->
            <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                @include('admin.configurator.game.create')
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
                        <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                            <th class="">{{ __('Game') }}</th>
                            <th class="">{{ __('Actions') }}</th>
                        </tr>
                        <!--end::Table row-->
                    </thead>
                    <!--end::Table head-->
                    <!--begin::Table body-->
                    <tbody class="text-gray-600 fw-bold">
                        @foreach ($configuratorGames as $configuratorGame)
                            <!--begin::Table row-->
                            <tr>
                                <td class="d-flex align-items-center">
                                    <div class="symbol symbol-circle symbol-100px overflow-hidden me-3">
                                        <a>
                                            <div class="symbol-label">
                                                <img loading="lazy" src="{{ $configuratorGame->imagePreview() }}" alt="{{ $configuratorGame->name }}" class="w-100" />
                                            </div>
                                        </a>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <a class="text-gray-800 text-hover-primary mb-1">{{ $configuratorGame->name }}</a>
                                    </div>
                                </td>
                                <td>
                                    @include('admin.configurator.game.edit')
                                    @include('admin.configurator.game.delete')
                                    <!--end::Action=-->
                                </td>
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
