<?php

namespace App\Http\Livewire\Admin\Setting\Log;

use Illuminate\Support\Facades\Artisan;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Activitylog\Models\Activity;

class Index extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $user;

    public function mount($user = null){
        if($user) {
            $this->user = $user;
            $this->user->load('actions');
        }
    }
    public function render(){
        if($this->user){
            $logs = $this->user->actions()->orderBy('id', 'desc');
        }else{
            $logs = Activity::with('causer')->orderBy('id', 'desc');
        }
        $logs = $logs->paginate(500);
        return view('livewire.admin.setting.log.index', compact('logs'));
    }
    public function optimizeDatabase(){
        Artisan::call("activitylog:clean");
        $this->emit('alert', 'success', 'Base de datos optimizadas');
    }
}
