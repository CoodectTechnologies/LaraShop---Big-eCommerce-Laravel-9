<?php

namespace App\Mail\Comment;

use App\Models\BlogPost;
use App\Models\Comment;
use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CommentCreate extends Mailable
{
    use Queueable, SerializesModels;

    private $model;
    private $comment;
    private $url;
    private $title;

    public function __construct($model, Comment $comment){
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
    public function build(){
        return $this->subject('Nuevo comentario: '.$this->model->name)->markdown('emails.comment.create', [
            'model' => $this->model,
            'comment' => $this->comment,
            'url' => $this->url,
            'title' => $this->title
        ]);
    }
}
