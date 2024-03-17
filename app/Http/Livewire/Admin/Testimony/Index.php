<?php

namespace App\Http\Livewire\Admin\Testimony;

use App\Models\Testimony;
use Exception;
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
        $testimonies = Testimony::query()->with('image')->orderBy('id', 'desc');
        if($this->search):
            $testimonies = $testimonies->where('name', 'LIKE', "%{$this->search}%");
        endif;
        $testimonies = $testimonies->paginate($this->perPage);
        return view('livewire.admin.testimony.index', compact('testimonies'));
    }
    public function destroy(Testimony $testimony){
        try{
            if($testimony->image):
                if(Storage::exists($testimony->image->url)):
                    Storage::delete($testimony->image->url);
                endif;
                $testimony->image()->delete();
            endif;
            $testimony->delete();
            $this->emit('alert', 'success', __('Successful elimination'));
        }catch(Exception $e){
            $this->emit('alert', 'error', $e->getMessage());
        }
    }
}
