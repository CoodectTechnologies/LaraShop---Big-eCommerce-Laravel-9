<?php

namespace App\Http\Livewire\Admin\Team;

use App\Models\Team;
use Exception;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $perPage = 50;
    public $search;
    protected $queryString = ['search' => ['except' => '']];
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['render'];

    public function updatingSearch(){
        $this->resetPage();
    }
    public function render(){
        $team = Team::query()->orderBy('id', 'desc');
        if($this->search):
            $team = $team->where('name', 'LIKE', "%{$this->search}%")->orWhere('position', 'LIKE', "%{$this->search}%");
        endif;
        $team = $team->paginate($this->perPage);
        return view('livewire.admin.team.index', compact('team'));
    }
    public function destroy(Team $person){
        try{
            if($person->image):
                if(Storage::exists($person->image->url)):
                    Storage::delete($person->image->url);
                endif;
                $person->image()->delete();
            endif;
            $person->delete();
            $this->emit('alert', 'success', __('Successful elimination'));
            Cache::forget('team');
        }catch(Exception $e){
            $this->emit('alert', 'error', $e->getMessage());
        }
    }
}
