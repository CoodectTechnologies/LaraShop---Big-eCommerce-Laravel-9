@component('mail::message')

@component('mail::panel')
{{ __('Dear') }} {{ $order->shippingAddress->name }},
@endcomponent

<p>{{ __('We have received your purchase request on :appname. Below we provide you with the details of your purchase:', ['appname' => config('app.name')]) }}</p>

<p>• {{ __('Order number') }}: {{ $order->number }}</p>
<p>• {{ __('Date') }}: {{ $order->created_at }}</p>
<p>• {{ __('Total') }}: {{ $order->totalToString() }}</p>

<p>{{ __('To complete the payment process, we remind you that you have selected the transfer or bank deposit option as the payment method. Below you will find the details of our bank account to make the transfer:') }}</p>

@component('mail::panel')
<p>{{ __('Bank') }}: {{ config('services.transfer.bank') }}</p>
<p>{{ __('Bank account') }}: {{ config('services.transfer.account_bank') }}</p>
<p>{{ __('Card') }}: {{ config('services.transfer.target') }}</p>
<p>{{ __('To name') }}: {{ config('services.transfer.name') }}</p>
<p>{{ __('Concept') }}: {{ $order->number }}</p>
@endcomponent

<p>{{ __('Please use this information to make the transfer within the specified time frame. Once we have confirmed receipt of your payment, we will proceed to prepare your order and notify you when it has been shipped.') }}</p>

<p>{{ __('Thank you for choosing :appname and trusting us', ['appname' => config('app.name')]) }}</p>

@component('mail::button', ['url' => 'https://wa.me/'.config('contact.whatsapp')])
{{ __('Send proof by WhatsApp') }}
@endcomponent

@component('mail::button', ['url' => 'mailto:'.config('contact.email')])
{{ __('Send proof by mail') }}
@endcomponent

{{ config('app.name') }}
@endcomponent
