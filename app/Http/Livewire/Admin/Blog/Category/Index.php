<?php

namespace App\Http\Livewire\Admin\Blog\Category;

use App\Models\BlogCategory;
use Exception;
use Illuminate\Support\Facades\Cache;
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
        $blogCategories = BlogCategory::with('blogPosts')->orderBy('id', 'desc');
        if($this->search):
            $blogCategories = $blogCategories->where('name', 'LIKE', "%{$this->search}%");
        endif;
        $blogCategories = $blogCategories->get();
        return view('livewire.admin.blog.category.index', compact('blogCategories'));
    }
    public function destroy(BlogCategory $blogCategory){
        try{
            $blogCategory->delete();
            $this->emit('alert', 'success', __('Successful elimination'));
        }catch(Exception $e){
            $this->emit('alert', 'error', $e->getMessage());
        }
    }
}
