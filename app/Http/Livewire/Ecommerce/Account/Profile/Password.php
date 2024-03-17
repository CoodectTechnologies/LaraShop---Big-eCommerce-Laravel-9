<?php

namespace App\Http\Livewire\Ecommerce\Account\Profile;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Livewire\Component;

class Password extends Component
{
    public $user;
    public $password;
    public $password_confirmation;

    protected function rules(){
        return [
            'password' => 'required|min:8|confirmed',
            'password_confirmation' => 'required'
        ];
    }
    public function mount(){
        $this->user = User::find(Auth::id());
    }
    public function render(){
        return view('livewire.ecommerce.account.profile.password');
    }
    public function update(){
        $this->validate();
        $this->user->password = Hash::make($this->password);
        $this->user->update();
        session()->flash('alert', 'Contraseña cambiada correctamente');
        session()->flash('alert-type', 'success');
        Redirect::route('login');
    }
}
