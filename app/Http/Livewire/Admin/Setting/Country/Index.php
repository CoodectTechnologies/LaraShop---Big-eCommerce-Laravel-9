<?php

namespace App\Http\Livewire\Admin\Setting\Country;

use App\Models\Country;
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

    //filters
    public $statusFilter;

    public function updatingSearch(){
        $this->resetPage();
    }
    public function render(){
        $countries = Country::query()->with('states')->orderBy('name');
        if($this->search):
            $countries = $countries->where('name', 'LIKE', "%{$this->search}%");
        endif;
        if($this->statusFilter):
            $countries = $countries->where('status', $this->statusFilter);
        endif;
        $countries = $countries->paginate($this->perPage);
        return view('livewire.admin.setting.country.index', compact('countries'));
    }
    public function destroy(Country $permission){
        try{
            $permission->delete();
            $this->emit('alert', 'success', __('Successful elimination'));
        }catch(Exception $e){
            $this->emit('alert', 'error', $e->getMessage());
        }
    }
}
