<?php

namespace App\Http\Livewire\Admin\Setting\Role;

use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class Form extends Component
{
    public $role;
    public $method;
    public $permissionsArray = [];

    protected function rules(){
        return [
            'role.name' => 'required',
        ];
    }
    public function mount(Role $role, $method){
        $this->role = $role;
        $this->method = $method;
        $this->permissionsArray = $role->permissions->pluck('name')->toArray();
    }
    public function render(){
        $permissions = Permission::orderBy('id', 'desc')->get();
        return view('livewire.admin.setting.role.form', compact('permissions'));
    }
    public function store(){
        $this->validate();
        $this->role->save();
        $this->savePermission();
        $this->role = new Role();
        $this->reset('permissionsArray');
        $this->emit('alert', 'success', __('Registration successfully added'));
        $this->emit('render');
    }
    public function update(){
        $this->validate();
        $this->role->update();
        $this->savePermission();
        $this->emit('alert', 'success', __('Registration successfully updated'));
        $this->emit('render');
    }
    public function savePermission(){
        $this->role->syncPermissions($this->permissionsArray);
    }
}
