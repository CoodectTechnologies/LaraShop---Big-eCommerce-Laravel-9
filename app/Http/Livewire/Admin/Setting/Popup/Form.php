<?php

namespace App\Http\Livewire\Admin\Setting\Popup;

use App\Models\Popup;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Form extends Component
{
    use WithFileUploads;

    public $popup;
    public $method;
    public $imageTmp;

    protected function rules(){
        return [
            'popup.active' => 'nullable',
            'popup.title' => 'required',
            'popup.title_color' => 'nullable',
            'popup.subtitle' => 'required',
            'popup.subtitle_color' => 'nullable',
            'popup.description' => 'nullable',
            'popup.description_color' => 'nullable',
            'popup.btn_url' => 'nullable',
            'popup.btn_text' => 'nullable',
            'popup.newsletter' => 'nullable',
        ];
    }
    public function mount(Popup $popup, $method){
        $this->popup = $popup;
        $this->method = $method;
    }
    public function render(){
        return view('livewire.admin.setting.popup.form');
    }
    public function update(){
        $this->validate();
        $this->popup->save();
        $this->saveImage();
        $this->emit('alert', 'success', __('Registration successfully updated'));
        $this->emit('render');
    }
    public function saveImage(){
        if($this->imageTmp):
            $url = $this->imageTmp->store('public/popup/');
            imageManager($url, 600, $this->popup);
        endif;
    }
    public function removeImage(){
        if($this->popup->image):
            if(Storage::exists($this->popup->image->url)):
                Storage::delete($this->popup->image->url);
            endif;
            $this->popup->image()->delete();
            $this->popup->image = null;
        endif;
        $this->reset('imageTmp');
        $this->emit('alert', 'success', __('Image successfully deleted'));
    }
}
