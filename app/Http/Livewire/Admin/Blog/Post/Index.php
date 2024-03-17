<?php

namespace App\Http\Livewire\Admin\Blog\Post;

use App\Models\BlogPost;
use Exception;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $perPage = 50;
    public $search;
    protected $queryString = ['search' => ['except' => '']];
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['render'];

    public function updatingSearch(){
        $this->resetPage();
    }
    public function render(){
        $posts = BlogPost::with(['user.image', 'comments', 'image', 'blogCategories'])->orderBy('id', 'desc');
        if($this->search):
            $posts = $posts->where('name', 'LIKE', "%{$this->search}%");
        endif;
        $posts = $posts->paginate($this->perPage);
        return view('livewire.admin.blog.post.index', compact('posts'));
    }
    public function destroy(BlogPost $post){
        try{
            if($post->image):
                if(Storage::exists($post->image->url)):
                    Storage::delete($post->image->url);
                endif;
                $post->image()->delete();
            endif;
            $post->delete();
            $this->emit('alert', 'success', __('Successful elimination'));
        }catch(Exception $e){
            $this->emit('alert', 'error', $e->getMessage());
        }
    }
}
