<?php

namespace App\Http\Livewire\Admin\Setting\State;

use App\Models\Country;
use App\Models\State;
use Livewire\Component;

class Form extends Component
{
    public $state;
    public $method;

    public function mount(State $state, $method){
        $this->state = $state;
        $this->method = $method;
    }
    protected function rules(){
        return [
            'state.country_id' => 'required|exists:countries,id',
            'state.name' => 'required|unique:states,name,'.$this->state->id,
        ];
    }
    public function render(){
        $countries = Country::orderBy('name')->get();
        return view('livewire.admin.setting.state.form', compact('countries'));
    }
    public function store(){
        $this->validate();
        $this->state->save();
        $this->emit('alert', 'success', __('Registration successfully added'));
        $this->emit('render');
        $this->state = new State();
    }
    public function update(){
        $this->validate();
        $this->state->update();
        $this->emit('alert', 'success', __('Registration successfully updated'));
        $this->emit('render');
    }
}
