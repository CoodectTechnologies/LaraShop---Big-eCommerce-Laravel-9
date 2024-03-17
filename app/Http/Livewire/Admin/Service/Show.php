<?php

namespace App\Http\Livewire\Admin\Service;

use App\Models\Service;
use Asantibanez\LivewireCharts\Models\LineChartModel;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Show extends Component
{
    public $service;

    public function mount(Service $service){
        $this->service = $service;
        $this->service->load(['projects']);
    }
    public function render(){
        $recentServices = Service::orderBy('id', 'desc')->take(5)->get();
        $lineChartModel = $this->graphViews();
        return view('livewire.admin.service.show', compact('recentServices', 'lineChartModel'));
    }
    public function graphViews(){
        $views = $this->service->views()->select(
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
        foreach($views as $view): $lineChartModel = $lineChartModel->addPoint($view->month, $view->views); endforeach;
        return $lineChartModel;
    }
}
