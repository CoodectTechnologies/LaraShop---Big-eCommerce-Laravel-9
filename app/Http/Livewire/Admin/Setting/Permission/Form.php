<?php

namespace App\Http\Livewire\Admin\Setting\Permission;

use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class Form extends Component
{
    public $permission;
    public $method;

    public function mount(Permission $permission, $method){
        $this->permission = $permission;
        $this->method = $method;
    }
    protected function rules(){
        return [
            'permission.name' => 'required|unique:permissions,name,'.$this->permission->id,
        ];
    }
    public function render(){
        return view('livewire.admin.setting.permission.form');
    }
    public function store(){
        $this->validate();
        $this->permission->save();
        $this->assingToAdmin();
        $this->emit('alert', 'success', __('Registration successfully added'));
        $this->emit('render');
        $this->permission = new Permission();
    }
    public function update(){
        $this->validate();
        $this->permission->update();
        $this->emit('alert', 'success', __('Registration successfully updated'));
        $this->emit('render');
    }
    public function assingToAdmin(){
        $admin = Role::where('name', 'Administrador')->first();
        $admin->givePermissionTo($this->permission->name);
    }
}
