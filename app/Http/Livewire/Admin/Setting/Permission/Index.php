<?php

namespace App\Http\Livewire\Admin\Setting\Permission;

use Exception;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Permission;

class Index extends Component
{
    use WithPagination;

    public $perPage = 10;
    public $search;
    protected $queryString = ['search' => ['except' => '']];
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['render'];

    public function updatingSearch(){
        $this->resetPage();
    }
    public function render(){
        $permissions = Permission::query()->with('roles')->orderBy('id', 'desc');
        if($this->search){
            $permissions = $permissions->where('name', 'LIKE', "%{$this->search}%");
        }
        $permissions = $permissions->paginate($this->perPage);
        return view('livewire.admin.setting.permission.index', compact('permissions'));
    }
    public function destroy(Permission $permission){
        try{
            $permission->delete();
            $this->emit('alert', 'success', __('Successful elimination'));
        }catch(Exception $e){
            $this->emit('alert', 'error', $e->getMessage());
        }
    }
}
