<?php

namespace App\Http\Livewire\Admin\Configurator\Game;

use App\Models\ConfiguratorGame;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Form extends Component
{
    use WithFileUploads;

    public $configuratorGame;
    public $method;
    public $imageTmp;

    protected function rules(){
        return [
            'configuratorGame.name' => 'required'
        ];
    }
    public function mount(ConfiguratorGame $configuratorGame, $method){
        $this->configuratorGame = $configuratorGame;
        $this->method = $method;
    }
    public function render(){
        return view('livewire.admin.configurator.game.form');
    }
    public function store(){
        $this->validate();
        $this->configuratorGame->save();
        $this->saveImage();
        $this->reset('imageTmp');
        $this->emit('alert', 'success', __('Registration successfully added'));
        $this->emit('render');
    }
    public function update(){
        $this->validate();
        $this->configuratorGame->update();
        $this->saveImage();
        $this->emit('alert', 'success', __('Registration successfully updated'));
        $this->emit('render');
    }
    public function saveImage(){
        if($this->imageTmp):
            $url = $this->imageTmp->store('public/configurator/game');
            imageManager($url, 300, $this->configuratorGame);
        endif;
    }
    public function removeImage(){
        if($this->configuratorGame->image):
            if(Storage::exists($this->configuratorGame->image->url)):
                Storage::delete($this->configuratorGame->image->url);
            endif;
            $this->configuratorGame->image()->delete();
            $this->configuratorGame->image = null;
        endif;
        $this->reset('imageTmp');
        $this->emit('alert', 'success', __('Image successfully deleted'));
    }
}
