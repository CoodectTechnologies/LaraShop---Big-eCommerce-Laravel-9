<?php

namespace App\Http\Livewire\Ecommerce\Account\Profile;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Form extends Component
{
    public $user;

    protected function rules(){
        return [
            'user.name' => 'required',
            'user.email' => 'required|email|unique:users,email,'.$this->user->id,
        ];
    }
    public function mount(){
        $this->user = User::find(Auth::id());
    }
    public function render(){
        return view('livewire.ecommerce.account.profile.form');
    }
    public function update(){
        $this->validate();
        $this->user->save();
        session()->flash('alert', 'Datos guardados correctamente');
        session()->flash('alert-type', 'success');
    }
}
