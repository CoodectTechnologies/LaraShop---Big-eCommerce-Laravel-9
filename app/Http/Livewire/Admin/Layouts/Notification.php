<?php

namespace App\Http\Livewire\Admin\Layouts;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Livewire\Component;

class Notification extends Component
{
    public $user;
    protected $listeners = ['render'];

    public function mount(){
        $this->user = User::findOrFail(Auth::id());
    }
    public function render(){
        $notifications = $this->user->unreadNotifications()->take(10)->get();
        return view('livewire.admin.layouts.notification', compact('notifications'));
    }
    public function markAndRedirect($id, $url){
        $this->user->notifications()->where('id', $id)->update(['read_at' => now()]);
        return redirect($url);
    }
}
