<?php

namespace App\Http\Livewire\Ecommerce\Comment;


use App\Notifications\Comment\CommentCreate as NotificationCommentCreate;
use App\Mail\Comment\CommentCreate as MailCommentCreate;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\Comment;
use App\Models\User;
use Exception;
use Livewire\Component;
use Lukeraymonddowning\Honey\Traits\WithRecaptcha;

class Form extends Component
{
    use WithRecaptcha;

    public $model;
    public $comment;

    public function mount($model, Comment $comment){
        $this->model = $model;
        $this->comment = $comment;
        $this->comment->name = Auth::check() ? Auth::user()->name : '';
        $this->comment->email = Auth::check() ? Auth::user()->email : '';
    }
    protected function rules(){
        return [
            'comment.name' => 'required',
            'comment.email' => 'required|email',
            'comment.stars' => 'required|min:1|max:5',
            'comment.body' => 'required'
        ];
    }
    public function render(){
        return view('livewire.ecommerce.comment.form');
    }
    public function store(){
        $this->validate();
        if(!$this->recaptchaPasses()):
            session()->flash('alert-comment','¡Ups! ocurrio un error.');
            session()->flash('alert-comment-type', 'danger');
        else:
            $this->comment->user_id = Auth::id() ?? null;
            $this->comment->approved = false;
            $this->comment = $this->model->comments()->create($this->comment->toArray());
            $this->notifyUsers();
            $this->comment = new Comment();
            session()->flash('alert-comment-type', 'success');
            session()->flash('alert-comment', __('The comment has been sent, for security reasons it will be reviewed before being published'));
        endif;
    }
    private function notifyUsers(){
        Notification::send(
            User::permission(['comentarios'])->get(),
            new NotificationCommentCreate($this->model, $this->comment)
        );
        Mail::to(config('contact.email'))
        ->bcc(
            User::permission(['comentarios'])
            ->where('email', '<>', config('contact.email'))
            ->pluck('email'))
        ->send(new MailCommentCreate($this->model, $this->comment));
    }
}
