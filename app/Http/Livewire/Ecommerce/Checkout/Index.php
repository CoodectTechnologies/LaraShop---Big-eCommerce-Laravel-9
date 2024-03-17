<?php

namespace App\Http\Livewire\Ecommerce\Checkout;

use App\Http\Controllers\Ecommerce\Checkout\CheckoutController;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Notifications\User\UserCreate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\ShippingAddress;
use App\Models\BillingAddress;
use App\Models\ShippingPrice;
use App\Models\Shoppingcart;
use App\Models\ShippingZone;
use Illuminate\Support\Str;
use Livewire\Component;
use App\Models\Country;
use App\Models\Product;
use App\Models\Coupon;
use App\Models\Currency;
use App\Models\Order;
use App\Models\State;
use App\Models\User;
use Carbon\Carbon;

class Index extends Component
{
    //Instances model
    public $user = null;
    public $shippingAddress = null;
    public $shippingAddressDiferent = null;
    public $billingAddress = null;
    public $billingAddressDiferent = null;
    public $coupon = null;

    //Shipping address tools
    public $shippingAddressRequire = true;
    public $shippingAddressCountryId = null;
    public $shippingAddressStateId = null;
    //Shipping address data
    public $shippingAddresses = [];
    public $shippingAddressCountries = [];
    public $shippingAddressStates = [];

    //Shipping address diferent tools
    public $shippingAddressDiferentCreate = false;
    public $shippingAddressDiferentCountryId = null;
    public $shippingAddressDiferentStateId = null;
    //Billing address diferent data
    public $shippingAddressDiferentCountries = [];
    public $shippingAddressDiferentStates = [];

    //Shipping methods
    public $shippingZoneId = null;
    public $shippingMethod = null;
    public $shippingZones = [];

    //Billing address tools
    public $billingAddressRequire = false;
    public $billingAddressCreate = false;
    public $billingAddressCountryId = null;
    public $billingAddressStateId = null;
    //Billing address data
    public $billingAddresses = [];
    public $billingAddressCountries = [];
    public $billingAddressStates = [];

    //Billing address diferent tools
    public $billingAddressDiferentCreate = false;
    public $billingAddressDiferentCountryId = null;
    public $billingAddressDiferentStateId = null;
    //Billing address diferent data
    public $billingAddressDiferentCountries = [];
    public $billingAddressDiferentStates = [];

    //Coupon
    public $couponRequire = false;
    public $couponCode = null;
    public $couponPriceDiscount = 0;

    //Tools
    public $shippingApplies = false;
    public $paymentMethod = '';
    public $shippingPrice = 0;
    public $shippingDays = 'N/A';
    public $subtotal = 0;
    public $totalPrice = 0;

    protected function rules(){
        return [
            //Shipping address
            'shippingAddress.state_id' => $this->shippingAddressRequire ? 'required' : 'nullable',
            'shippingAddress.municipality' => $this->shippingAddressRequire ? 'required' : 'nullable',
            'shippingAddress.colony' => $this->shippingAddressRequire ? 'required' : 'nullable',
            'shippingAddress.zip_code' => $this->shippingAddressRequire ? 'required|min:5|max:6' : 'nullable',
            'shippingAddress.street' => $this->shippingAddressRequire ? 'required' : 'nullable',
            'shippingAddress.street_number_int' => $this->shippingAddressRequire ? 'nullable' : 'nullable',
            'shippingAddress.street_number_ext' => $this->shippingAddressRequire ? 'required' : 'nullable',
            'shippingAddress.street_between' => $this->shippingAddressRequire ? 'nullable' : 'nullable',
            'shippingAddress.street_references' => $this->shippingAddressRequire ? 'nullable' : 'nullable',
            'shippingAddress.company' => $this->shippingAddressRequire ? 'nullable' : 'nullable',
            'shippingAddress.name' => $this->shippingAddressRequire ? 'required' : 'nullable',
            'shippingAddress.phone' => $this->shippingAddressRequire ? 'required' : 'nullable',
            'shippingAddress.email' => $this->shippingAddressRequire ? 'required|email|unique:users,email,'.Auth::id() ?? null : 'nullable',
            'shippingAddress.default' => $this->shippingAddressRequire ? 'nullable' : 'nullable',
            //Shipping address diferent
            'shippingAddressDiferent.state_id' => $this->shippingAddressDiferentCreate ? 'required' : 'nullable',
            'shippingAddressDiferent.municipality' => $this->shippingAddressDiferentCreate ? 'required' : 'nullable',
            'shippingAddressDiferent.colony' => $this->shippingAddressDiferentCreate ? 'required' : 'nullable',
            'shippingAddressDiferent.zip_code' => $this->shippingAddressDiferentCreate ? 'required|min:5|max:6' : 'nullable',
            'shippingAddressDiferent.street' => $this->shippingAddressDiferentCreate ? 'required' : 'nullable',
            'shippingAddressDiferent.street_number_int' => $this->shippingAddressDiferentCreate ? 'nullable' : 'nullable',
            'shippingAddressDiferent.street_number_ext' => $this->shippingAddressDiferentCreate ? 'required' : 'nullable',
            'shippingAddressDiferent.street_between' => $this->shippingAddressDiferentCreate ? 'nullable' : 'nullable',
            'shippingAddressDiferent.street_references' => $this->shippingAddressDiferentCreate ? 'nullable' : 'nullable',
            'shippingAddressDiferent.company' => $this->shippingAddressDiferentCreate ? 'nullable' : 'nullable',
            'shippingAddressDiferent.name' => $this->shippingAddressDiferentCreate ? 'required' : 'nullable',
            'shippingAddressDiferent.phone' => $this->shippingAddressDiferentCreate ? 'required' : 'nullable',
            'shippingAddressDiferent.email' => $this->shippingAddressDiferentCreate ? 'required|email|unique:users,email,'.Auth::id() ?? null : 'nullable',
            'shippingAddressDiferent.default' => $this->shippingAddressDiferentCreate ? 'nullable' : 'nullable',
            //Billing address
            'billingAddress.state_id' => ($this->billingAddressCreate || $this->billingAddressRequire) ? 'required' : 'nullable',
            'billingAddress.municipality' => ($this->billingAddressCreate || $this->billingAddressRequire) ? 'required' : 'nullable',
            'billingAddress.colony' => ($this->billingAddressCreate || $this->billingAddressRequire) ? 'required' : 'nullable',
            'billingAddress.zip_code' => ($this->billingAddressCreate || $this->billingAddressRequire) ? 'required|min:5|max:6' : 'nullable',
            'billingAddress.street' => ($this->billingAddressCreate || $this->billingAddressRequire) ? 'required' : 'nullable',
            'billingAddress.street_number_int' => ($this->billingAddressCreate || $this->billingAddressRequire) ? 'nullable' : 'nullable',
            'billingAddress.street_number_ext' => ($this->billingAddressCreate || $this->billingAddressRequire) ? 'required' : 'nullable',
            'billingAddress.street_between' => ($this->billingAddressCreate || $this->billingAddressRequire) ? 'nullable' : 'nullable',
            'billingAddress.street_references' => ($this->billingAddressCreate || $this->billingAddressRequire) ? 'nullable' : 'nullable',
            'billingAddress.company' => ($this->billingAddressCreate || $this->billingAddressRequire) ? 'nullable' : 'nullable',
            'billingAddress.vat' => ($this->billingAddressCreate || $this->billingAddressRequire) ? 'required' : 'nullable',
            'billingAddress.name' => ($this->billingAddressCreate || $this->billingAddressRequire) ? 'required' : 'nullable',
            'billingAddress.phone' => ($this->billingAddressCreate || $this->billingAddressRequire) ? 'required' : 'nullable',
            'billingAddress.email' => ($this->billingAddressCreate || $this->billingAddressRequire) ? 'required': 'nullable',
            'billingAddress.default' => ($this->billingAddressCreate || $this->billingAddressRequire) ? 'nullable' : 'nullable',
            //Billing address diferent
            'billingAddressDiferent.state_id' => $this->billingAddressDiferentCreate ? 'required' : 'nullable',
            'billingAddressDiferent.municipality' => $this->billingAddressDiferentCreate ? 'required' : 'nullable',
            'billingAddressDiferent.colony' => $this->billingAddressDiferentCreate ? 'required' : 'nullable',
            'billingAddressDiferent.zip_code' => $this->billingAddressDiferentCreate ? 'required|min:5|max:6' : 'nullable',
            'billingAddressDiferent.street' => $this->billingAddressDiferentCreate ? 'required' : 'nullable',
            'billingAddressDiferent.street_number_int' => $this->billingAddressDiferentCreate ? 'nullable' : 'nullable',
            'billingAddressDiferent.street_number_ext' => $this->billingAddressDiferentCreate ? 'required' : 'nullable',
            'billingAddressDiferent.street_between' => $this->billingAddressDiferentCreate ? 'nullable' : 'nullable',
            'billingAddressDiferent.street_references' => $this->billingAddressDiferentCreate ? 'nullable' : 'nullable',
            'billingAddressDiferent.company' => $this->billingAddressDiferentCreate ? 'nullable' : 'nullable',
            'billingAddressDiferent.vat' => $this->billingAddressDiferentCreate ? 'required' : 'nullable',
            'billingAddressDiferent.name' => $this->billingAddressDiferentCreate ? 'required' : 'nullable',
            'billingAddressDiferent.phone' => $this->billingAddressDiferentCreate ? 'required' : 'nullable',
            'billingAddressDiferent.email' => $this->billingAddressDiferentCreate ? 'required': 'nullable',
            'billingAddressDiferent.default' => $this->billingAddressDiferentCreate ? 'nullable' : 'nullable',
        ];
    }
    public function mount(){
        //User
        $this->loadUser();
        //Shipping
        $this->loadShippingApplies();
        $this->loadShippingAddress();
        $this->loadShippingAddresses();
        $this->loadShippingAddressCountries();
        $this->loadShippingZones();
        //Shipping diferent
        $this->loadShippingAddressDiferent();
        $this->loadShippingAddressDiferentCountries();
        //Billing
        $this->loadBillingAddress();
        $this->loadBillingAddresses();
        $this->loadBillingAddressCountries();
        //Billing diferent
        $this->loadBillingAddressDiferent();
        $this->loadBillingAddressDiferentCountries();
        //Prices
        $this->loadSubtotal();
        $this->loadTotalPrice();
    }
    public function render(){
        return view('livewire.ecommerce.checkout.index');
    }
    //USER
    private function loadUser(){
        if(Auth::check()):
            $this->user = User::find(Auth::id());
            $this->user->load(['shippingAddresses.state.country', 'billingAddresses.state.country']);
        endif;
    }
    //SAVE USER
    private function saveUser(){
        if(!Auth::check()):
            $password = Str::random(8);
            $passwordHash = Hash::make($password);
            $this->user = User::create([
                'name' => $this->shippingAddress->name,
                'email' => $this->shippingAddress->email,
                'password' => $passwordHash
            ]);
            $this->user->assignRole('Cliente');
            $this->user->notify(new UserCreate($this->user, $password));
            Auth::login($this->user);
        endif;
    }
    //SHIPPING
    private function loadShippingApplies(){
        $allAreDigitales = true;
        foreach (Cart::instance('default')->content() as $item):
            if($item->options->type == Product::TYPE_PHYSICAL):
                $allAreDigitales = false;
                break;
            endif;
        endforeach;
        if(!$allAreDigitales):
            $this->shippingApplies = true;
        endif;
    }
    public function loadShippingAddress($shippingAddressId = null){
        if($shippingAddressId):
            $this->shippingAddress = ShippingAddress::find($shippingAddressId);
            $this->shippingAddressDiferentCreate = false;
            $this->loadShippingZones();
        else:
            if($this->user):
                $this->shippingAddress = $this->user->shippingAddressDefect() ?? new ShippingAddress();
            else:
                $this->shippingAddress = new ShippingAddress();
            endif;
        endif;
        $this->resetDataToShipping();
    }
    public function loadShippingAddresses(){
        if($this->user):
            $this->shippingAddresses = $this->user->shippingAddresses;
        endif;
    }
    public function loadShippingAddressCountries(){
        $country = Country::where('default', true)->first();
        $this->shippingAddressCountryId = $country->id;
        $this->shippingAddressCountries = Country::orderByDesc('name')->where('status', true)->get();
        $this->loadShippingAddressStates($this->shippingAddressCountryId);
    }
    public function loadShippingAddressStates($countryId){
        $this->shippingAddressStates = State::orderByDesc('name')->where('country_id', $countryId)->get();
        $this->resetDataToShipping();
    }
    //SHIPPING DIFERENT
    public function loadShippingAddressDiferent(){
        $this->shippingAddressDiferent = new ShippingAddress();
    }
    public function loadShippingAddressDiferentCountries(){
        $country = Country::where('default', true)->first();
        $this->shippingAddressDiferentCountryId = $country->id;
        $this->shippingAddressDiferentCountries = Country::orderByDesc('name')->where('status', true)->get();
        $this->loadShippingAddressDiferentStates($this->shippingAddressDiferentCountryId);
    }
    public function loadShippingAddressDiferentStates($countryId){
        $this->shippingAddressDiferentStates = State::orderByDesc('name')->where('country_id', $countryId)->get();
        $this->resetDataToShipping();
    }
    //BILLING
    public function loadBillingAddress($billingAddressId = null){
        if($billingAddressId):
            $this->billingAddress = BillingAddress::find($billingAddressId);
            $this->billingAddressDiferentCreate = false;
        else:
            if($this->user):
                $this->billingAddress = $this->user->billingAddressDefect() ?? new BillingAddress();
            else:
                $this->billingAddress = new BillingAddress();
            endif;
        endif;
    }
    public function loadBillingAddresses(){
        if($this->user):
            $this->billingAddresses = $this->user->billingAddresses;
        endif;
    }
    public function loadBillingAddressCountries(){
        $country = Country::where('default', true)->first();
        $this->billingAddressCountryId = $country->id;
        $this->billingAddressCountries = Country::orderByDesc('name')->where('status', true)->get();
        $this->loadBillingAddressStates($this->billingAddressCountryId);
    }
    public function loadBillingAddressStates($countryId){
        $this->billingAddressStates = State::orderByDesc('name')->where('country_id', $countryId)->get();
        $this->resetDataToShipping();
    }
    //BILLING DIFERENT
    public function loadBillingAddressDiferent(){
        $this->billingAddressDiferent = new BillingAddress();
    }
    public function loadBillingAddressDiferentCountries(){
        $country = Country::where('default', true)->first();
        $this->billingAddressDiferentCountryId = $country->id;
        $this->billingAddressDiferentCountries = Country::orderByDesc('name')->where('status', true)->get();
        $this->loadBillingAddressDiferentStates($this->billingAddressDiferentCountryId);
    }
    public function loadBillingAddressDiferentStates($countryId){
        $this->billingAddressDiferentStates = State::orderByDesc('name')->where('country_id', $countryId)->get();
        $this->resetDataToShipping();
    }
    //SHIPPING ZONES
    public function loadShippingZones(){
        $stateId = null;
        $zipCode = null;
        $zipCodeRangeValid = range(5,7);
        if($this->shippingAddress && $this->shippingAddress->state_id && (in_array(strlen($this->shippingAddress->zip_code), $zipCodeRangeValid))):
            $stateId = $this->shippingAddress->state_id;
            $zipCode = $this->shippingAddress->zip_code;
        elseif($this->shippingAddressDiferent && $this->shippingAddressDiferent->state_id && (in_array(strlen($this->shippingAddressDiferent->zip_code), $zipCodeRangeValid))):
            $stateId = $this->shippingAddressDiferent->state_id;
            $zipCode = $this->shippingAddressDiferent->zip_code;
        endif;
        if($stateId && (in_array(strlen($zipCode), $zipCodeRangeValid))):
            $this->shippingZones = ShippingPrice::getShippingMethods($stateId, $zipCode);
        else:
            $this->shippingZones = [];
        endif;
    }
    //SUBTOTALES Y TOTALES
    private function loadSubtotal(){
        $this->subtotal = str_replace(',', '', Cart::instance('default')->subtotal());
    }
    private function loadTotalPrice(){
        if($this->shippingApplies):
            $this->totalPrice = number_format($this->subtotal + $this->shippingPrice - $this->couponPriceDiscount, 2);
        else:
            $this->totalPrice = number_format($this->subtotal - $this->couponPriceDiscount, 2);
        endif;
    }
    //Replicate info shipping addres to billing address
    public function replicateShippingAddressToBillingAddress(){
        if($this->shippingAddressDiferentCreate):
            $shippingAddress = $this->shippingAddressDiferent;
            $this->billingAddressCountryId = $this->shippingAddressDiferentCountryId;
            $this->billingAddress->state_id = $this->shippingAddressDiferent->state_id;
        else:
            $shippingAddress = $this->shippingAddress;
            if($this->shippingAddress->exists):
                $this->billingAddressCountryId = $this->shippingAddress->state->country->id;
                $this->billingAddress->state_id = $this->shippingAddress->state_id;
            else:
                $this->billingAddressCountryId = $this->shippingAddressCountryId;
                $this->billingAddress->state_id = $this->shippingAddress->state_id;
            endif;
        endif;
        $this->billingAddress->municipality = $shippingAddress->municipality;
        $this->billingAddress->colony = $shippingAddress->colony;
        $this->billingAddress->zip_code = $shippingAddress->zip_code;
        $this->billingAddress->street = $shippingAddress->street;
        $this->billingAddress->street_number_int = $shippingAddress->street_number_int;
        $this->billingAddress->street_number_ext = $shippingAddress->street_number_ext;
        $this->billingAddress->street_between = $shippingAddress->street_between;
        $this->billingAddress->street_references = $shippingAddress->street_references;
        $this->billingAddress->company = $shippingAddress->company;
        $this->billingAddress->name = $shippingAddress->name;
        $this->billingAddress->phone = $shippingAddress->phone;
        $this->billingAddress->email = $shippingAddress->email;
    }
    //Apply coupon
    public function applyCoupon(){
        if($this->couponRequire):
            $this->validate(['couponCode' => 'required']);
            $coupon = Coupon::where('code', $this->couponCode)->first();
            if(!$coupon):
                $this->addError('couponCode', __('The coupon does not exist'));
                $this->resetCoupon();
                return false;
            endif;
            if(!$coupon->active):
                $this->addError('couponCode', __('Inactive coupon'));
                $this->resetCoupon();
                return false;
            endif;
            if($coupon->isTimedOut()):
                $this->addError('couponCode', __('Expired coupon'));
                $this->resetCoupon();
                return false;
            endif;
            if($coupon->isExceededLimitOfUse()):
                $this->addError('couponCode', __('Expired coupon'));
                $this->resetCoupon();
                return false;
            endif;
            if($coupon->minimum_expense):
                if($this->subtotal < $coupon->minimum_expense):
                    $this->addError('couponCode', __('Minimum expense').': '.$coupon->minimum_expense);
                    $this->resetCoupon();
                    return false;
                endif;
            endif;
            if($coupon->isExcludePromotion()):
                $this->addError('couponCode', __('This coupon is not applicable with products with promotion'));
                $this->resetCoupon();
                return false;
            endif;
            $this->coupon = $coupon;
            $this->couponPriceDiscount = ($this->subtotal * $this->coupon->percentage) / 100;
            $this->loadTotalPrice();
            session()->flash('alert-coupon', __('Coupon applied'));
            session()->flash('alert-coupon-type', 'success');
        else:
            $this->resetCoupon();
        endif;
    }
    //Create order
    public function createOrder(){
        if(!$this->validateAddressesRequire()): return false; endif;
        if(!$this->validateCart()): return false; endif;
        $this->validate();
        //Billing address
        if(!$this->billingAddressRequire && !$this->billingAddressCreate && !$this->billingAddressDiferentCreate):
            $this->billingAddress = new BillingAddress();
        endif;
        if($this->billingAddressDiferentCreate):
            $this->billingAddress = $this->billingAddressDiferent;
        endif;
        //Shipping address
        if(!$this->shippingAddressRequire && !$this->shippingAddressDiferentCreate):
            $this->shippingAddress = new ShippingAddress();
        endif;
        if($this->shippingAddressDiferentCreate):
            $this->shippingAddress = $this->shippingAddressDiferent;
        endif;
        $this->saveUser();
        if(($this->shippingAddressRequire || $this->shippingAddressDiferentCreate) && $this->shippingAddress && !$this->shippingAddress->exists):
            $this->shippingAddress->user_id = $this->user ? $this->user->id : null;
            $this->shippingAddress->phone = str_replace(' ', '', $this->shippingAddress->phone);
            $this->shippingAddress->default = $this->user ? (count($this->user->shippingAddresses) == 0) : false;
            $this->shippingAddress->save();
        endif;
        if(($this->billingAddressRequire || $this->billingAddressDiferentCreate || $this->billingAddressCreate) && $this->billingAddress && !$this->billingAddress->exists):
            $this->billingAddress->user_id = $this->user ? $this->user->id : null;
            $this->billingAddress->phone = str_replace(' ', '', $this->billingAddress->phone);
            $this->billingAddress->default = $this->user ? (count($this->user->billingAddresses) == 0) : false;
            $this->billingAddress->save();
        endif;
        $currency = Currency::query()->validate()->where('code', Session::get('currency'))->first();
        $order = Order::create([
            'user_id' => $this->user ? $this->user->id : null,
            'shipping_address_id' => $this->shippingAddress->id,
            'billing_address_id' => $this->billingAddress->id,
            'coupon_id' => $this->coupon ? $this->coupon->id : null,
            'number' => CheckoutController::generateOrderNumber(),
            'subtotal' => $this->subtotal,
            'shipping_price' => str_replace(',', '', $this->shippingPrice),
            'shipping_method' => $this->shippingMethod,
            'shipping_days' => $this->shippingDays,
            'coupon_price_discount' => $this->couponPriceDiscount ?? null,
            'coupon_percentage_discount' => $this->coupon ? $this->coupon->percentage : null,
            'total' => str_replace(',', '', $this->totalPrice),
            'currency' => Session::get('currency'),
            'currency_value' => $currency ? $currency->value : 1,
        ]);
        foreach (Cart::instance('default')->content() as $item):
            $order->products()->attach($item->model->id, [
                'product_size_id' => isset($item->options->size['id']) ? $item->options->size['id'] : null,
                'product_color_id' => isset($item->options->color['id']) ? $item->options->color['id'] : null,
                'size' => isset($item->options->size['name']) ? $item->options->size['name'] : null,
                'color' => isset($item->options->color['name']) ? $item->options->color['name'] : null,
                'type' => $item->options->type,
                'quantity' => $item->qty,
                'price' => str_replace(',', '', $item->price),
                'subtotal' => str_replace(',', '', $item->subtotal),
            ]);
        endforeach;
        Cart::instance('default')->destroy();
        if(Auth::check()):
            //Eliminamos el carrito abandonado del usuario, ya que siempre si creo la orden con su carrito
            if($shoppingCart = Shoppingcart::where('identifier', Auth::id())->first()):
                $shoppingCart->delete();
            endif;
        endif;
        Redirect::route('ecommerce.checkout.payment', $order);
    }
    //Validate
    private function validateAddressesRequire(){
        $validateAddressesRequire = true;
        if(!$this->shippingAddressDiferentCreate && !$this->shippingAddress->exists && count($this->shippingAddresses)):
            $this->addError('shippingAddressRequire', __('Select a shipping address'));
            $validateAddressesRequire = false;
        endif;
        if($this->billingAddressRequire && !$this->billingAddress->exists):
            $this->addError('billingAddressRequire', __('Select a billing address'));
            $validateAddressesRequire = false;
        endif;
        return $validateAddressesRequire;
    }
    private function validateCart(){
        $validateCart = true;
        if(!Cart::content('default')->count()):
            $validateCart = false;
        endif;
        return $validateCart;
    }
    /* Toogles show in all addresses */
    public function updatedBillingAddressDiferentCreate(){
        if($this->billingAddressDiferentCreate):
            $this->billingAddress = new BillingAddress();
            $this->billingAddressCreate = false;
            $this->billingAddressRequire = false;
        endif;
    }
    public function updatedBillingAddressCreate(){
        if($this->billingAddressCreate):
            $this->billingAddressDiferent = new BillingAddress();
            $this->billingAddressDiferentCreate = false;
            $this->billingAddressRequire = false;
        endif;
    }
    public function updatedBillingAddressRequire(){
        if($this->billingAddressRequire):
            $this->billingAddressDiferent = new BillingAddress();
            $this->billingAddressDiferentCreate = false;
            $this->billingAddressCreate = false;
        endif;
    }
    public function updatedShippingAddressDiferentCreate(){
        if($this->shippingAddressDiferentCreate):
            $this->shippingAddress = new ShippingAddress();
            $this->shippingAddressRequire = false;
        else:
            $this->shippingAddressRequire = true;
        endif;
        $this->resetDataToShipping();
    }
    public function updatedShippingZoneId($id){
        $shippingZone = ShippingZone::findOrFail($id);
        $this->shippingPrice = ShippingPrice::getShippingPriceByZone($shippingZone);
        $this->shippingMethod = $shippingZone->alias;
        if($shippingZone->shipping_days):
            $days = $shippingZone->shipping_days;
            $estimatedDate = Carbon::parse(today())->addDays($shippingZone->shipping_days)->toFormattedDateString();
            $this->shippingDays = $days.' '.__('days').', '.$estimatedDate;
        endif;
        $this->loadTotalPrice();
    }
    /* Toogle coupon */
    public function toogleCoupon(){
        $this->couponRequire = !$this->couponRequire;
        if(!$this->couponRequire):
            $this->resetCoupon();
        endif;
    }
    //Changes
    public function changeStateShippingAddress(){
        $this->resetDataToShipping();
    }
    public function changeZipCode(){
        $this->resetDataToShipping();
    }
    //Resets
    private function resetDataToShipping(){
        if($this->shippingApplies):
            $this->reset('shippingPrice', 'totalPrice', 'shippingDays', 'shippingZoneId', 'shippingMethod', 'shippingZones');
            $this->loadShippingZones();
        endif;
    }
    private function resetCoupon(){
        $this->coupon = null;
        $this->couponPriceDiscount = 0;
        $this->loadTotalPrice();
    }
}
