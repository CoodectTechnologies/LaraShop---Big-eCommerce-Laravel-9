<?php

namespace App\Http\Livewire\Admin\Promotion;

use App\Models\Promotion;
use Exception;
use Livewire\Component;

class Index extends Component
{

    public $search;
    protected $queryString = ['search' => ['except' => '']];
    protected $listeners = ['render'];

    public function render(){
        $promotions = Promotion::query()->with(['products', 'currencies'])->orderBy('id', 'desc');
        if($this->search):
            $promotions = $promotions->where('name', 'LIKE', "%{$this->search}%");
        endif;
        $promotions = $promotions->get();
        return view('livewire.admin.promotion.index', compact('promotions'));
    }
    public function destroy(Promotion $promotion){
        try{
            $promotion->delete();
            $this->emit('alert', 'success', __('Successful elimination'));
        }catch(Exception $e){
            $this->emit('alert', 'error', $e->getMessage());
        }
    }
}
