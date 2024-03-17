<?php

namespace App\Mail\Blog;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PostCreate extends Mailable
{
    use Queueable, SerializesModels;

    private $blogPost;

    public function __construct($blogPost){
        $this->blogPost = $blogPost;
    }
    public function build(){
        return $this->subject('Nuevo post: '.$this->blogPost->name)->markdown('emails.post.create', [
            'blogPost' => $this->blogPost,
        ]);
    }
}
