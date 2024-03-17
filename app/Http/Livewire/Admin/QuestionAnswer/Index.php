<?php

namespace App\Http\Livewire\Admin\QuestionAnswer;

use App\Models\QuestionAnswer;
use Exception;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class Index extends Component
{
    protected $listeners = ['render'];

    public function render(){
        $questionAnswers = QuestionAnswer::orderBy('id', 'desc')->get();
        return view('livewire.admin.question-answer.index', compact('questionAnswers'));
    }
    public function destroy(QuestionAnswer $questionAnswer){
        try{
            $questionAnswer->delete();
            $this->emit('alert', 'success', __('Successful elimination'));
        }catch(Exception $e){
            $this->emit('alert', 'error', $e->getMessage());
        }
    }
}
