<?php

namespace App\Http\Livewire\Admin\Dashboard\General;

use App\Models\BlogPost;
use App\Models\Comment;
use App\Models\EmailWeb;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Spatie\Activitylog\Models\Activity;

class Index extends Component
{
    public $year;
    public $user;

    public function mount(){
        $this->year = date('Y');
        $this->user = User::findOrFail(Auth::id());
    }
    public function render(){
        return view('livewire.admin.dashboard.general.index');
    }
    public function getOrdersCountProperty(){
        return Order::count();
    }
    public function getBlogPostsCountProperty(){
        return BlogPost::count();
    }
    public function getCommentsCountProperty(){
        return Comment::count();
    }
    public function getEmailsWebCountProperty(){
        return EmailWeb::count();
    }
    public function getOrdersProperty(){
        return Order::with('products')->orderBy('id', 'desc')->take(3)->get();
    }
    public function getBlogPostsProperty(){
       return BlogPost::with(['comments', 'blogCategories', 'blogTags'])->orderBy('id', 'desc')->take(3)->get();
    }
    public function getCommentsProperty(){
        return Comment::orderBy('id', 'desc')->take(10)->get();
    }
    public function getEmailsWebProperty(){
        return EmailWeb::orderBy('id', 'desc')->take(10)->get();
    }
    public function getLogsProperty(){
        return $this->user->actions()->orderBy('id', 'desc')->take(10)->get();
    }
    public function getNotificationsProperty(){
        return $this->user->unreadNotifications()->take(10)->get();
    }
}
