<?php

namespace App\Http\Livewire\Admin\Comment;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Form extends Component
{
    public $model;
    public $comment;
    public $method;
    public $userPresent;

    public function mount($model, Comment $comment, $method){
        $this->model = $model;
        $this->comment = $comment;
        $this->method = $method;
        $this->userPresent = User::find(Auth::id());
    }
    protected function rules(){
        return [
            'comment.stars' => 'required',
            'comment.name' => 'required',
            'comment.body' => 'required'
        ];
    }
    public function render(){
        return view('livewire.admin.comment.form');
    }
    public function store(){
        $this->validate();
        // $this->comment->user_id = Auth::id();
        $this->comment->approved = true;
        $this->model->comments()->create($this->comment->toArray());
        $this->comment = new Comment();
        $this->emit('alert', 'success', 'Creación con éxito');
        $this->emit('render');
    }
    public function update(){
        $this->validate();
        $this->comment->update();
        $this->emit('alert', 'success', 'Actualización con éxito');
        $this->emit('render');
    }
}
