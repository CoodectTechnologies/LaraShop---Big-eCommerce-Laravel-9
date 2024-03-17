<?php

namespace App\Http\Livewire\Admin\Dashboard\Order;

use App\Exports\Admin\Dashboard\Order\OrdersInfoExport;
use Asantibanez\LivewireCharts\Models\LineChartModel;
use App\Exports\Admin\Dashboard\Order\OrdersExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Livewire\WithPagination;
use App\Models\Currency;
use App\Models\Comment;
use Livewire\Component;
use App\Models\Product;
use App\Models\Order;
use Carbon\Carbon;

class Index extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $dateStart;
    public $dateEnd;
    public $currencyDefault;

    public function mount(Request $request){
        if($request->rangeDateGrapich):
            $rangeDateGrapich = explode(' - ', $request->rangeDateGrapich);
            $this->dateStart = $rangeDateGrapich[0];
            $this->dateEnd = $rangeDateGrapich[1];
        else:
            $this->dateStart = Carbon::createFromDate((date('Y')), 01, 01)->format('y-m-d');
            $this->dateEnd = Carbon::createFromDate(date('Y'), 12, 31)->format('y-m-d');
        endif;
        $this->getReports();
        $this->loadCurrencyDefault();
    }
    public function render(){
        $orders = Order::orderBy('id', 'desc')->get();
        $ordersRecent = $orders->take(10);
        $ordersProcesing = $orders->where('status', 'Procesando');
        $ordersCompleted = $orders->where('status', 'Completado');
        $ordersCancelled = $orders->where('status', 'Cancelado');
        $ordersReturned = $orders->where('status', 'Devolución');
        return view('livewire.admin.dashboard.order.index', compact(
            'ordersRecent',
            'ordersProcesing',
            'ordersCompleted',
            'ordersCancelled',
            'ordersReturned'
        ));
    }
    public function getOrderTotalTodayProperty(){
        $orders = Order::query()
        ->validateOrder()
        ->whereDate('created_at', today())
        ->get();
        $total = Order::getConvertCurrencyDefaults($orders, 'total');
        return '$'.number_format($total, 2);
    }
    public function getOrderTotalMonthProperty(){
        $orders = Order::query()
        ->validateOrder()
        ->whereMonth('created_at', date('m'))
        ->whereYear('created_at', date('Y'))
        ->get();
        $total = Order::getConvertCurrencyDefaults($orders, 'total');
        return '$'.number_format($total, 2);
    }
    public function getOrderTotalProperty(){
        $orders = Order::query()
        ->validateOrder()
        ->whereDate('created_at', '>=', $this->dateStart)
        ->whereDate('created_at', '<=', $this->dateEnd)
        ->get();
        $total = Order::getConvertCurrencyDefaults($orders, 'total');
        return '$'.number_format($total, 2);
    }
    public function getOrderTotalDatesProperty(){
        $orders = Order::query()
        ->validateOrder()
        ->whereDate('created_at', '>=', $this->dateStart)
        ->whereDate('created_at', '<=', $this->dateEnd)
        ->get();
        $total = Order::getConvertCurrencyDefaults($orders, 'total');
        return number_format($total, 2);
    }
    public function getGrapihSalesProperty(){
        $sales = [];
        $orders = Order::query()
        ->validateOrder()
        ->whereDate('created_at', '>=', $this->dateStart)
        ->whereDate('created_at', '<=', $this->dateEnd)
        ->get();
        foreach($orders as $order):
            $date = Carbon::parse($order->created_at)->format('Y-m-d');
            $total = floatval(Order::getConvertCurrencyDefault($order, 'total'));
            if(isset($sales[$date])):
                $sales[$date] += $total;
            else:
                $sales[$date] = $total;
            endif;
        endforeach;
        $lineChartModel =  new LineChartModel();
        foreach($sales as $date => $total):
            $lineChartModel = $lineChartModel->addPoint($date, $total);
        endforeach;
        return $lineChartModel;
    }
    public function getMostViewedProductsProperty(){
        $products = Product::query()->orderByUniqueViews()->take(10)->get();
        return $products;
    }
    public function getMostSelledProductsProperty(){
        $products = Product::query()->has('orders')->with('orders')->get()->sortBy(function($query) {
            return $query->orders->sum('quantity');
        })->take(10);
        return $products;
    }
    public function getProductsLowStockProperty(){
        $products = Product::query()->where('quantity', '<=', Product::STOCK_LOW)->paginate(10, ['*'], 'productLows');
        return $products;
    }
    public function getProductsPublishedProperty(){
        return Product::query()->where('status', 'Publicado')->orderBy('id', 'desc')->get();
    }
    public function getProductsNoPublishedProperty(){
        return Product::query()->where('status', 'Borrador')->orderBy('id', 'desc')->get();
    }
    public function getCommentsApprovedProperty(){
        return Comment::where('commentable_type', Product::class)->where('approved', true)->get();
    }
    public function getCommentsNoApprovedProperty(){
        return Comment::where('commentable_type', Product::class)->where('approved', false)->get();
    }
    public function getReports(){
        $reports = ['Todas las ordenes'];
        $productTypes = Product::getTypes();
        $reports = array_merge($reports, $productTypes);
        return $reports;
    }
    public function generateReport($productType){
        if($productType == Product::TYPE_PHYSICAL_AND_DIGITAL):
            $productType = null;
        endif;
        if(!$productType || in_array($productType, Product::getTypes())):
            $fileName = $productType ? $productType.'.xlsx' : 'Digitales_Fisicos.xlsx';
            return Excel::download(new OrdersInfoExport($this->dateStart, $this->dateEnd, $productType), $fileName);
        endif;
        if($productType == 'Todas las ordenes'):
            $fileName = 'todas_las_ordenes.xlsx';
            return Excel::download(new OrdersExport($this->dateStart, $this->dateEnd), $fileName);
        endif;
    }
    private function loadCurrencyDefault(){
        $this->currencyDefault = Currency::getDefault();
    }
}
