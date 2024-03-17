<!--begin::Card header-->
<div class="card-header cursor-pointer">
    <!--begin::Card title-->
    <div class="card-title m-0">
        <h3 class="fw-bolder m-0">{{ __('Statistical data') }}</h3>
    </div>
    <!--end::Card title-->
</div>
<!--begin::Card header-->
<!--begin::Card body-->
<div class="card-body p-9">
    <!--end::Input group-->
    <div class="" style="height: 32rem;">
        <livewire:livewire-line-chart :line-chart-model="$lineChartModel" />
    </div>
</div>
