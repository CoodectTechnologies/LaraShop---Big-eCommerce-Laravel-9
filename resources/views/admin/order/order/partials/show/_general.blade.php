<!--begin::Orders-->
<div class="d-flex flex-column gap-7 gap-lg-10">
    <!--begin::Order summary-->
   <div class="d-flex flex-column flex-xl-row gap-7 gap-lg-10">
       <!--begin::Order details-->
       <div class="card card-flush py-4 flex-row-fluid">
           <!--begin::Card header-->
           <div class="card-header">
               <div class="card-title">
                   <h2>{{ __("Number") }} (#{{ $order->number }})</h2>
               </div>
           </div>
           <!--end::Card header-->
           <!--begin::Card body-->
           <div class="card-body pt-0">
               <div class="table-responsive">
                   <!--begin::Table-->
                   <table class="table align-middle table-row-bordered mb-0 fs-6 gy-5 min-w-300px">
                       <!--begin::Table body-->
                       <tbody class="fw-bold text-gray-600">
                           <!--begin::Date-->
                           <tr>
                               <td class="text-muted">
                                   <div class="d-flex align-items-center">
                                   <!--begin::Svg Icon | path: icons/duotune/files/fil002.svg-->
                                   <span class="svg-icon svg-icon-2 me-2">
                                       <svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21" fill="none">
                                           <path opacity="0.3" d="M19 3.40002C18.4 3.40002 18 3.80002 18 4.40002V8.40002H14V4.40002C14 3.80002 13.6 3.40002 13 3.40002C12.4 3.40002 12 3.80002 12 4.40002V8.40002H8V4.40002C8 3.80002 7.6 3.40002 7 3.40002C6.4 3.40002 6 3.80002 6 4.40002V8.40002H2V4.40002C2 3.80002 1.6 3.40002 1 3.40002C0.4 3.40002 0 3.80002 0 4.40002V19.4C0 20 0.4 20.4 1 20.4H19C19.6 20.4 20 20 20 19.4V4.40002C20 3.80002 19.6 3.40002 19 3.40002ZM18 10.4V13.4H14V10.4H18ZM12 10.4V13.4H8V10.4H12ZM12 15.4V18.4H8V15.4H12ZM6 10.4V13.4H2V10.4H6ZM2 15.4H6V18.4H2V15.4ZM14 18.4V15.4H18V18.4H14Z" fill="black" />
                                           <path d="M19 0.400024H1C0.4 0.400024 0 0.800024 0 1.40002V4.40002C0 5.00002 0.4 5.40002 1 5.40002H19C19.6 5.40002 20 5.00002 20 4.40002V1.40002C20 0.800024 19.6 0.400024 19 0.400024Z" fill="black" />
                                       </svg>
                                   </span>
                                   <!--end::Svg Icon-->{{ __("Date") }}</div>
                               </td>
                               <td class="fw-bolder text-end">{{ $order->created_at }}</td>
                           </tr>
                           <!--end::Date-->
                           <!--begin::Payment method-->
                           <tr>
                               <td class="text-muted">
                                   <div class="d-flex align-items-center">
                                   <!--begin::Svg Icon | path: icons/duotune/finance/fin008.svg-->
                                   <span class="svg-icon svg-icon-2 me-2">
                                       <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                           <path opacity="0.3" d="M3.20001 5.91897L16.9 3.01895C17.4 2.91895 18 3.219 18.1 3.819L19.2 9.01895L3.20001 5.91897Z" fill="black" />
                                           <path opacity="0.3" d="M13 13.9189C13 12.2189 14.3 10.9189 16 10.9189H21C21.6 10.9189 22 11.3189 22 11.9189V15.9189C22 16.5189 21.6 16.9189 21 16.9189H16C14.3 16.9189 13 15.6189 13 13.9189ZM16 12.4189C15.2 12.4189 14.5 13.1189 14.5 13.9189C14.5 14.7189 15.2 15.4189 16 15.4189C16.8 15.4189 17.5 14.7189 17.5 13.9189C17.5 13.1189 16.8 12.4189 16 12.4189Z" fill="black" />
                                           <path d="M13 13.9189C13 12.2189 14.3 10.9189 16 10.9189H21V7.91895C21 6.81895 20.1 5.91895 19 5.91895H3C2.4 5.91895 2 6.31895 2 6.91895V20.9189C2 21.5189 2.4 21.9189 3 21.9189H19C20.1 21.9189 21 21.0189 21 19.9189V16.9189H16C14.3 16.9189 13 15.6189 13 13.9189Z" fill="black" />
                                       </svg>
                                   </span>
                                   <!--end::Svg Icon-->{{ __('Payment method') }}</div>
                               </td>
                               <td class="fw-bolder text-end">{{ $order->payment_method }}
                               </td>
                           </tr>
                           <!--end::Payment method-->
                           <!--begin::Date-->
                           <tr>
                               <td class="text-muted">
                                   <div class="d-flex align-items-center">
                                   <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm006.svg-->
                                   <span class="svg-icon svg-icon-2 me-2">
                                       <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                           <path opacity="0.3" d="M3.20001 5.91897L16.9 3.01895C17.4 2.91895 18 3.219 18.1 3.819L19.2 9.01895L3.20001 5.91897Z" fill="black" />
                                           <path opacity="0.3" d="M13 13.9189C13 12.2189 14.3 10.9189 16 10.9189H21C21.6 10.9189 22 11.3189 22 11.9189V15.9189C22 16.5189 21.6 16.9189 21 16.9189H16C14.3 16.9189 13 15.6189 13 13.9189ZM16 12.4189C15.2 12.4189 14.5 13.1189 14.5 13.9189C14.5 14.7189 15.2 15.4189 16 15.4189C16.8 15.4189 17.5 14.7189 17.5 13.9189C17.5 13.1189 16.8 12.4189 16 12.4189Z" fill="black" />
                                           <path d="M13 13.9189C13 12.2189 14.3 10.9189 16 10.9189H21V7.91895C21 6.81895 20.1 5.91895 19 5.91895H3C2.4 5.91895 2 6.31895 2 6.91895V20.9189C2 21.5189 2.4 21.9189 3 21.9189H19C20.1 21.9189 21 21.0189 21 19.9189V16.9189H16C14.3 16.9189 13 15.6189 13 13.9189Z" fill="black" />
                                       </svg>
                                   </span>
                                   <!--end::Svg Icon-->{{ __('Payment status') }}</div>
                               </td>
                               <td class="fw-bolder text-end">{!! $order->paymentStatusToString() !!}</td>
                           </tr>
                           <!--end::Date-->
                           <tr>
                               <td class="text-muted">
                                   <div class="d-flex align-items-center">
                                   <!--begin::Svg Icon | path: assets/media/icons/duotune/communication/com009.svg-->
                                   <span class="svg-icon svg-icon-2 me-2"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                       <path opacity="0.3" d="M5.78001 21.115L3.28001 21.949C3.10897 22.0059 2.92548 22.0141 2.75004 21.9727C2.57461 21.9312 2.41416 21.8418 2.28669 21.7144C2.15923 21.5869 2.06975 21.4264 2.0283 21.251C1.98685 21.0755 1.99507 20.892 2.05201 20.7209L2.886 18.2209L7.22801 13.879L10.128 16.774L5.78001 21.115Z" fill="currentColor"/>
                                       <path d="M21.7 8.08899L15.911 2.30005C15.8161 2.2049 15.7033 2.12939 15.5792 2.07788C15.455 2.02637 15.3219 1.99988 15.1875 1.99988C15.0531 1.99988 14.92 2.02637 14.7958 2.07788C14.6717 2.12939 14.5589 2.2049 14.464 2.30005L13.74 3.02295C13.548 3.21498 13.4402 3.4754 13.4402 3.74695C13.4402 4.01849 13.548 4.27892 13.74 4.47095L14.464 5.19397L11.303 8.35498C10.1615 7.80702 8.87825 7.62639 7.62985 7.83789C6.38145 8.04939 5.2293 8.64265 4.332 9.53601C4.14026 9.72817 4.03256 9.98855 4.03256 10.26C4.03256 10.5315 4.14026 10.7918 4.332 10.984L13.016 19.667C13.208 19.859 13.4684 19.9668 13.74 19.9668C14.0115 19.9668 14.272 19.859 14.464 19.667C15.3575 18.77 15.9509 17.618 16.1624 16.3698C16.374 15.1215 16.1932 13.8383 15.645 12.697L18.806 9.53601L19.529 10.26C19.721 10.452 19.9814 10.5598 20.253 10.5598C20.5245 10.5598 20.785 10.452 20.977 10.26L21.7 9.53601C21.7952 9.44108 21.8706 9.32825 21.9221 9.2041C21.9737 9.07995 22.0002 8.94691 22.0002 8.8125C22.0002 8.67809 21.9737 8.54505 21.9221 8.4209C21.8706 8.29675 21.7952 8.18392 21.7 8.08899Z" fill="currentColor"/>
                                       </svg>
                                   </span>
                                   <!--end::Svg Icon-->
                                   <!--end::Svg Icon-->{{ __('Status') }}</div>
                               </td>
                               <td class="fw-bolder text-end">{!! $order->statusToString() !!}</td>
                           </tr>
                       </tbody>
                       <!--end::Table body-->
                   </table>
                   <!--end::Table-->
               </div>
           </div>
           <!--end::Card body-->
       </div>
       <!--end::Order details-->
       <!--begin::Customer details-->
       <div class="card card-flush py-4 flex-row-fluid">
           <!--begin::Card header-->
           <div class="card-header">
               <div class="card-title">
                   <h2>{{ __('Client') }}</h2>
               </div>
           </div>
           <!--end::Card header-->
           <!--begin::Card body-->
           <div class="card-body pt-0">
               <div class="table-responsive">
                   <!--begin::Table-->
                   <table class="table align-middle table-row-bordered mb-0 fs-6 gy-5 min-w-300px">
                       <!--begin::Table body-->
                       <tbody class="fw-bold text-gray-600">
                            <!--begin::Customer name-->
                            <tr>
                                <td class="text-muted">
                                    <div class="d-flex align-items-center">
                                    <!--begin::Svg Icon | path: icons/duotune/communication/com006.svg-->
                                    <span class="svg-icon svg-icon-2 me-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <path opacity="0.3" d="M22 12C22 17.5 17.5 22 12 22C6.5 22 2 17.5 2 12C2 6.5 6.5 2 12 2C17.5 2 22 6.5 22 12ZM12 7C10.3 7 9 8.3 9 10C9 11.7 10.3 13 12 13C13.7 13 15 11.7 15 10C15 8.3 13.7 7 12 7Z" fill="black" />
                                            <path d="M12 22C14.6 22 17 21 18.7 19.4C17.9 16.9 15.2 15 12 15C8.8 15 6.09999 16.9 5.29999 19.4C6.99999 21 9.4 22 12 22Z" fill="black" />
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->{{ __('User') }}</div>
                                </td>
                                <td class="fw-bolder text-end">
                                    <div class="d-flex align-items-center justify-content-end">
                                        @if ($order->user)
                                            <!--begin:: Avatar -->
                                            <div class="symbol symbol-circle symbol-25px overflow-hidden me-3">
                                                <a href="{{ route('admin.user.show', $order->user) }}">
                                                    <div class="symbol-label">
                                                        <img loading="lazy" src="{{ $order->user->imagePreview() }}" alt="{{ $order->user->name }}" class="w-100" />
                                                    </div>
                                                </a>
                                            </div>
                                            <!--end::Avatar-->
                                            <!--begin::Name-->
                                            <a href="{{ route('admin.user.show', $order->user) }}" class="text-gray-600 text-hover-primary">{{ $order->user->name }}</a>
                                            <!--end::Name-->
                                        @else
                                            @if ($order->shippingAddress)
                                                <!--begin:: Avatar -->
                                                    <div class="symbol symbol-circle symbol-25px overflow-hidden me-3">
                                                        <div class="symbol-label">
                                                            <img loading="lazy" src="{{ asset('assets/admin/media/avatars/blank.png') }}" alt="{{ $order->shippingAddress->name }}" class="w-100" />
                                                        </div>
                                                    </div>
                                                    <!--end::Avatar-->
                                                    <!--begin::Name-->
                                                    <a class="text-gray-600 text-hover-primary">{{ $order->shippingAddress->name }}</a>
                                                    <!--end::Name-->
                                            @endif
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            <!--end::Customer name-->
                            @if ($order->shippingAddress)
                                <!--begin::Customer email-->
                                <tr>
                                    <td class="text-muted">
                                        <div class="d-flex align-items-center">
                                        <!--begin::Svg Icon | path: icons/duotune/communication/com011.svg-->
                                        <span class="svg-icon svg-icon-2 me-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <path opacity="0.3" d="M21 19H3C2.4 19 2 18.6 2 18V6C2 5.4 2.4 5 3 5H21C21.6 5 22 5.4 22 6V18C22 18.6 21.6 19 21 19Z" fill="black" />
                                                <path d="M21 5H2.99999C2.69999 5 2.49999 5.10005 2.29999 5.30005L11.2 13.3C11.7 13.7 12.4 13.7 12.8 13.3L21.7 5.30005C21.5 5.10005 21.3 5 21 5Z" fill="black" />
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->{{ __('Email') }}</div>
                                    </td>
                                    <td class="fw-bolder text-end">
                                        <a href="mailto:{{ $order->shippingAddress->email }}" class="text-gray-600 text-hover-primary">{{ $order->shippingAddress->email }}</a>
                                    </td>
                                </tr>
                                <!--end::Payment method-->
                                <!--begin::Date-->
                                <tr>
                                    <td class="text-muted">
                                        <div class="d-flex align-items-center">
                                        <!--begin::Svg Icon | path: icons/duotune/electronics/elc003.svg-->
                                        <span class="svg-icon svg-icon-2 me-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <path d="M5 20H19V21C19 21.6 18.6 22 18 22H6C5.4 22 5 21.6 5 21V20ZM19 3C19 2.4 18.6 2 18 2H6C5.4 2 5 2.4 5 3V4H19V3Z" fill="black" />
                                                <path opacity="0.3" d="M19 4H5V20H19V4Z" fill="black" />
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->{{ __('Phone') }}</div>
                                    </td>
                                    <td class="fw-bolder text-end"><a href="tel:{{ $order->shippingAddress->phone }}">{{ $order->shippingAddress->phone }}</a></td>
                                </tr>
                                <!--end::Date-->
                                <!--begin::Date-->
                                <tr>
                                    <td class="text-muted">
                                        <div class="d-flex align-items-center">
                                            <span class="svg-icon svg-icon-2 me-2">
                                                <i class="fab fa-whatsapp fa-1x"></i>
                                            </span>
                                            WhatsApp
                                        </div>
                                    </td>
                                    <td class="fw-bolder text-end"><a href="https://wa.me/+52{{ $order->shippingAddress->phone }}">https://wa.me/+52{{ $order->shippingAddress->phone }}</a></td>
                                </tr>
                                <!--end::Date-->
                            @endif
                       </tbody>
                       <!--end::Table body-->
                   </table>
                   <!--end::Table-->
               </div>
           </div>
           <!--end::Card body-->
       </div>
   </div>
   <!--end::Order summary-->
   <div class="d-flex flex-column flex-xl-row gap-7 gap-lg-10">
       <!--end::Customer details-->
       <!--begin::Payment address-->
       <div class="card card-flush py-4 flex-row-fluid overflow-hidden">
           <!--begin::Background-->
           <div class="position-absolute top-0 end-0 opacity-10 pe-none text-end">
               <img loading="lazy" src="assets/media/icons/duotune/ecommerce/ecm001.svg" class="w-175px" />
           </div>
           <!--end::Background-->
           <!--begin::Card header-->
           <div class="card-header">
               <div class="card-title">
                   <h2>{{ __('Billing Address') }}</h2>
               </div>
           </div>
           <!--end::Card header-->
           <!--begin::Card body-->
           <div class="card-body pt-0">
               @if ($order->billingAddress)
                   <strong>{{ __('Country') }}:</strong> {{ $order->billingAddress->state->country->name }},
                   <strong>{{ __('EIN') }}:</strong> {{ $order->billingAddress->vat }},
                   <strong>{{ __('State') }}:</strong> {{ $order->billingAddress->state->name }}, <br>
                   <strong>{{ __('Municipality') }}:</strong> {{ $order->billingAddress->municipality }},
                   <strong>{{ __('Colony') }}:</strong> {{ $order->billingAddress->colony }}, <br>
                   <strong>{{ __('Zip code') }}:</strong> {{ $order->billingAddress->zip_code }},
                   <strong>{{ __('Street') }}:</strong> {{ $order->billingAddress->street }}, <br>
                   <strong>{{ __('Number int') }}:</strong> {{ $order->billingAddress->street_number_int }},
                   <strong>{{ __('Number ext') }}:</strong> {{ $order->billingAddress->street_number_ext }}, <br>
                   <strong>{{ __('Between streets') }}:</strong> {{ $order->billingAddress->street_between }},
                   <strong>{{ __('Street references') }}:</strong> {{ $order->billingAddress->street_references }}, <br>
                   <strong>{{ __('Company name') }}:</strong> {{ $order->billingAddress->company }},
                   <strong>{{ __('To name') }}:</strong> {{ $order->billingAddress->name }}, <br>
                   <strong>{{ __('Phone') }}:</strong> {{ $order->billingAddress->phone }},
                   <strong>{{ __('Email') }}:</strong> {{ $order->billingAddress->email }}
               @else
                   {{ __('No information') }}
               @endif

           </div>
           <!--end::Card body-->
       </div>
       <!--end::Payment address-->
       <!--begin::Shipping address-->
       <div class="card card-flush py-4 flex-row-fluid overflow-hidden">
           <!--begin::Background-->
           <div class="position-absolute top-0 end-0 opacity-10 pe-none text-end">
               <img loading="lazy" src="{{ asset('assets/admin/media/icons/duotune/ecommerce/ecm006.svg') }}" class="w-175px" />
           </div>
           <!--end::Background-->
           <!--begin::Card header-->
           <div class="card-header">
               <div class="card-title">
                   <h2>{{ __('Shipping address') }}</h2>
               </div>
           </div>
           <!--end::Card header-->
           <!--begin::Card body-->
           <div class="card-body pt-0">
                @if ($order->shippingAddress)
                    <strong>{{ __('Country') }}:</strong> {{ $order->shippingAddress->state->country->name }},
                    <strong>{{ __('State') }}:</strong> {{ $order->shippingAddress->state->name }}, <br>
                    <strong>{{ __('Municipality') }}:</strong> {{ $order->shippingAddress->municipality }},
                    <strong>{{ __('Colony') }}:</strong> {{ $order->shippingAddress->colony }}, <br>
                    <strong>{{ __('Zip code') }}:</strong> {{ $order->shippingAddress->zip_code }},
                    <strong>{{ __('Street') }}:</strong> {{ $order->shippingAddress->street }}, <br>
                    <strong>{{ __('Number int') }}:</strong> {{ $order->shippingAddress->street_number_int }},
                    <strong>{{ __('Number ext') }}:</strong> {{ $order->shippingAddress->street_number_ext }}, <br>
                    <strong>{{ __('Between streets') }}:</strong> {{ $order->shippingAddress->street_between }},
                    <strong>{{ __('Street references') }}:</strong> {{ $order->shippingAddress->street_references }}, <br>
                    <strong>{{ __('Company name') }}:</strong> {{ $order->shippingAddress->company }},
                    <strong>{{ __('To name') }}:</strong> {{ $order->shippingAddress->name }}, <br>
                    <strong>{{ __('Phone') }}:</strong> {{ $order->shippingAddress->phone }},
                    <strong>{{ __('Email') }}:</strong> {{ $order->shippingAddress->email }}
                @else
                        {{ __('No information') }}
                @endif
           </div>
           <!--end::Card body-->
       </div>
       <!--end::Shipping address-->
   </div>
   <!--begin::Product List-->
   <div class="card card-flush py-4 flex-row-fluid overflow-hidden">
       <!--begin::Card header-->
       <div class="card-header">
           <div class="card-title">
               <h2>{{ __('Order') }} #{{ $order->number }}</h2>
           </div>
           <div class="d-flex justify-content-end">
               <button onclick="window.print()" class="btn btn-light-primary ">{{ __('Print') }}</button>
           </div>

       </div>
       <!--end::Card header-->
       <!--begin::Card body-->
       <div class="card-body pt-0">
           <div class="table-responsive">
               <!--begin::Table-->
               <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0">
                   <!--begin::Table head-->
                   <thead>
                       <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                           <th class="min-w-175px">{{ __('Product') }}</th>
                           <th class="min-w-100px text-end">{{ __('SKU') }}</th>
                           <th class="min-w-70px text-end">{{ __('Quantity') }}</th>
                           <th class="min-w-100px text-end">{{ __('Price') }}</th>
                           <th class="min-w-100px text-end">{{ __('Total') }}</th>
                       </tr>
                   </thead>
                   <!--end::Table head-->
                   <!--begin::Table body-->
                   <tbody class="fw-bold text-gray-600">
                       @foreach ($order->products as $product)
                           <!--begin::Products-->
                           <tr>
                               <!--begin::Product-->
                               <td>
                                   <div class="d-flex align-items-center">
                                       <!--begin::Thumbnail-->
                                       <a href="{{ route('admin.catalog.product.show', $product) }}" class="symbol symbol-50px">
                                            @if ($product->pivot->product_color_id)
                                                @php
                                                    $productColor = $product->productColors()->where('id', $product->pivot->product_color_id)->first();
                                                    if(!$productColor):
                                                        $productColor = $product;
                                                    endif;
                                                @endphp
                                                <span class="symbol-label" style="background-image:url({{ $productColor->imagePreview() }});"></span>
                                            @else
                                                <span class="symbol-label" style="background-image:url({{ $product->imagePreview() }});"></span>
                                            @endif
                                       </a>
                                       <!--end::Thumbnail-->
                                       <div class="ms-5">
                                           <a href="{{ route('admin.catalog.product.show', $product) }}" class="fw-bolder text-gray-600 text-hover-primary">{{ $product->name }}</a>
                                           @if ($product->pivot->color)
                                               <div class="fs-7 text-muted">{{ __('Color') }}: {{ $product->pivot->color }}</div>
                                           @endif
                                           @if ($product->pivot->size)
                                               <div class="fs-7 text-muted">{{ __('Size') }}: {{ $product->pivot->size }}</div>
                                           @endif
                                           @if ($product->pivot->type)
                                               <div class="fs-7 text-muted">{{ __('Type') }}: {{ $product->pivot->type }}</div>
                                           @endif
                                       </div>
                                   </div>
                               </td>
                               <!--end::Product-->
                               <!--begin::SKU-->
                               <td class="text-end">{{ $product->sku }}</td>
                               <!--end::SKU-->
                               <!--begin::Quantity-->
                               <td class="text-end">{{ $product->pivot->quantity }}</td>
                               <!--end::Quantity-->
                               <!--begin::Price-->
                               <td class="text-end">${{ number_format($product->pivot->price, 2) }}</td>
                               <!--end::Price-->
                               <!--begin::Total-->
                               <td class="text-end">${{ number_format($product->pivot->subtotal, 2) }}</td>
                               <!--end::Total-->
                           </tr>
                           <!--end::Products-->
                       @endforeach
                       <!--begin::Subtotal-->
                       <tr>
                           <td colspan="4" class="text-end">{{ __('Subtotal') }}</td>
                           <td class="text-end">{{ $order->subtotalToString() }}</td>
                       </tr>
                       <!--end::Subtotal-->
                       @if ($order->coupon)
                            <!--begin::Shipping-->
                           <tr>
                               <td colspan="4" class="text-end">{{ __('Coupon') }}</td>
                               <td class="text-end">-{{ $order->coupon_percentage_discount }}%</td>
                           </tr>
                           <!--end::Shipping-->
                       @endif
                       <!--begin::Shipping-->
                       <tr>
                           <td colspan="4" class="text-end">{{ __('Shipping price') }}</td>
                           <td class="text-end">{{ $order->shippingPriceToString() }}</td>
                       </tr>
                       <!--end::Shipping-->
                       <!--begin::Shipping-->
                       <tr>
                           <td colspan="4" class="text-end">{{ __('Shipping days') }}</td>
                           <td class="text-end">{{ $order->shipping_days }}</td>
                       </tr>
                       <!--end::Shipping-->
                       <!--begin::Shipping-->
                       <tr>
                           <td colspan="4" class="text-end">{{ __('Shipping method') }}</td>
                           <td class="text-end">{{ $order->shipping_method }}</td>
                       </tr>
                       <!--end::Shipping-->
                       <!--begin::Grand total-->
                       <tr>
                           <td colspan="4" class="fs-3 text-dark text-end">{{ __('Total') }}</td>
                           <td class="text-dark fs-3 fw-boldest text-end">{{ $order->totalToString() }}</td>
                       </tr>
                       <!--end::Grand total-->
                   </tbody>
                   <!--end::Table head-->
               </table>
               <!--end::Table-->
           </div>
       </div>
       <!--end::Card body-->
   </div>
   <!--end::Product List-->
</div>
<!--end::Orders-->
