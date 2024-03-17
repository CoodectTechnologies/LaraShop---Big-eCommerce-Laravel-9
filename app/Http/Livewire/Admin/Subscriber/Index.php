<?php

namespace App\Http\Livewire\Admin\Subscriber;

use App\Models\Subscriber;
use Exception;
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
        $subscribers = Subscriber::query()->orderBy('id', 'desc');
        if($this->search):
            $subscribers = $subscribers->where('email', 'LIKE', "%{$this->search}%")->orWhere('email', 'LIKE', "%{$this->search}%");
        endif;
        $subscribers = $subscribers->paginate($this->perPage);
        return view('livewire.admin.subscriber.index', compact('subscribers'));
    }
    public function destroy(Subscriber $subscriber){
        try{
            $subscriber->delete();
            $this->emit('alert', 'success', __('Successful elimination'));
        }catch(Exception $e){
            $this->emit('alert', 'error', $e->getMessage());
        }
    }
}
