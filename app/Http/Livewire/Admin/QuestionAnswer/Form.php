<?php

namespace App\Http\Livewire\Admin\QuestionAnswer;

use App\Models\QuestionAnswer;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class Form extends Component
{
    public $questionAnswer;
    public $method;
    public $imageTmp;

    protected function rules(){
        return [
            'questionAnswer.question.'.translatable() => 'required',
            'questionAnswer.answer.'.translatable() => 'required',
        ];
    }
    public function mount(QuestionAnswer $questionAnswer, $method){
        $this->questionAnswer = $questionAnswer;
        $this->method = $method;
    }
    public function render(){
        return view('livewire.admin.question-answer.form');
    }
    public function store(){
        $this->validate();
        $this->questionAnswer->save();
        $this->questionAnswer = new QuestionAnswer();
        $this->reset('imageTmp');
        $this->emit('alert', 'success', 'Agregado con éxito');
        $this->emit('render');
    }
    public function update(){
        $this->validate();
        $this->questionAnswer->update();
        $this->emit('alert', 'success', 'Actualización con éxito');
        $this->emit('render');
    }
}
