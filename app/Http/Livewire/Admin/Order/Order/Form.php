<?php

namespace App\Http\Livewire\Admin\Order\Order;

use App\Http\Controllers\Ecommerce\Cart\CartController;
use App\Http\Controllers\Ecommerce\Checkout\CheckoutController;
use App\Models\BillingAddress;
use App\Models\Coupon;
use App\Models\Currency;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductSize;
use App\Models\ShippingAddress;
use App\Models\ShippingPrice;
use App\Models\ShippingZone;
use App\Models\User;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Livewire\WithPagination;

class Form extends Component
{
    use WithPagination;

    protected $listeners = ['eventShippingAddressCreate', 'eventBillingAddressCreate'];
    protected $paginationTheme = 'bootstrap';
    protected $queryString = ['search' => ['except' => ''], 'searchUser' => ['except' => '']];
    private $perPage = 12;

    //Filters
    public $search;
    public $searchUser;

    //Main
    public $order;
    public $method;

    //Totals
    public $total = 0;
    public $subtotal = 0;
    public $shippingPrice = 0;

    //Cart
    public $cart = [];

    //Products
    public $productSizeSelected = [];
    public $productColorSelected = [];
    public $productTypeSelected = [];
    public $productQuantitySelected = [];
    public $productSizes = [];
    public $productColors = [];
    public $productPrices = [];
    public $productQuantities = [];
    public $productTypes = [];

    //Users
    public $user = null;
    public $userId = null;

    //Address
    public $shippingAddress = [];
    public $shippingAddresses = [];
    public $billingAddress = [];
    public $billingAddresses = [];
    public $shippingZoneId = null;
    public $shippingZone = [];
    public $shippingZones = [];
    public $shippingApplies = false;

    //Coupon
    public $coupon = null;
    public $couponCode = null;
    public $couponPriceDiscount = 0;

    protected function rules(){
        return [
            'order.user_id' => 'nullable',
            'order.shipping_address_id' => 'required',
            'order.billing_address_id' => 'nullable',
            'order.coupon_id' => 'nullable',
            'order.number' => 'nullable',
            'order.shipping_price' => 'nullable',
            'order.shipping_method' => 'nullable',
            'order.shipping_days' => 'nullable',
            'order.coupon_price_discount' => 'nullable',
            'order.coupon_percentage_discount' => 'nullable',
            'order.subtotal' => 'required',
            'order.total' => 'required',
            'order.payment_method' => 'required',
            'order.payment_id' => 'nullable',
            'order.payment_data' => 'nullable',
            'order.payment_status' => 'nullable',
            'order.status' => 'nullable',
        ];
    }
    public function mount(Order $order, $method){
        $this->order = $order;
        $this->method = $method;
        $this->loadShippingApplies();
        $this->loadTotal();
    }
    public function render(){
        $products = $this->getProducts();
        $users = $this->getUsers();
        $this->productTools($products);
        return view('livewire.admin.order.order.form', compact('products', 'users'));
    }
    public function store(){
        $currency = Currency::getCurrencyByCode(Session::get('currency'));
        $this->order->user_id = $this->user ? $this->user->id : null;
        $this->order->shipping_address_id = $this->shippingAddress['id'];
        $this->order->billing_address_id = count($this->billingAddress) ? $this->billingAddress['id'] : null;
        $this->order->shipping_method = count($this->shippingZone) ? $this->shippingZone['name'] : null;
        $this->order->shipping_days = count($this->shippingZone) ? $this->shippingZone['days'].__('days').', '.$this->shippingZone['estimatedDate'] : null;
        $this->order->shipping_price = $this->shippingPrice;
        $this->order->subtotal = $this->subtotal;
        $this->order->total = $this->total;
        $this->order->payment_status = Order::PAYMENT_STATUS_PENDING;
        $this->order->status = Order::STATUS_CONFIRMED;
        $this->order->currency = $currency->code;
        $this->order->currency_value = $currency->value;
        $this->order->coupon_id = $this->coupon ? $this->coupon->id : null;
        $this->order->coupon_price_discount = $this->coupon ? $this->couponPriceDiscount : null;
        $this->order->coupon_percentage_discount = $this->coupon ? $this->coupon->percentage : null;
        $this->validate();
        $this->order->number = CheckoutController::generateOrderNumber();
        $this->order->save();
        foreach (Cart::instance('default')->content() as $item):
            $this->order->products()->attach($item->model->id, [
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
        CheckoutController::processOrder($this->order);
        Cart::instance('default')->destroy();
        Session::flash('alert', __('Registration successfully added'));
        Session::flash('alert-type', 'success');
        Redirect::route('admin.order.show', $this->order);
    }
    private function getProducts(){
        $products = Product::withRelations()->validateProduct();
        $products = $this->filters($products);
        $products = $products->paginate($this->perPage);
        return $products;
    }
    private function getUsers(){
        $users = User::role('Cliente')->get();
        return $users;
    }
    private function productTools($products){
        foreach($products as $product):
            $this->loadProductColor($product->id);
            $this->loadProductSize($product->id);
            $this->loadProductPrice($product->id);
            $this->loadProductQuantity($product->id);
            $this->loadProductType($product->id);
        endforeach;
    }
    public function addProduct($productId){
        $product = Product::where('id', $productId)->first();
        $quantity = isset($this->productQuantitySelected[$productId]) ? $this->productQuantitySelected[$productId] : 1;
        $price = $this->productPrices[$productId]['price'];
        $options = [
            'size' => [
                'id' => isset($this->productSizeSelected[$productId]) ? $this->productSizeSelected[$productId]['id'] : null,
                'name' => isset($this->productSizeSelected[$productId]) ? $this->productSizeSelected[$productId]['name'] : null,
            ],
            'color' => [
                'id' => isset($this->productColorSelected[$productId]) ? $this->productColorSelected[$productId]['id'] : null,
                'name' => isset($this->productColorSelected[$productId]) ? $this->productColorSelected[$productId]['name'] : null,
            ],
            'image' => $product->imagePreview(),
            'price' => $this->productPrices[$productId]['price'],
            'type' => $this->productTypeSelected[$productId],
        ];
        CartController::store($product, $quantity, $price, $options);
        $this->emit('alert', Session::get('alert-type'), Session::get('alert'));
        $this->loadShippingApplies();
        $this->loadShippingZones();
        $this->loadTotal();
    }
    public function deleteCart($rowId = null){
        CartController::destroy($rowId);
        $this->loadShippingApplies();
        $this->loadShippingZones();
        $this->loadTotal();
    }
    //PRODUCTS
    public function loadProductSize($productId, $productSizeId = null){
        if(!$productSizeId):
            $product = Product::with('productSizes')->where('id', $productId)->first();
            if(count($product->productSizes)):
                $this->productSizes[$productId] = $product->productSizes;
            endif;
        else:
            if(isset($this->productTypeSelected[$productId]) && $this->productTypeSelected[$productId] == Product::TYPE_PHYSICAL):
                $productSizeSelected = ProductSize::with('productColors')->findOrFail($productSizeId);
                $this->productSizeSelected[$productId] = [
                    'id' => $productSizeId,
                    'name' => $productSizeSelected->name,
                    'price' => $productSizeSelected->getPriceFinal(),
                    'priceToString' => $productSizeSelected->getPriceToString(),
                    'relation_with_colors' => $productSizeSelected->relation_with_colors,
                    'quantity' => $productSizeSelected->quantity,
                ];
                if(isset($this->productColorSelected[$productId])):
                    if(!$productSizeSelected->validateSizeColorSelected($this->productColorSelected[$productId]['id'])):
                        unset($this->productColorSelected[$productId]);
                    endif;
                endif;
                $this->loadProductPrice($productId);
                $this->loadProductQuantity($productId);
            endif;
        endif;
    }
    public function loadProductColor($productId, $productColorId = null){
        if(!$productColorId):
            $product = Product::with('productColors')->where('id', $productId)->first();
            if(count($product->productColors)):
                $this->productColors[$productId] = $product->productColors;
            endif;
        else:
            if(isset($this->productTypeSelected[$productId]) && $this->productTypeSelected[$productId] == Product::TYPE_PHYSICAL):
                $productColorSelected = ProductColor::with('productSizes')->findOrFail($productColorId);
                $this->productColorSelected[$productId] = [
                    'id' => $productColorId,
                    'name' => $productColorSelected->name,
                    'hexadecimal' => $productColorSelected->hexadecimal,
                    'relation_with_sizes' => $productColorSelected->relation_with_colors,
                    'quantity' => $productColorSelected->quantity,
                ];
                $this->loadProductPrice($productId);
                $this->loadProductQuantity($productId);
            endif;
        endif;
    }
    public function loadProductType($productId, $type = null){
        if(!$type):
            $product = Product::where('id', $productId)->first();
            if($product->getIsDigital()):
                $this->productTypes[$productId][Product::TYPE_DIGITAL] = Product::TYPE_DIGITAL;
            endif;
            if($product->getIsPhysical()):
                $this->productTypes[$productId][Product::TYPE_PHYSICAL] = Product::TYPE_PHYSICAL;
            endif;
        else:
            $this->productTypeSelected[$productId] = $type;
            if($type == Product::TYPE_DIGITAL && isset($this->productSizeSelected[$productId])):
                unset($this->productSizeSelected[$productId]);
            endif;
            if($type == Product::TYPE_DIGITAL && isset($this->productColorSelected[$productId])):
                unset($this->productColorSelected[$productId]);
            endif;
            $this->loadProductPrice($productId);
            $this->loadProductQuantity($productId);
        endif;
    }
    private function loadProductPrice($productId){
        if(isset($this->productSizeSelected[$productId]) && (isset($this->productTypeSelected[$productId]) && $this->productTypeSelected[$productId] == Product::TYPE_PHYSICAL)):
            //Obtenemos el precio de la medida del producto
            $this->productPrices[$productId]['priceToString'] = $this->productSizeSelected[$productId]['priceToString'];
            $this->productPrices[$productId]['price'] = $this->productSizeSelected[$productId]['price'];

        elseif(isset($this->productTypeSelected[$productId]) && $this->productTypeSelected[$productId] == Product::TYPE_DIGITAL):
            //Si es tipo digital, entonces tomamos el precio del producto general
            $product = Product::where('id', $productId)->first();
            $priceFinal = $product->getPriceFinal();
            $this->productPrices[$productId]['priceToString'] = '$'.number_format($priceFinal, 2);
            $this->productPrices[$productId]['price'] = $priceFinal;

        else:
            //Si no existen variaciones, o alguna medida seleccionada, Obtenemos el precio y la cantidad del producto general
            $product = Product::with('productSizes')->where('id', $productId)->first();
            $this->productPrices[$productId]['priceToString'] = $product->getPriceToString();
            $this->productPrices[$productId]['price'] = $product->getPriceFinal();
        endif;
    }
    private function loadProductQuantity($productId){
        if(isset($productTypeSelected[$productId]) && $productTypeSelected[$productId] == Product::TYPE_DIGITAL):
            $product = Product::where('id', $productId)->first();
            $this->productQuantities[$productId] = $product->quantity;
            return;
        endif;
        if(
            !isset($this->productSizeSelected[$productId]) &&
            !isset($this->productColorSelected[$productId])
        ):
            $product = Product::with('productSizes')->where('id', $productId)->first();
            $this->productQuantities[$productId] = $product->quantity;
        endif;
        if(isset($this->productColorSelected[$productId])):
            $this->productQuantities[$productId] = $this->productColorSelected[$productId]['quantity'];
        endif;
        if(isset($this->productSizeSelected[$productId])):
            $this->productQuantities[$productId] = $this->productSizeSelected[$productId]['quantity'];
        endif;
        if(
            isset($this->productSizeSelected[$productId]) &&
            isset($this->productColorSelected[$productId])
        ):
            if($this->productSizeSelected[$productId]['relation_with_colors'] != 'SI'):
                $this->productQuantities[$productId] = $this->productSizeSelected[$productId]['quantity'];
            else:
                $productSize = ProductSize::with('productColors')->where('id', $this->productSizeSelected[$productId]['id'])->first();
                $sizeColor = $productSize->productColors->where('id', $this->productColorSelected[$productId]['id'])->first();
                if($sizeColor):
                    $this->productQuantities[$productId] = $sizeColor->pivot->quantity;
                endif;
            endif;
        endif;
    }
    //ADDRESSES
    private function loadShippingAddresses($shippingAddressId = null){
        if($shippingAddressId):
            $shippingAddress = ShippingAddress::with(['state.country', 'orders'])->find($shippingAddressId);
            $this->shippingAddress = $shippingAddress->toArray();
            $this->shippingAddresses[] = $this->shippingAddress;
            $this->loadShippingZones();
        else:
            if($this->user):
                $this->user->load(['shippingAddresses.state.country', 'shippingAddresses.orders']);
                $this->shippingAddresses = $this->user->shippingAddresses->toArray();
            endif;
        endif;
    }
    private function loadBillingAddresses($billingAddressId = null){
        if($billingAddressId):
            $billingAddress = BillingAddress::with(['state.country', 'orders'])->find($billingAddressId);
            $this->billingAddress = $billingAddress->toArray();
            $this->billingAddresses[] = $this->billingAddress;
        else:
            if($this->user):
                $this->user->load(['billingAddresses.state.country', 'billingAddresses.orders']);
                $this->billingAddresses = $this->user->billingAddresses->toArray();
            endif;
        endif;
    }
    public function eventShippingAddressCreate($shippingAddressId){
        $this->loadShippingAddresses($shippingAddressId);
        $this->emit('closeModal');
    }
    public function eventBillingAddressCreate($billingAddressId){
        $this->loadBillingAddresses($billingAddressId);
        $this->emit('closeModal');
    }
    public function selectShippingAddress($shippingAddressId){
        $this->shippingAddress = ShippingAddress::with(['state.country', 'orders'])->find($shippingAddressId)->toArray();
        $this->loadShippingZones();
    }
    public function selectBillingAddress($billingAddressId){
        $this->billingAddress = BillingAddress::with(['state.country', 'orders'])->find($billingAddressId)->toArray();
    }
    private function loadShippingApplies(){
        $allAreDigitales = true;
        foreach(Cart::instance('default')->content() as $item):
            if($item->options->type == Product::TYPE_PHYSICAL):
                $allAreDigitales = false;
                break;
            endif;
        endforeach;
        $this->shippingApplies = !$allAreDigitales;
    }
    //SHIPPING ZONES
    public function loadShippingZones(){
        $stateId = null;
        $zipCode = null;
        $zipCodeRangeValid = range(5,7);
        if(count($this->shippingAddress) && $this->shippingAddress['state_id'] && (in_array(strlen($this->shippingAddress['zip_code']), $zipCodeRangeValid))):
            $stateId = $this->shippingAddress['state_id'];
            $zipCode = $this->shippingAddress['zip_code'];
            $this->shippingZones = ShippingPrice::getShippingMethods($stateId, $zipCode);
        else:
            $this->shippingZones = [];
        endif;
        $this->loadShippingApplies();
        $this->resetShippingZone();
    }
    //COUPON
    public function applyCoupon(){
        $this->resetValidation();
        $this->validate(['couponCode' => 'required']);
        $coupon = Coupon::where('code', $this->couponCode)->first();
        if(!Cart::instance('default')->count()):
            $this->addError('couponCode', __('Empty cart'));
            $this->cancelCoupon();
            return false;
        endif;
        if(!$coupon):
            $this->addError('couponCode', __('The coupon does not exist'));
            $this->cancelCoupon();
            return false;
        endif;
        if(!$coupon->active):
            $this->addError('couponCode', __('Inactive coupon'));
            $this->cancelCoupon();
            return false;
        endif;
        if($coupon->isTimedOut()):
            $this->addError('couponCode', __('Expired coupon'));
            $this->cancelCoupon();
            return false;
        endif;
        if($coupon->isExceededLimitOfUse()):
            $this->addError('couponCode', __('Expired coupon'));
            $this->cancelCoupon();
            return false;
        endif;
        if($coupon->minimum_expense):
            if($this->subtotal < $coupon->minimum_expense):
                $this->addError('couponCode', __('Minimum expense').': '.$coupon->minimum_expense);
                $this->cancelCoupon();
                return false;
            endif;
        endif;
        if($coupon->isExcludePromotion()):
            $this->addError('couponCode', __('This coupon is not applicable with products with promotion'));
            $this->cancelCoupon();
            return false;
        endif;
        $this->coupon = $coupon;
        $this->couponPriceDiscount = ($this->subtotal * $this->coupon->percentage) / 100;
        $this->loadTotal();
        $this->emit('alert', 'success', __('Coupon applied'));
    }
    public function cancelCoupon(){
        $this->coupon = null;
        $this->couponCode = null;
        $this->couponPriceDiscount = 0;
        $this->loadTotal();
        $this->emit('alert', 'success', __('Coupon removed'));
    }
    //TOOLS
    private function filters($products){
        if($this->search):
            $products = $products->where('name', 'LIKE', "%{$this->search}%")
            ->orWhere('sku', 'LIKE', "%{$this->search}%")
            ->orWhere('detail', 'LIKE', "%{$this->search}%")
            ->orWhere('search_advanced', 'LIKE', "%{$this->search}%")
            ->orWhereRelation('productCategories', 'name', 'LIKE', "%{$this->search}%")
            ->orWhereRelation('productGenders', 'name', 'LIKE', "%{$this->search}%")
            ->orWhereRelation('productBrand', 'name', 'LIKE', "%{$this->search}%");
        endif;
        return $products;
    }
    private function loadTotal(){
        $this->subtotal = str_replace(',', '', Cart::instance('default')->subtotal());
        if($this->shippingApplies):
            $this->total = ($this->subtotal - $this->couponPriceDiscount) + $this->shippingPrice;
        else:
            $this->total = ($this->subtotal - $this->couponPriceDiscount);
        endif;
    }
    public function updatedUserId($userId){
        if($userId):
            $this->user = User::with(['shippingAddresses.state.country'])->find($userId);
            $this->loadShippingAddresses();
            $this->loadBillingAddresses();
        else:
            $this->user = null;
            $this->resetAddresses();
            $this->resetShippingZone();
            $this->resetShippingZones();
        endif;
        $this->emitTo('admin.user.shipping-address.form', 'buildUserByEvent', $userId);
        $this->emitTo('admin.user.shipping-billing.form', 'buildUserByEvent', $userId);
    }
    public function updatedShippingZoneId($shippingZoneId){
        if($shippingZoneId):
            $this->shippingZone = $this->shippingZones[$shippingZoneId];
            $this->shippingPrice = $this->shippingZone['price'];
            $this->loadTotal();
        endif;
    }
    private function resetAddresses(){
        $this->shippingAddress = [];
        $this->shippingAddresses = [];
        $this->billingAddress = [];
        $this->billingAddresses = [];
    }
    private function resetShippingZone(){
        $this->shippingZone = [];
        $this->shippingZoneId = null;
        $this->shippingPrice = 0;
    }
    private function resetShippingZones(){
        $this->shippingZones = [];
    }
}
