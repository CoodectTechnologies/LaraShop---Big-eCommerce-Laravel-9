<?php

use App\Http\Controllers\Ecommerce\Gallery\GalleryController;
use App\Http\Controllers\Ecommerce\About\AboutController;
use App\Http\Controllers\Ecommerce\Account\Dashboard\DashboardController;
use App\Http\Controllers\Ecommerce\Account\Order\OrderController;
use App\Http\Controllers\Ecommerce\Account\Profile\ProfileController;
use App\Http\Controllers\Ecommerce\Account\ShippingAddress\ShippingAddressController;
use App\Http\Controllers\Ecommerce\Account\BillingAddress\BillingAddressController;
use App\Http\Controllers\Ecommerce\Account\ProductDigital\ProductDigitalController;
use App\Http\Controllers\Ecommerce\Blog\PostController;
use App\Http\Controllers\Ecommerce\Cart\CartController;
use App\Http\Controllers\Ecommerce\Category\CategoryController;
use App\Http\Controllers\Ecommerce\Checkout\CheckoutController;
use App\Http\Controllers\Ecommerce\Compare\CompareController;
use App\Http\Controllers\Ecommerce\Configurator\ConfiguratorController;
use App\Http\Controllers\Ecommerce\Contact\ContactController;
use App\Http\Controllers\Ecommerce\Currency\CurrencyController;
use App\Http\Controllers\Ecommerce\Feed\FacebookController;
use App\Http\Controllers\Ecommerce\Feed\GoogleController;
use App\Http\Controllers\Ecommerce\Home\HomeController;
use App\Http\Controllers\Ecommerce\Product\ProductController;
use App\Http\Controllers\Ecommerce\Language\LanguageController;
use App\Http\Controllers\Ecommerce\Popup\PopupController;
use App\Http\Controllers\Ecommerce\TrackOrder\TrackOrderController;
use App\Http\Controllers\Ecommerce\Webhook\WebhookMercadopagoController;
use App\Http\Controllers\Ecommerce\Webhook\WebhookStripeController;
use App\Http\Controllers\Ecommerce\Wishlist\WishlistController;
use Illuminate\Support\Facades\Route;

//Home
Route::get('/', [HomeController::class, 'index'])->name('home.index');
//Language
Route::get('/lang/{language}', LanguageController::class)->name('language');
//Currency
Route::get('/currency/{currency}', CurrencyController::class)->name('currency');
//About
Route::get('/nosotros', [AboutController::class, 'index'])->name('about.index');
//Blog
Route::resource('/blog', PostController::class)->parameters(['blog' => 'post'])->names('blog');
//Gallery
Route::get('/galeria', [GalleryController::class, 'index'])->name('gallery.index');
//Contact
Route::get('/contacto', [ContactController::class, 'index'])->name('contact.index');
//Category
Route::resource('/categorias', CategoryController::class)->parameters(['categorias' => 'category'])->names('category');
//Product
Route::resource('/productos', ProductController::class)->parameters(['productos' => 'product'])->names('product');
//Cart
Route::get('/carrito', [CartController::class, 'index'])->name('cart.index');
//Wishlist
Route::get('/favoritos', [WishlistController::class, 'index'])->name('wishlist.index');
//Compare
Route::get('/comparar', [CompareController::class, 'index'])->name('compare.index');
//Track order
Route::get('/rastreo-de-pedido', [TrackOrderController::class, 'index'])->name('track-order.index');
//Popup
Route::get('/popup', [PopupController::class, 'index'])->name('popup.index');
//Configurator
Route::get('/arma-tu-pc', [ConfiguratorController::class, 'index'])->name('configurator.index');
//Checkout
Route::prefix('/checkout')->name('checkout.')->group(function (){
    Route::middleware('auth')->get('/', [CheckoutController::class, 'index'])->name('index');
    Route::get('/guest', [CheckoutController::class, 'index'])->name('guest');
    Route::get('/{order}/pago', [CheckoutController::class, 'payment'])->name('payment');
    Route::get('/{order}/completo', [CheckoutController::class, 'complete'])->name('complete');
    Route::get('/whastapp', [CheckoutController::class, 'whatsapp'])->name('whatsapp');
});
//Webhook
Route::prefix('/webhook')->name('webhook.')->group(function (){
    Route::post('/stripe', WebhookStripeController::class)->name('payment.stripe');
    Route::post('/mercadopago', WebhookMercadopagoController::class)->name('payment.mercadopago');
});
//Account
Route::prefix('/cuenta')->middleware('auth')->name('account.')->group(function (){
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::resource('/direcciones-de-envio', ShippingAddressController::class)->parameters(['direcciones-de-envio' => 'shippingAddress'])->names('shipping-address');
    Route::resource('/direcciones-de-facturacion', BillingAddressController::class)->parameters(['direcciones-de-facturacion' => 'billingAddress'])->names('billing-address');
    Route::resource('/ordenes', OrderController::class)->parameters(['ordenes' => 'order'])->names('order');
    Route::resource('/mis-productos-digitales', ProductDigitalController::class)->parameters(['mis-productos-digitales' => 'product'])->names('product-digital');
    Route::get('/perfil', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/password', [ProfileController::class, 'password'])->name('profile.password');
});
//Feed
Route::prefix('feed')->name('feed.')->group(function (){
    Route::redirect('/', '/ecommerce/feed/facebook');
    Route::get('/facebook', [FacebookController::class, 'index'])->name('facebook.index');
    Route::get('/google', [GoogleController::class, 'index'])->name('google.index');
});
