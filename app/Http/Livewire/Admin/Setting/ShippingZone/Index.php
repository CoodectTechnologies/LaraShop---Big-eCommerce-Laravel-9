<?php

namespace App\Http\Livewire\Admin\Setting\ShippingZone;

use App\Models\ShippingZone;
use App\Models\State;
use Exception;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Artisan;
use Jackiedo\DotenvEditor\Facades\DotenvEditor;
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
        $shippingZones = ShippingZone::query()->with(['country', 'states'])->orderBy('id', 'desc');
        if($this->search):
            $shippingZones = $shippingZones->where('name', 'LIKE', "%{$this->search}%")
            ->orWhereRelation('states', 'name', 'LIKE', "%{$this->search}%");
        endif;
        $shippingZones = $shippingZones->paginate($this->perPage);
        return view('livewire.admin.setting.shipping-zone.index', compact('shippingZones'));
    }
    public function destroy(ShippingZone $shippingZone){
        try{
            $shippingZone->delete();
            $this->emit('alert', 'success', __('Successful elimination'));
        }catch(Exception $e){
            $this->emit('alert', 'error', $e->getMessage());
        }
    }
}
