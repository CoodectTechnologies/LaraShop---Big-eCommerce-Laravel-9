<?php

namespace App\Http\Livewire\Ecommerce\Comment;

use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $perPage = 10;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['render'];

    public $model;

    public function mount($model){
        $this->model = $model;
        $this->model->load('comments');
    }
    public function render(){
        $comments = $this->model->comments()->validate()->orderByDesc('id')->paginate($this->perPage, ['*'], 'page-comment');
        return view('livewire.ecommerce.comment.index', compact('comments'));
    }
}
