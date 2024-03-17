<div>
   <!--begin::Order details page-->
   <div class="d-flex flex-column gap-7 gap-lg-10">
        <div wire:ignore class="d-flex flex-wrap flex-stack gap-5 gap-lg-10">
            @include('admin.order.order.partials.show._menu')
        </div>
        <!--begin::Tab content-->
        <div class="tab-content">
            <!--begin::Tab pane-->
            <div wire:ignore.self class="tab-pane fade show active" id="kt_ecommerce_sales_order_general" role="tab-panel">
                @include('admin.order.order.partials.show._general')
            </div>
            <!--end::Tab pane-->
            <!--begin::Tab pane-->
            <div wire:ignore.self class="tab-pane fade" id="kt_ecommerce_sales_order_detail" role="tab-panel">
                @include('admin.order.order.partials.show._detail')
            </div>
            <!--end::Tab pane-->
        </div>
        <!--end::Tab content-->
    </div>
    <!--end::Order details page-->
</div>
