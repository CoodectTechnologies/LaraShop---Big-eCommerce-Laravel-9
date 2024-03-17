<?php

namespace App\Http\Livewire\Admin\Portfolio;

use App\Models\Portfolio;
use Asantibanez\LivewireCharts\Models\LineChartModel;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Show extends Component
{
    public $project;

    public function mount(Portfolio $project){
        $this->project = $project;
        $this->project->load(['service']);
    }
    public function render(){
        $recentProjects = Portfolio::orderBy('id', 'desc')->take(5)->get();
        $lineChartModel = $this->graphViews();
        return view('livewire.admin.portfolio.show', compact('recentProjects', 'lineChartModel'));
    }
    public function graphViews(){
        $views = $this->project->views()->select(
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
