<?php

use App\Http\Controllers\Admin\Test\TestController;
use App\Http\Controllers\Admin\About\AboutController;
use App\Http\Controllers\Admin\AnalyticSearch\AnalyticSearchController;
use App\Http\Controllers\Admin\Banner\BannerController;
use App\Http\Controllers\Admin\Blog\CategoryController;
use App\Http\Controllers\Admin\Blog\PostController;
use App\Http\Controllers\Admin\Blog\TagController;
use App\Http\Controllers\Admin\Catalog\CategoryController as CatalogCategoryController;
use App\Http\Controllers\Admin\Catalog\BrandController as CatalogBrandController;
use App\Http\Controllers\Admin\Catalog\GenderController as CatalogGenderController;
use App\Http\Controllers\Admin\Catalog\ProductController as CatalogProductController;
use App\Http\Controllers\Admin\Configurator\Budget\ConfiguratorBudgetController;
use App\Http\Controllers\Admin\Configurator\Compatibility\ConfiguratorCompatibilityController;
use App\Http\Controllers\Admin\Configurator\FPS\ConfiguratorFPSController;
use App\Http\Controllers\Admin\Configurator\Game\ConfiguratorGameController;
use App\Http\Controllers\Admin\Configurator\Performance\ConfiguratorPerformanceController;
use App\Http\Controllers\Admin\Configurator\Stage\ConfiguratorStageController;
use App\Http\Controllers\Admin\Coupon\CouponController;
use App\Http\Controllers\Admin\Dashboard\Order\OrderController as DashboardOrderController;
use App\Http\Controllers\Admin\Dashboard\Blog\BlogController as DashboardBlogController;
use App\Http\Controllers\Admin\Dashboard\General\GeneralController as DashboardGeneralController;
use App\Http\Controllers\Admin\Dashboard\EmailWeb\EmailWebController as DashboardEmailWebController;
use App\Http\Controllers\Admin\EmailWeb\EmailWebController;
use App\Http\Controllers\Admin\Gallery\GalleryController;
use App\Http\Controllers\Admin\Language\LanguageController;
use App\Http\Controllers\Admin\Order\OrderController;
use App\Http\Controllers\Admin\Package\FeatureController;
use App\Http\Controllers\Admin\Package\PackageController;
use App\Http\Controllers\Admin\Partner\PartnerController;
use App\Http\Controllers\Admin\Portfolio\PortfolioController;
use App\Http\Controllers\Admin\Promotion\PromotionController;
use App\Http\Controllers\Admin\QuestionAnswer\QuestionAnswerController;
use App\Http\Controllers\Admin\Service\ServiceController;
use App\Http\Controllers\Admin\Setting\AccessGoogle\AccessGoogleController;
use App\Http\Controllers\Admin\Setting\AccessMailchimp\AccessMailchimpController;
use App\Http\Controllers\Admin\Setting\AccessPayment\AccessPaymentController;
use App\Http\Controllers\Admin\Setting\Backup\BackupController;
use App\Http\Controllers\Admin\Setting\Certificate\CertificateController;
use App\Http\Controllers\Admin\Setting\Configurator\ConfiguratorController;
use App\Http\Controllers\Admin\Setting\Contact\ContactController;
use App\Http\Controllers\Admin\Setting\Country\CountryController;
use App\Http\Controllers\Admin\Setting\Currency\CurrencyController;
use App\Http\Controllers\Admin\Setting\General\GeneralController;
use App\Http\Controllers\Admin\Setting\InfoAccountBank\InfoAccountBankController;
use App\Http\Controllers\Admin\Setting\Log\LogController;
use App\Http\Controllers\Admin\Setting\ModuleWeb\ModuleWebController;
use App\Http\Controllers\Admin\Setting\Permission\PermissionController;
use App\Http\Controllers\Admin\Setting\Popup\PopupController;
use App\Http\Controllers\Admin\Setting\Role\RoleController;
use App\Http\Controllers\Admin\Setting\ShippingClass\ShippingclassController;
use App\Http\Controllers\Admin\Setting\ShippingZone\ShippingZoneController;
use App\Http\Controllers\Admin\Setting\State\StateController;
use App\Http\Controllers\Admin\Setting\TagAnalytic\TagAnalyticController;
use App\Http\Controllers\Admin\Setting\Welcome\WelcomeController;
use App\Http\Controllers\Admin\Subscriber\SubscriberController;
use App\Http\Controllers\Admin\Team\TeamController;
use App\Http\Controllers\Admin\Testimony\TestimonyController;
use App\Http\Controllers\Admin\User\UserController;
use App\Http\Controllers\Admin\Video\VideoController;
use App\Http\Controllers\Admin\Wholesale\WholesaleController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;

//Language
Route::get('/lang/{language}', LanguageController::class)->name('language');
//Dashboard
Route::prefix('/')->name('dashboard.')->group(function (){
    Route::get('/', [DashboardGeneralController::class, 'index'])->name('general.index');
    Route::middleware(['can:ordenes'])->get('/dahboard/order', [DashboardOrderController::class, 'index'])->name('order.index');
    Route::middleware(['can:blog'])->get('/dahboard/blog', [DashboardBlogController::class, 'index'])->name('blog.index');
    Route::middleware(['can:correos'])->get('/dashboard/email-web', [DashboardEmailWebController::class, 'index'])->name('email-web.index');
});
//Setting
Route::prefix('setting')->name('setting.')->group(function (){
    //System
    Route::get('/', [WelcomeController::class, 'index'])->name('welcome');
    Route::middleware(['can:permisos'])->get('/permission', [PermissionController::class, 'index'])->name('permission');
    Route::middleware(['can:roles'])->resource('/role', RoleController::class)->names('role');
    Route::middleware(['can:backups'])->get('/backup', [BackupController::class, 'index'])->name('backup');
    Route::middleware(['can:logs'])->get('/log', [LogController::class, 'index'])->name('log');
    Route::middleware(['can:módulos web'])->get('/module-web', [ModuleWebController::class, 'index'])->name('module-web');
    Route::middleware(['can:generales'])->get('general', [GeneralController::class, 'index'])->name('general');
    //Web
    Route::middleware(['can:contacto'])->get('/contact', [ContactController::class, 'index'])->name('contact');
    Route::middleware(['can:etiquetas analíticas'])->get('/tag-analytic', [TagAnalyticController::class, 'index'])->name('tag-analytic');
    Route::middleware(['can:accesos mailchimp'])->get('/access-mailchimp', [AccessMailchimpController::class, 'index'])->name('access-mailchimp');
    Route::middleware(['can:accesos google'])->get('/access-google', [AccessGoogleController::class, 'index'])->name('access-google');
    //Ecommerce
    Route::middleware(['can:zonas de envío'])->resource('/shipping-zone', ShippingZoneController::class)->names('shipping-zone');
    Route::middleware(['can:clases de envío'])->get('/shipping-class', [ShippingclassController::class, 'index'])->name('shipping-class');
    Route::middleware(['can:países'])->get('/country', [CountryController::class, 'index'])->name('country');
    Route::middleware(['can:estados'])->get('/state', [StateController::class, 'index'])->name('state');
    Route::middleware(['can:popup'])->get('/popup', [PopupController::class, 'index'])->name('popup');
    Route::middleware(['can:configurador'])->get('/configurator', [ConfiguratorController::class, 'index'])->name('configurator');
    //Payment
    Route::middleware(['can:monedas'])->get('/currency', [CurrencyController::class, 'index'])->name('currency');
    Route::middleware(['can:pasarelas de pago'])->get('/access-payment', [AccessPaymentController::class, 'index'])->name('access-payment');
});
//User
Route::resource('/user', UserController::class)->names('user');
//Analytic search
Route::middleware(['can:analytic search'])->get('/analytic-search', [AnalyticSearchController::class, 'index'])->name('analytic-search.index');
//Banner
Route::middleware(['can:banners'])->get('/banner', [BannerController::class, 'index'])->name('banner.index');
//Gallery
Route::middleware(['can:galería'])->get('/gallery', [GalleryController::class, 'index'])->name('gallery.index');
//About
Route::middleware(['can:nosotros'])->get('/about', [AboutController::class, 'index'])->name('about.index');
//Team
Route::middleware(['can:team'])->get('/team', [TeamController::class, 'index'])->name('team.index');
//Partner
Route::middleware(['can:socios'])->get('/partner', [PartnerController::class, 'index'])->name('partner.index');
//Video
Route::middleware(['can:videos'])->get('/video', [VideoController::class, 'index'])->name('video.index');
//Service
Route::middleware(['can:servicios'])->resource('/service', ServiceController::class)->names('service');
//Portfolio
Route::middleware(['can:portafolio'])->resource('/portfolio', PortfolioController::class)->parameters(['portfolio' => 'project'])->names('portfolio');
//Blog
Route::prefix('blog')->name('blog.')->group(function (){
    Route::redirect('/', '/admin/blog/post');
    Route::middleware(['can:blog'])->resource('/post', PostController::class)->names('post');
    Route::middleware(['can:blog categorías'])->get('/category', [CategoryController::class, 'index'])->name('category.index');
    Route::middleware(['can:blog etiquetas'])->get('/tag', [TagController::class, 'index'])->name('tag.index');
});
//Package
Route::prefix('package')->name('package.')->group(function (){
    Route::redirect('/', '/admin/package/package');
    Route::middleware(['can:paquetes'])->get('/packages', [PackageController::class, 'index'])->name('package.index');
    Route::middleware(['can:paquetes características'])->get('/feature', [FeatureController::class, 'index'])->name('feature.index');
});
//Testimony
Route::middleware(['can:testimonios'])->get('/testimony', [TestimonyController::class, 'index'])->name('testimony.index');
//Question answer
Route::middleware(['can:preguntas y respuestas'])->get('/question-answer', [QuestionAnswerController::class, 'index'])->name('question-answer.index');
//Subscriber
Route::middleware(['can:subscriptores'])->get('/subscriber', [SubscriberController::class, 'index'])->name('subscriber.index');
//Email web
Route::middleware(['can:correos'])->get('/email-web', [EmailWebController::class, 'index'])->name('email-web.index');
//Product
Route::prefix('catalog')->name('catalog.')->group(function (){
    Route::redirect('/', '/admin/catalog/category');
    Route::middleware(['can:producto categorías'])->resource('/category', CatalogCategoryController::class)->names('category');
    Route::middleware(['can:producto marcas'])->get('/brand', [CatalogBrandController::class, 'index'])->name('brand.index');
    Route::middleware(['can:producto géneros'])->get('/gender', [CatalogGenderController::class, 'index'])->name('gender.index');
    Route::middleware(['can:productos'])->resource('/product', CatalogProductController::class)->names('product');
});
//Wholesale
Route::middleware(['can:mayoreo'])->resource('/wholesale', WholesaleController::class)->names('wholesale');
//Promotion
Route::middleware(['can:promociones'])->resource('/promotion', PromotionController::class)->names('promotion');
//coupon
Route::middleware(['can:cupones'])->resource('/coupon', CouponController::class)->names('coupon');
//Order
Route::middleware(['can:ordenes'])->resource('/order', OrderController::class)->names('order');
//Configurator
Route::prefix('configurator')->name('configurator.')->group(function (){
    Route::middleware(['can:configurador pasos'])->resource('/stage', ConfiguratorStageController::class)->parameters(['stage' => 'configuratorStage'])->names('stage');
    Route::middleware(['can:configurador compatibilidades'])->resource('/compatibilities', ConfiguratorCompatibilityController::class)->parameters(['compatibilities' => 'configuratorCompatibility'])->names('compatibility');
    Route::middleware(['can:configurador rendimiento'])->resource('/performance', ConfiguratorPerformanceController::class)->parameters(['performance' => 'configuratorPerformance'])->names('performance');
    Route::middleware(['can:configurador juegos'])->resource('/games', ConfiguratorGameController::class)->parameters(['games' => 'configuratorGame'])->names('game');
    Route::middleware(['can:configurador rangos'])->resource('/budgets', ConfiguratorBudgetController::class)->parameters(['budgets' => 'configuratorBudget'])->names('budget');
    Route::middleware(['can:configurador fps'])->resource('/fps', ConfiguratorFPSController::class)->parameters(['fps' => 'configuratorFPS'])->names('fps');
});
//Test
Route::get('/test', [TestController::class, 'index']);
//Tools
Route::get('storage-link', function(){
    try{
        Artisan::call('storage:link');
        echo 'Se ha creado el simbolo';
    }catch(Exception $e){
        echo $e->getMessage();
    }
});
Route::get('optimize-clear', function(){
    try{
        Artisan::call('optimize:clear');
        echo 'Se ha optimizado';
    }catch(Exception $e){
        echo $e->getMessage();
    }
});
