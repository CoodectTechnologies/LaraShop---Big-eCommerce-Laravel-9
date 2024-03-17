<?php

namespace App\Http\Livewire\Admin\Catalog\Product\Product;

use App\Models\Product;
use Asantibanez\LivewireCharts\Models\LineChartModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Show extends Component
{
    public $product;
    public $submodule;

    public function mount(Product $product, Request $request){
        $this->product = $product;
        $this->submodule = $request->submodule ?? null;
    }
    public function render(){
        $productImages = $this->product->images()->orderBy('id', 'desc')->get();
        $comments = $this->comments();
        $lineChartModel = $this->graphViews();
        return view('livewire.admin.catalog.product.product.show', compact('productImages', 'comments', 'lineChartModel'));
    }
    private function graphViews(){
        $lineChartModel = [];
        if($this->product->id):
            $views = $this->product->views()->select(
                DB::raw('DATE_FORMAT(viewed_at, "%m-%Y") AS month2'),
                DB::raw('DATE_FORMAT(viewed_at, "%b-%Y") AS month'),
                DB::raw('COUNT(id) AS views')
            )
            ->whereYear('viewed_at', date('Y'))
            ->orderBy('month2')
            ->groupBy('month', 'month2')
            ->get();
            $lineChartModel =  new LineChartModel();
            $lineChartModel = $lineChartModel->setTitle('Vistas del '.date('Y'));
            foreach($views as $view):
                $lineChartModel = $lineChartModel->addPoint($view->month, $view->views);
            endforeach;
        endif;
        return $lineChartModel;
    }
    private function comments(){
        return $this->product->comments()->orderBy('id', 'desc')->get();
    }
}
