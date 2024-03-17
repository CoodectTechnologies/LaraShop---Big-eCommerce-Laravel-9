<?php

namespace App\Http\Livewire\Admin\Testimony;

use App\Models\Testimony;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Form extends Component
{
    use WithFileUploads;

    public $testimony;
    public $method;
    public $imageTmp;

    protected function rules(){
        return [
            'testimony.name.'.translatable() => 'required',
            'testimony.position.'.translatable() => 'required',
            'testimony.body.'.translatable() => 'required',
            'imageTmp' => $this->testimony->image ? 'image|nullable' : 'image|required',
        ];
    }
    public function mount(Testimony $testimony, $method){
        $this->testimony = $testimony;
        $this->method = $method;
    }
    public function render(){
        return view('livewire.admin.testimony.form');
    }
    public function store(){
        $this->validate();
        $this->testimony->save();
        $this->saveImage();
        $this->testimony = new Testimony();
        $this->reset('imageTmp');
        $this->emit('alert', 'success', 'Testimonio agregado con éxito');
        $this->emit('render');
    }
    public function update(){
        $this->validate();
        $this->testimony->update();
        $this->saveImage();
        $this->emit('alert', 'success', 'Actualización con éxito');
        $this->emit('render');
    }
    public function saveImage(){
        if($this->imageTmp):
            $url = $this->imageTmp->store('public/testimony');
            imageManager($url, 200, $this->testimony);
        endif;
    }
    public function removeImage(){
        if($this->testimony->image):
            if(Storage::exists($this->testimony->image->url)):
                Storage::delete($this->testimony->image->url);
            endif;
            $this->testimony->image()->delete();
            $this->testimony->image = null;
        endif;
        $this->reset('imageTmp');
        $this->emit('alert', 'success', __('Image successfully deleted'));
    }
}
