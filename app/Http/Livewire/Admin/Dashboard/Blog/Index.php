<?php

namespace App\Http\Livewire\Admin\Dashboard\Blog;

use Asantibanez\LivewireCharts\Models\ColumnChartModel;
use CyrildeWit\EloquentViewable\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Livewire\WithPagination;
use App\Models\BlogPost;
use App\Models\Comment;
use Livewire\Component;
use Carbon\Carbon;

class Index extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $dateStart;
    public $dateEnd;

    public function mount(Request $request){
        if($request->rangeDateGrapich):
            $rangeDateGrapich = explode(' - ', $request->rangeDateGrapich);
            $this->dateStart = $rangeDateGrapich[0];
            $this->dateEnd = $rangeDateGrapich[1];
        else:
            $this->dateStart = Carbon::createFromDate((date('Y')), 01, 01)->format('y-m-d');
            $this->dateEnd = Carbon::createFromDate(date('Y'), 12, 31)->format('y-m-d');
        endif;
    }
    public function render(){
        return view('livewire.admin.dashboard.blog.index');
    }
    public function getViewsTotalProperty(){
        return BlogPost::has('views')
        ->where('created_at', '>=', $this->dateStart)->where('created_at', '<=', $this->dateEnd)
        ->orderByUniqueViews()->count();
    }
    public function getGrafictPostsViewsProperty(){
        $blogViews = View::select(
            DB::raw('DATE_FORMAT(viewed_at, "%m-%Y") AS month2'),
            DB::raw('DATE_FORMAT(viewed_at, "%b-%Y") AS month'),
            DB::raw('COUNT(id) AS views')
        )
        ->where('viewable_type', BlogPost::class)
        ->where('viewed_at', '>=', $this->dateStart)->where('viewed_at', '<=', $this->dateEnd)
        ->orderBy('month2')
        ->groupBy('month', 'month2')
        ->get();
        $columnChartModel =  new ColumnChartModel();
        foreach($blogViews as $blogView): $columnChartModel = $columnChartModel->addColumn($blogView->month, $blogView->views, '#8b1d24'); endforeach;
        return $columnChartModel;
    }
    public function getBlogPostsPublishedProperty(){
        return BlogPost::where('status', 'Publicado')
        ->where('created_at', '>=', $this->dateStart)->where('created_at', '<=', $this->dateEnd)
        ->orderBy('id', 'desc')->get();
    }
    public function getBlogPostsNoPublishedProperty(){
        return BlogPost::where('status', 'Borrador')
        ->where('created_at', '>=', $this->dateStart)->where('created_at', '<=', $this->dateEnd)
        ->orderBy('id', 'desc')->get();
    }
    public function getCommentsApprovedProperty(){
        return Comment::where('commentable_type', BlogPost::class)
        ->where('created_at', '>=', $this->dateStart)->where('created_at', '<=', $this->dateEnd)
        ->where('approved', true)->get();
    }
    public function getCommentsNoApprovedProperty(){
        return Comment::where('commentable_type', BlogPost::class)
        ->where('created_at', '>=', $this->dateStart)->where('created_at', '<=', $this->dateEnd)
        ->where('approved', false)->get();
    }
}
