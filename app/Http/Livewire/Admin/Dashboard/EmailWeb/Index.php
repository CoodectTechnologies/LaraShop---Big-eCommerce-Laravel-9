<?php

namespace App\Http\Livewire\Admin\Dashboard\EmailWeb;

use App\Models\EmailWeb;
use Asantibanez\LivewireCharts\Models\LineChartModel;
use Asantibanez\LivewireCharts\Models\PieChartModel;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $year;

    public function mount(){
        $this->year = date('Y');
    }
    public function render(){
        $emailWebs = EmailWeb::orderBy('id', 'desc')->get();
        $emailWebsRecent = $emailWebs->take(10);
        $emailWebsYes = $emailWebs->where('conversion', 'Si');
        $emailWebsNo = $emailWebs->where('conversion', 'No');
        $emailWebsWatting = $emailWebs->where('conversion', 'En espera');
        return view('livewire.admin.dashboard.email-web.index', compact(
            'emailWebsRecent',
            'emailWebsYes',
            'emailWebsNo',
            'emailWebsWatting'
        ));
    }
    public function getEmailWebTotalProperty(){
        return EmailWeb::query()->count('id');
    }
    public function getEmailWebTotalTodayProperty(){
        return EmailWeb::query()->whereDate('created_at', today())->count('id');
    }
    public function getEmailWebTotalMonthProperty(){
        return EmailWeb::query()->whereMonth('created_at', date('m'))->whereYear('created_at', $this->year)->count('id');
    }
    public function getEmailWebTotalYearProperty(){
        return EmailWeb::query()->whereYear('created_at', $this->year)->count('id');
    }
    public function getGrapihEmailsProperty(){
        $emailWebs = EmailWeb::select(
            DB::raw('DATE_FORMAT(created_at, "%m-%Y") AS month2'),
            DB::raw('DATE_FORMAT(created_at, "%b-%Y") AS month'), 
            DB::raw('COUNT(id) AS countEmails')
        )
        ->whereYear('created_at', $this->year)
        ->orderBy('month2')
        ->groupBy('month', 'month2')
        ->get();
        $lineChartModel =  new LineChartModel();
        foreach($emailWebs as $emailWeb): $lineChartModel = $lineChartModel->addPoint($emailWeb->month, $emailWeb->countEmails); endforeach;
        return $lineChartModel;
    }
    public function getGrapihEmailsByConversionProperty(){
        $emailWebs = EmailWeb::select(
            DB::raw('conversion'), 
            DB::raw('COUNT(id) AS countIds')
        )
        ->whereYear('created_at', $this->year)
        ->groupBy('conversion')
        ->get();
        $pieChartModel =  new PieChartModel();
        foreach($emailWebs as $emailWeb): 
            if($emailWeb->conversion == 'Si'):
                $color = '#50cd89';
            elseif($emailWeb->conversion == 'En espera'):
                $color = '#ffc700';
            elseif($emailWeb->conversion == 'No'):
                $color = '#f1416c';
            else:
                $color = '#918d8d';
            endif;
            $pieChartModel = $pieChartModel->addSlice($emailWeb->conversion, $emailWeb->countIds, $color); 
        endforeach;
        return $pieChartModel;
    }
}
