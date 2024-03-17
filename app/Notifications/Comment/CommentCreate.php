<?php

namespace App\Notifications\Comment;

use App\Models\BlogPost;
use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CommentCreate extends Notification
{
    use Queueable;

    private $model;
    private $comment;
    private $url;
    private $title;

    public function __construct($model, $comment){
        $this->model = $model;
        $this->comment = $comment;
        if($this->model instanceof Product):
            $this->url = route('admin.catalog.product.show', ['product' => $this->model, 'submodule' => 'comments']);
            $this->title = 'Nuevo comentario de producto';

        elseif($this->model instanceof BlogPost):
            $this->url = route('admin.blog.post.show', $this->model).'#comments';
            $this->title = 'Nuevo comentario de blog';
        endif;
    }
    public function via($notifiable){
        return ['database'];
    }
    public function toArray($notifiable){
        return [
            'url' => $this->url ?? '',
            'icon' => 'fas fa-comments',
            'type' => 'success',
            'title' => $this->title ?? '',
            'body' => $this->comment->body
        ];
    }
}
