<?php

namespace App\Http\Livewire\Ecommerce\Configurator;

use App\Http\Controllers\Ecommerce\Cart\CartController;
use App\Models\ConfiguratorBudget;
use App\Models\ConfiguratorChipset;
use App\Models\ConfiguratorFPS;
use App\Models\ConfiguratorGame;
use App\Models\ConfiguratorPerformance;
use App\Models\ConfiguratorStage;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductSize;
use App\Models\Shoppingcart;
use Exception;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Index extends Component
{
    public $buildStageComponent;
    public $buildStageAddon;
    public $buildBudget;
    public $buildBudgetBefore;
    public $buildBudgetAfter;
    public $buildChipset;
    public $buildPerformance;

    public $stagesComponent = [];
    public $stagesAddon = [];
    public $productsComponent = [];
    public $productsAddon = [];
    public $sizes = [];
    public $colors = [];
    public $games = [];
    public $budgets = [];
    public $chipsets = [];
    public $performances = [];
    public $fps = [];

    public $colorsSelected = [];
    public $sizesSelected = [];
    public $pricesSelected = [];

    public $total;
    public $errorsCompatibilities = [];
    public $errorsAddCart = [];
    public $alerts = [];
    public $gallery = [];
    public $identifierSaveCartPublic;

    public function mount(){
        $this->buildStageComponent = new ConfiguratorStage();
        $this->buildStageAddon = new ConfiguratorStage();
        $this->buildBudget = new ConfiguratorBudget();
        $this->buildBudgetBefore = new ConfiguratorBudget();
        $this->buildBudgetAfter = new ConfiguratorBudget();
        $this->buildChipset = new ConfiguratorChipset();
        $this->buildPerformance = new ConfiguratorPerformance();

        $this->loadStagesAddon();
        $this->loadStagesComponent();
        $this->loadTotal();
        $this->restoreShareCart();
        $this->loadGames();
        $this->loadChipsets();
        $this->loadPerformances();
        $this->loadBudgets();
        $this->loadFPS();
    }
    public function render(){
        return view('livewire.ecommerce.configurator.index');
    }
    private function loadStagesComponent(){
        $this->stagesComponent = ConfiguratorStage::with(['products'])->where('type', $this->getStageTypeComponent())->orderBy('order')->get();
        $this->buildStageComponent = $this->stagesComponent->first() ?? new ConfiguratorStage();
        $this->loadProductsComponent();
    }
    private function loadStagesAddon(){
        $this->stagesAddon = ConfiguratorStage::with(['products'])->where('type', $this->getStageTypeAddon())->orderBy('order')->get();
        $this->buildStageAddon = $this->stagesAddon->first() ?? new ConfiguratorStage();
        $this->loadProductsAddon();
    }
    private function loadProductsComponent(){
        $this->productsComponent = $this->getProducts($this->buildStageComponent->id);
        $this->loadSizes($this->productsComponent);
        $this->loadColors($this->productsComponent);
        $this->loadSizesSelected();
        $this->loadColorsSelected();
        $this->loadGallery($this->productsComponent->first());
    }
    private function loadProductsAddon(){
        $this->productsAddon = $this->getProducts($this->buildStageAddon->id);
        $this->loadSizes($this->productsAddon);
        $this->loadColors($this->productsAddon);
        $this->loadSizesSelected();
        $this->loadColorsSelected();
        $this->loadGallery($this->productsAddon->first());
    }
    private function loadSizes($products){
        foreach($products as $product):
            if(count($product->productSizes)):
                foreach($product->productSizes as $size):
                    $this->sizes[$product->id][$size->id] = [
                        'id' => $size->id,
                        'name' => $size->name,
                        'relation_with_colors' => $size->relation_with_colors,
                        'getIsInStock' => $size->getIsInStock(),
                    ];
                endforeach;
            endif;
        endforeach;
    }
    private function loadColors($products){
        foreach($products as $product):
            if(count($product->productColors)):
                foreach($product->productColors as $color):
                    $this->colors[$product->id][$color->id] = [
                        'id' => $color->id,
                        'name' => $color->name,
                        'hexadecimal' => $color->hexadecimal,
                        'getIsInStock' => $color->getIsInStock(),
                    ];
                endforeach;
            endif;
        endforeach;
    }
    private function loadSizesSelected(){
        foreach(Cart::instance('configurator')->content() as $cartItem):
            if($cartItem->options->size['id']):
                $this->selectSize($cartItem->id, $cartItem->options->size['id']);
            endif;
        endforeach;
    }
    private function loadColorsSelected(){
        foreach(Cart::instance('configurator')->content() as $cartItem):
            if($cartItem->options->color['id']):
                $this->selectColor($cartItem->id, $cartItem->options->color['id']);
            endif;
        endforeach;
    }
    private function loadTotal(){
        $total = 0;
        foreach(Cart::instance('configurator')->content() as $cart):
            $total += $cart->price;
        endforeach;
        $this->total = $total;
    }
    private function loadGallery($product){
        if($product):
            $this->gallery = [];
            $this->gallery[] = $product->imagePreview();
            foreach($product->images as $image):
                $this->gallery[] = $image->imagePreview();
            endforeach;
        endif;
    }
    private function loadGames(){
        $this->games = ConfiguratorGame::orderByDesc('id')->get();
    }
    private function loadChipsets(){
        $this->chipsets = ConfiguratorChipset::orderByDesc('id')->get();
        if(count($this->chipsets)):
            $this->buildChipset = $this->chipsets->first();
        endif;
    }
    private function loadPerformances(){
        $this->performances = ConfiguratorPerformance::orderBy('id')->get();
        if(count($this->performances)):
            $this->buildPerformance = $this->performances->first();
        endif;
    }
    private function loadBudgets(){
        $this->budgets = ConfiguratorBudget::orderBy('amount')->get();
        if(count($this->budgets)):
            $this->buildBudget = $this->budgets->first();
            $this->loadBudgetsBeforeAndAfter();
        endif;
    }
    private function loadFPS(){
        $games = ConfiguratorGame::orderByDesc('id')->get();
        $performances = ConfiguratorPerformance::orderByDesc('id')->get();
        $budgets = ConfiguratorBudget::orderBy('amount')->get();
        $chipsets = ConfiguratorChipset::orderBy('id')->get();
        foreach($games as $game):
            $this->fps['games'][$game->id] = $game->toArray();
            $this->fps['games'][$game->id]['imagePreview'] = $game->imagePreview();
            foreach($performances as $performance):
                $this->fps['games'][$game->id]['performances'][$performance->id] = $performance->toArray();
                foreach($budgets as $budget):
                    $this->fps['games'][$game->id]['performances'][$performance->id]['budgets'][$budget->id] = $budget->toArray();
                    $this->fps['games'][$game->id]['performances'][$performance->id]['budgets'][$budget->id]['amount'] = $budget->amountToString();
                    foreach($chipsets as $chipset):
                        $configuratorFPS = ConfiguratorFPS::query()
                        ->where('configurator_game_id', $game->id)
                        ->where('configurator_performance_id', $performance->id)
                        ->where('configurator_budget_id', $budget->id)
                        ->where('configurator_chipset_id', $chipset->id)
                        ->first();
                        $fps = $configuratorFPS ? $configuratorFPS->fps : null;
                        $this->fps['games'][$game->id]['performances'][$performance->id]['budgets'][$budget->id]['chipsets'][$chipset->id]['fps'] = $fps;
                    endforeach;
                endforeach;
            endforeach;
        endforeach;
    }
    public function getFPS($gameId){
        $fps = null;
        if(isset($this->fps['games'][$gameId]['performances'][$this->buildPerformance->id]['budgets'][$this->buildBudget->id]['chipsets'][$this->buildChipset->id]['fps'])):
           $fps = $this->fps['games'][$gameId]['performances'][$this->buildPerformance->id]['budgets'][$this->buildBudget->id]['chipsets'][$this->buildChipset->id]['fps'];
        endif;
        return $fps;
    }
    private function getProducts($stageId){
        $products = collect();
        if($stageId):
            $products = ConfiguratorStage::with('products')->find($stageId)->products;
            foreach(Cart::instance('configurator')->content() as $cart):
                $stage = ConfiguratorStage::with([
                    'configuratorCompatibilities.products.productSizes',
                    'configuratorCompatibilities.products.productColors'
                ])
                 ->whereHas('configuratorCompatibilities.configuratorStageProduct', function($query) use($cart){
                    $query->where('product_id', $cart->id);
                })
                ->find($stageId);
                if($stage):
                    foreach($stage->configuratorCompatibilities as $configuratorCompatibility):
                        if($configuratorCompatibility->configuratorStageProduct->product_id == $cart->id):
                            $products = $configuratorCompatibility->products;
                            break;
                        endif;
                    endforeach;
                endif;
            endforeach;
        endif;
        return $products;
    }
    public function getCartItem($productId, $stageType){
        $buildStage = $this->getBuildStage($stageType);
        $cartItem = Cart::instance('configurator')->search(function ($cartItem) use ($productId, $buildStage){
            return ($cartItem->id === $productId && $cartItem->options->stage['id'] == $buildStage->id);
        });
        $cartItem = $cartItem->first();
        return $cartItem;
    }
    public function getCartItemStage($stageId){
        $cartItem = Cart::instance('configurator')->search(function ($cartItem) use ($stageId){
            return ($cartItem->options->stage['id'] == $stageId);
        });
        $cartItem = $cartItem->first();
        return $cartItem;
    }
    private function getBuildStage($stageType){
        if($stageType == $this->getStageTypeComponent()):
            return $this->buildStageComponent;
        elseif($stageType == $this->getStageTypeAddon()):
            return $this->buildStageAddon;
        endif;
    }
    public function getStageTypeComponent(){
        return ConfiguratorStage::TYPE_COMPONENT;
    }
    public function getStageTypeAddon(){
        return ConfiguratorStage::TYPE_ADDON;
    }
    public function selectColor($productId, $colorId){
        $this->colorsSelected[$productId] = $this->colors[$productId][$colorId];
    }
    public function selectSize($productId, $sizeId){
        $this->sizesSelected[$productId] = $this->sizes[$productId][$sizeId];
        $size = ProductSize::with('productColors')->find($sizeId);
        if(isset($this->colorsSelected[$productId])):
            if(!$size->validateSizeColorSelected($this->colorsSelected[$productId]['id'])):
                unset($this->colorsSelected[$productId]);
            endif;
        endif;
        $this->pricesSelected[$productId] = $size->getPriceFinal();
    }
    private function validateCompatibilities(){
        foreach(Cart::instance('configurator')->content() as $cart):
            $products = $this->getProducts($cart->options->stage['id']);
            $productId = $cart->id;
            if(!$products->contains($productId)):
                $this->errorsCompatibilities[$cart->options->stage['id']] = $cart->options->stage['id'];
            else:
                unset($this->errorsCompatibilities[$cart->options->stage['id']]);
            endif;
        endforeach;
    }
    public function validateColorSizeSelected($colorId, $sizeId){
        $color = ProductColor::find($colorId);
        return $color->validateColorSizeSelected($sizeId);
    }
    public function buildStage(ConfiguratorStage $stage, $stageType){
        if($stageType == $this->getStageTypeComponent()):
            $this->buildStageComponent = $stage;
            $this->loadProductsComponent();
        elseif($stageType == $this->getStageTypeAddon()):
            $this->buildStageAddon = $stage;
            $this->loadProductsAddon();
        else:
            return new Exception(__('Type of passage not identified'), 1);
        endif;
        $this->validateCompatibilities();
        $this->errorsAddCart = [];
        $this->alerts = [];
    }
    public function buildBudget(ConfiguratorBudget $configuratorBudget){
        $this->buildBudget = $configuratorBudget;
        $this->loadBudgetsBeforeAndAfter();
    }
    public function buildChipset(ConfiguratorChipset $configuratorChipset){
        $this->buildChipset = $configuratorChipset;
    }
    public function buildPerformance(ConfiguratorPerformance $configuratorPerformance){
        $this->buildPerformance = $configuratorPerformance;
    }
    public function loadBudgetsBeforeAndAfter(){
        $this->buildBudgetBefore = ConfiguratorBudget::where('amount', '<', $this->buildBudget->amount)->orderByDesc('amount')->first() ?? new ConfiguratorBudget;
        $this->buildBudgetAfter = ConfiguratorBudget::where('amount', '>', $this->buildBudget->amount)->orderBy('amount')->first() ?? new ConfiguratorBudget;
    }
    public function buildCart(Product $product, $stageType){
        $buildStage = $this->getBuildStage($stageType);
        if($buildStage):
            $cartItem = $this->getCartItem($product->id, $stageType);
            if($cartItem && $cartItem->id == $product->id && $buildStage->optional):
                Cart::instance('configurator')->remove($cartItem->rowId);
            else:
                $cartItemStage = $this->getCartItemStage($buildStage->id);
                if($cartItemStage):
                    Cart::instance('configurator')->remove($cartItemStage->rowId);
                endif;
                $price = isset($pricesSelected[$product->id]) ? (float) $pricesSelected[$product->id] : (float) $product->getPriceFinal();
                $options = [
                    'size' => [
                        'id' => isset($this->sizesSelected[$product->id]) ? $this->sizesSelected[$product->id]['id'] : null,
                        'name' => isset($this->sizesSelected[$product->id]) ? $this->sizesSelected[$product->id]['name'] : null,
                    ],
                    'color' => [
                        'id' => isset($this->colorsSelected[$product->id]) ? $this->colorsSelected[$product->id]['id'] : null,
                        'name' => isset($this->colorsSelected[$product->id]) ? $this->colorsSelected[$product->id]['name'] : null,
                    ],
                    'stage' => [
                        'id' => $buildStage->id,
                        'name' => $buildStage->name
                    ],
                    // 'image' => isset($this->gallery[0]) ? $this->gallery[0]->imagePreview() : $this->product->imagePreview(),
                    'price' => $price,
                    'type' => Product::TYPE_PHYSICAL
                ];
                Cart::instance('configurator')->add([
                    'id' => $product->id,
                    'name' => $product->name,
                    'qty' => 1,
                    'price' => $price,
                    'options' => $options
                ])->associate(Product::class);
                $this->emit('closeModal');
            endif;
            $this->validateCompatibilities();
            $this->loadTotal();
            $this->loadGallery($product);
            $this->errorsAddCart = [];
            $this->alerts = [];
        endif;
    }
    public function buildProductsByBudget(){
        $productsByBudget = ConfiguratorBudget::with(['configuratorStageProducts.configuratorStage', 'configuratorStageProducts.product'])
        ->where('configurator_chipset_id', $this->buildChipset->id)
        ->where('id', $this->buildBudget->id)
        ->whereHas('configuratorPerformances', function($query){
            $query->whereIn('configurator_performance_id', [$this->buildPerformance->id]);
        })
        ->first();
        if($productsByBudget && count($productsByBudget->configuratorStageProducts)):
            Cart::instance('configurator')->destroy();
            foreach($productsByBudget->configuratorStageProducts as $configuratorStageProduct):
                $product = $configuratorStageProduct->product;
                $stage = $configuratorStageProduct->configuratorStage;
                $this->buildStage($stage, $stage->type);
                $this->buildCart($product, $stage->type);
            endforeach;
            $this->emit('closeModal');
        else:
            Session::flash('alert', __('Try other options'));
            Session::flash('alert-type', 'warning');
        endif;
    }
    public function addCart(){
        $this->errorsAddCart = [];
        $stagesNotOptionales = 0;
        foreach($this->stagesComponent as $stage):
            if(!$stage->optional):
                $stagesNotOptionales++;
            endif;
        endforeach;
        foreach($this->stagesAddon as $stage):
            if(!$stage->optional):
                $stagesNotOptionales++;
            endif;
        endforeach;
        if(Cart::instance('configurator')->count() < $stagesNotOptionales):
            $this->errorsAddCart[] = __('Complete all non-optional steps');
            return;
        endif;
        if(count($this->errorsCompatibilities)):
            $this->errorsAddCart[] = __('Only compatible products');
            return;
        endif;
        foreach(Cart::instance('configurator')->content() as $cartItem):
            $addCart = CartController::store($cartItem->model, $cartItem->qty, $cartItem->price, $cartItem->options->toArray());
            if($addCart !== true):
                $this->errorsAddCart[] = __('There was a problem entering the product:').' '.$cartItem['name'];
            endif;
        endforeach;
        if(!count($this->errorsAddCart)):
            Cart::instance('configurator')->destroy();
            Redirect::route('ecommerce.cart.index');
        endif;
    }
    public function removeCart(){
        Cart::instance('configurator')->destroy();
        $this->loadTotal();
        $this->errorsCompatibilities = [];
        $this->errorsAddCart = [];
        $this->alerts = [];
    }
    public function saveCart(){
        if(Auth::check()):
            Cart::instance('configurator')->store(Auth::id());
            $this->alerts[] = [
                'type' => 'success',
                'title' => __('Process saved'),
                'message' => __('Configuration successfully saved, at any time you can load it again.'),
            ];
        endif;
    }
    public function restoreCart(){
        if(Auth::check()):
            $shoppingcart = Shoppingcart::where('identifier', Auth::id())->where('instance', 'configurator')->first();
            if($shoppingcart):
                Cart::instance('configurator')->restore(Auth::id());
            else:
                $this->alerts[] = [
                    'type' => 'secondary',
                    'title' => __('Witout data'),
                    'message' => __('You do not have any saved configuration yet, you will have to save one first.'),
                ];
            endif;
        endif;
    }
    public function shareCart(){
        $ip = request()->ip();
        $this->identifierSaveCartPublic = base64_encode($ip);
        Cart::instance('configurator')->store($ip);
        $this->emit('showModalShareCart');
    }
    private function restoreShareCart(){
        if(!$ip = request()->shareCart):
           return;
        endif;
        try{
            $ip = base64_decode($ip);
            $shoppingcart = Shoppingcart::where('identifier', $ip)->first();
            if($shoppingcart):
                Cart::instance('configurator')->destroy();
                Cart::instance('configurator')->restore($ip);
                $this->loadTotal();
            endif;
        }catch(Exception $e){}
    }
}
