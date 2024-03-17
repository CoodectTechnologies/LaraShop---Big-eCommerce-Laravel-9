<?php

namespace App\Http\Livewire\Admin\About;

use App\Models\About;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class Form extends Component
{
    public $about;
    public $method;

    protected function rules(){
        return [
            'about.information.'.translatable() => 'required',
            'about.mission.'.translatable() => 'required',
            'about.vision.'.translatable() => 'required',
            'about.values.'.translatable() => 'required',
        ];
    }
    public function mount(About $about, $method){
        $this->about = $about;
        $this->method = $method;
    }
    public function render(){
        return view('livewire.admin.about.form');
    }
    public function store(){
        $this->validate();
        $this->about->save();
        $this->about = new About();
        Cache::forget('about');
        $this->emit('alert', 'success', __('Registration successfully added'));
        $this->emit('render');
    }
    public function update(){
        $this->validate();
        $this->about->update();
        Cache::forget('about');
        $this->emit('alert', 'success', __('Registration successfully updated'));
        $this->emit('render');
    }
}
