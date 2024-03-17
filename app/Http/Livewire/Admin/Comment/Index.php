<?php

namespace App\Http\Livewire\Admin\Comment;

use App\Models\Comment;
use Exception;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $perPage = 20;
    public $searchComment;
    protected $queryString = ['searchComment' => ['except' => '']];
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['render'];

    public $model;

    public function mount($model){
        $this->model = $model;
    }
    public function render(){
        $comments = $this->model->comments()->orderByDesc('id');
        if($this->searchComment):
            $comments = $comments->where('body', 'LIKE', "%{$this->searchComment}%");
        endif;
        $comments = $comments->paginate($this->perPage, ['*'], 'page-comment');
        return view('livewire.admin.comment.index', compact('comments'));
    }
    public function updatingSearchComment(){
        $this->resetPage();
    }
    public function refused(Comment $comment){
        $comment->approved = false;
        $comment->update();
        $this->emit('alert', 'success', __('Comment successfully rejected'));
    }
    public function approved(Comment $comment){
        $comment->approved = true;
        $comment->update();
        $this->emit('alert', 'success', __('Comment successfully approved'));
    }
    public function destroy(Comment $comment){
        try{
            $comment->delete();
            $this->emit('alert', 'success', __('Successful elimination'));
        }catch(Exception $e){
            $this->emit('alert', 'error', $e->getMessage());
        }
    }
}
