<?php

namespace App\Http\Livewire\Admin\Partner;

use App\Models\Partner;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Form extends Component
{
    use WithFileUploads;

    public $partner;
    public $method;
    public $imageTmp;

    protected function rules(){
        return [
            'partner.name.'.translatable() => 'required',
            'imageTmp' => $this->partner->image ? 'image|nullable' : 'image|required',
        ];
    }
    public function mount(Partner $partner, $method){
        $this->partner = $partner;
        $this->method = $method;
    }
    public function render(){
        return view('livewire.admin.partner.form');
    }
    public function store(){
        $this->validate();
        $this->partner->save();
        $this->saveImage();
        $this->partner = new Partner();
        Cache::forget('partners');
        $this->reset('imageTmp');
        $this->emit('alert', 'success', __('Registration successfully added'));
        $this->emit('render');
    }
    public function update(){
        $this->validate();
        $this->partner->update();
        $this->saveImage();
        Cache::forget('partners');
        $this->emit('alert', 'success', __('Registration successfully updated'));
        $this->emit('render');
    }
    public function saveImage(){
        if($this->imageTmp):
            $url = $this->imageTmp->store('public/partner');
            imageManager($url, 200, $this->partner);
        endif;
    }
    public function removeImage(){
        if($this->partner->image):
            if(Storage::exists($this->partner->image->url)):
                Storage::delete($this->partner->image->url);
            endif;
            $this->partner->image()->delete();
            $this->partner->image = null;
        endif;
        $this->reset('imageTmp');
        $this->emit('alert', 'success', __('Image successfully deleted'));
    }
}
