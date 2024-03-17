<div>
    @if ($popup->active)
        @push('footer')
            <script>
                // Newsletter popup
                if (Coodect.getCookie('hideNewsletterPopup') !== 'true') {
                    setTimeout(function () {
                        Coodect.popup({
                            items: {
                                src: "{{ route('ecommerce.popup.index') }}"
                            },
                            type: 'ajax',
                            tLoading: '',
                            mainClass: 'mfp-newsletter mfp-fadein-popup',
                            callbacks: {
                                beforeClose: function () {
                                    // if "do not show" is checked
                                    $('#hide-newsletter-popup')[0].checked && Coodect.setCookie('hideNewsletterPopup', true, 7);
                                }
                            },
                        });
                    }, 3000);
                }
            </script>
        @endpush
    @endif
</div>
