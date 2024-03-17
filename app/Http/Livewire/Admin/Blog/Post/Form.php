<?php

namespace App\Http\Livewire\Admin\Blog\Post;

use App\Models\BlogCategory;
use App\Models\BlogPost;
use App\Models\BlogTag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Form extends Component
{
    use WithFileUploads;

    public $method;
    public $post;
    public $imageTmp;
    public $postCategoryArray = [];
    public $postTagArray = [];

    protected $listeners = ['render'];

    public function mount(BlogPost $post, $method){
        $this->post = $post;
        $this->method = $method;
        $this->postCategoryArray = $this->post->blogCategories()->pluck('blog_category_id')->toArray();
        $this->postTagArray = $this->post->blogTags()->pluck('blog_tag_id')->toArray();
    }
    protected function rules(){
        return [
            'post.name.'.translatable() => 'required|unique_translation:blog_posts,name,'.$this->post->id,
            'post.fragment.'.translatable() => 'required',
            'post.body.'.translatable() => 'required',
            'post.status' => 'required',
            'post.meta_title.'.translatable() => 'nullable',
            'post.meta_description.'.translatable() => 'nullable',
            'post.meta_keywords.'.translatable() => 'nullable',
            'imageTmp' => $this->post->image ? 'image|nullable' : 'image|required',
        ];
    }
    public function render(){
        $blogCategories = BlogCategory::orderBy('id', 'desc')->get();
        $blogTags = BlogTag::orderBy('id', 'desc')->get();
        return view('livewire.admin.blog.post.form', compact('blogCategories', 'blogTags'));
    }
    public function store(){
        $this->validate();
        $this->post->user_id = Auth::id();
        $this->post->save();
        $this->saveImage();
        $this->saveCategories();
        $this->saveTags();
        session()->flash('alert', __('Registration successfully added'));
        session()->flash('alert-type', 'success');
        return redirect()->route('admin.blog.post.show', $this->post);
    }
    public function update(){
        $this->validate();
        $this->post->update();
        $this->saveImage();
        $this->saveCategories();
        $this->saveTags();
        session()->flash('alert', __('Registration successfully added'));
        session()->flash('alert-type', 'success');
        return redirect()->route('admin.blog.post.show', $this->post);
    }
    public function saveImage(){
        if($this->imageTmp):
            $url = $this->imageTmp->store('public/blog/post');
            imageManager($url, 1920, $this->post);
        endif;
    }
    public function removeImage(){
        if($this->post->image):
            if(Storage::exists($this->post->image->url)):
                Storage::delete($this->post->image->url);
            endif;
            $this->post->image()->delete();
            $this->post->image = null;
        endif;
        $this->reset('imageTmp');
        $this->emit('alert', 'success', __('Image successfully deleted'));
    }
    public function saveCategories(){
        $this->post->blogCategories()->sync($this->postCategoryArray);
    }
    public function saveTags(){
        $this->post->blogTags()->sync($this->postTagArray);
    }
}
