<style>
    img.btn-whatsapp {
        display: block !important;
        position: fixed;
        z-index: 9999999;
        bottom: 100px;
        right: 20px;
        cursor: pointer;
        border-radius:100px !important;
    }
    img.btn-whatsapp:hover{
        border-radius:100px !important;
        -webkit-box-shadow: 0px 0px 15px 0px rgba(7,94,84,1);
        -moz-box-shadow: 0px 0px 15px 0px rgba(7,94,84,1);
        box-shadow: 0px 0px 50px 14px rgba(7,94,84,1);
        transition-duration: 1s;
    }
</style>

<a href="https://wa.me/{{ config('contact.whatsapp') }}">
    <img class="btn-whatsapp" src="{{ asset('assets/ecommerce/images/contact/whatsapp.webp') }}" width="64" height="64" alt="WhatsApp" >
</a>

<!-- Start of Footer -->
<footer class="footer appear-animate" data-animation-options="{
    'name': 'fadeIn'
}">
    @livewire('ecommerce.subscriber.index')
    <div class="container">
        <div class="footer-top">
            <div class="row">
                <div class="col-lg-4 col-sm-6">
                    <div class="widget widget-about">
                        <a href="{{ route('ecommerce.home.index') }}" class="logo-footer" alt="{{ config('app.name') }}">
                            <img src="{{ asset(config('app.logo_white')) }}" alt="logo-footer" width="144"/>
                        </a>
                        <div class="widget-body">
                            <p class="widget-about-title">{{ __('Have a question? Call us 24/7') }}</p>
                            <a href="tel:{{ config('app.phone') }}" class="widget-about-call">{{ config('app.phone') }}</a>
                            <p class="widget-about-desc">
                                {{ __('Sign up now to receive updates on our products and discount coupons.') }}
                            </p>
                            <div class="social-icons social-icons-colored">
                                @if (config('contact.facebook'))
                                    <a href="{{ config('contact.facebook') }}" target="_blank" class="social-icon social-facebook w-icon-facebook"></a>
                                @endif
                                @if (config('contact.instagram'))
                                    <a href="{{ config('contact.instagram') }}" target="_blank" class="social-icon social-instagram w-icon-instagram"></a>
                                @endif
                                @if (config('contact.twitter'))
                                    <a href="{{ config('contact.twitter') }}" target="_blank" class="social-icon social-twitter w-icon-twitter"></a>
                                @endif
                                @if (config('contact.linkedin'))
                                    <a href="{{ config('contact.linkedin') }}" target="_blank" class="social-icon social-linkedin w-icon-linkedin"></a>
                                @endif
                                @if (config('contact.youtube'))
                                    <a href="{{ config('contact.youtube') }}" target="_blank" class="social-icon social-youtube w-icon-youtube"></a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="widget">
                        <h3 class="widget-title">{{ config('app.name') }}</h3>
                        <ul class="widget-body">
                            <li><a href="{{ route('ecommerce.about.index') }}">{{ __('About us') }}</a></li>
                            <li><a href="{{ route('ecommerce.contact.index') }}">{{ __('Contact us') }}</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="widget">
                        <h4 class="widget-title">{{ __('My account') }}</h4>
                        <ul class="widget-body">
                            <li><a href="{{ route('ecommerce.track-order.index') }}">{{ __('Track My Order') }}</a></li>
                            <li><a href="{{ route('ecommerce.cart.index') }}">{{ __('View Cart') }}</a></li>
                            <li><a href="{{ route('ecommerce.account.dashboard.index') }}">{{ __('My account') }}</a></li>
                            <li><a href="{{ route('ecommerce.track-order.index') }}">{{ __('Track order') }}</a></li>
                            <li><a href="{{ route('ecommerce.wishlist.index') }}">{{ __('My Wishlist') }}</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="widget">
                        <h4 class="widget-title">{{ __('Politics') }}</h4>
                        <ul class="widget-body">
                            <li><a href="#">{{ __('Privacy Policy') }}</a></li>
                            <li><a href="#">{{ __('Shipping policy') }}</a></li>
                            <li><a href="#">{{ __('Terms of service') }}</a></li>
                            <li><a href="#">{{ __('Refund policy') }}</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="footer-left">
                <p class="copyright">Copyright © {{ date('Y') }} {{ config('app.name') }}. {{ __('All Rights Reserved') }}.</p>
            </div>
            <div class="footer-right">
                <span class="payment-label mr-lg-8">{{ __('Secure payments') }}</span>
                <figure class="payment">
                    <img src="{{ asset('assets/ecommerce/images/footer/payment.png') }}" alt="payments" width="159" height="25" />
                </figure>
            </div>
        </div>
    </div>
</footer>
<!-- End of Footer -->
