<?php

namespace App\Http\Livewire\Admin\User\Permission;

use App\Models\User;
use Livewire\Component;
use Spatie\Permission\Models\Permission;

class Form extends Component
{
    public $user;
    public $userPermissionsDirectArray  = [];

    protected function rules(){
        return [
            'userPermissionsDirectArray' => 'nullable|array|exists:permissions,name',
        ];
    }
    public function mount(User $user){
        $this->user = $user;
        $this->userPermissionsDirectArray = $this->user->permissions()->pluck('name')->toArray();
    }  
    public function render(){
        $permissions = Permission::orderBy('id', 'desc')->get();
        return view('livewire.admin.user.permission.form', compact('permissions'));
    }
    public function update(){
        $this->validate();
        $this->user->syncPermissions($this->userPermissionsDirectArray);
        $this->emit('alert', 'success', 'Actualización con éxito');
        $this->emit('render');
    }
}
