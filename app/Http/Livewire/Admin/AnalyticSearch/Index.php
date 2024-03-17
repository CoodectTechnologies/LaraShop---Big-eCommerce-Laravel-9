<?php

namespace App\Http\Livewire\Admin\AnalyticSearch;

use App\Models\AnalyticSearch;
use Asantibanez\LivewireCharts\Models\PieChartModel;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $perPage = 20;
    public $search;
    protected $queryString = ['search' => ['except' => '']];
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['render'];

    public $dateStart;
    public $dateEnd;

    public $filter;

    public function mount(Request $request){
        if($request->rangeDateGrapich):
            $rangeDateGrapich = explode(' - ', $request->rangeDateGrapich);
            $this->dateStart = $rangeDateGrapich[0];
            $this->dateEnd = $rangeDateGrapich[1];
        else:
            $this->dateStart = Carbon::today()->subMonth()->format('Y-m-d');
            $this->dateEnd = Carbon::createFromDate(date('Y'), 12, 31)->format('Y-m-d');
        endif;
    }
    public function updatingSearch(){
        $this->resetPage();
    }
    public function render(){
        $analyticSearches = AnalyticSearch::query()->where('created_at', '>=', $this->dateStart)->where('created_at', '<=', $this->dateEnd)->orderBy('id', 'desc');
        $pieChartModel = $this->getPieChartModel();
        if($this->search):
            $analyticSearches = $analyticSearches->where('search', 'LIKE', "%{$this->search}%");
        endif;
        if($this->filter == __('Negatives')):
            $analyticSearches = $analyticSearches->where('founded', false);
        elseif($this->filter == __('Positives')):
            $analyticSearches = $analyticSearches->where('founded', true);
        endif;

        $analyticSearches = $analyticSearches->paginate($this->perPage);
        return view('livewire.admin.analytic-search.index', compact('analyticSearches', 'pieChartModel'));
    }
    public function getPieChartModel(){
       $countPositives = AnalyticSearch::where('founded', true)->where('created_at', '>=', $this->dateStart)->where('created_at', '<=', $this->dateEnd)->count();
       $countNegatives = AnalyticSearch::where('founded', false)->where('created_at', '>=', $this->dateStart)->where('created_at', '<=', $this->dateEnd)->count();
       $colorPositive = '#50cd89';
       $colorNegative = '#f1416c';

        $pieChartModel =  new PieChartModel();
        $pieChartModel = $pieChartModel->addSlice(__('Positive searches'), $countPositives, $colorPositive);
        $pieChartModel = $pieChartModel->addSlice(__('Negative searches'), $countNegatives, $colorNegative);
        return $pieChartModel;
    }
    public function destroy(AnalyticSearch $analyticSearch){
        try{
            $analyticSearch->delete();
            $this->emit('alert', 'success', __('Successful elimination'));
        }catch(Exception $e){
            $this->emit('alert', 'error', $e->getMessage());
        }
    }
}
