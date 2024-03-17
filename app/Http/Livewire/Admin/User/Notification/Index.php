<?php

namespace App\Http\Livewire\Admin\User\Notification;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $perPage = 20;
    protected $paginationTheme = 'bootstrap';

    public $user;
    public $filterReadAt = 'Sin leer';

    public function mount(User $user){
        $this->user = $user;
    }
    public function render(){
        if($this->filterReadAt == 'Sin leer'):
            $notifications = $this->user->unreadNotifications();
        else:
            $notifications = $this->user->readNotifications();
        endif;
        $notifications = $notifications->paginate($this->perPage, ['*'], 'pageNotification');
        return view('livewire.admin.user.notification.index', compact('notifications'));
    }
    public function markAllAsRead(){
        $this->user->unreadNotifications()->update(['read_at' => now()]);
        $this->emitTo('admin.layouts.notification', 'render');
    }
    public function markAndRedirect($id, $url){
        $this->user->notifications()->where('id', $id)->update(['read_at' => now()]);
        return Redirect::to($url);
    }
}
