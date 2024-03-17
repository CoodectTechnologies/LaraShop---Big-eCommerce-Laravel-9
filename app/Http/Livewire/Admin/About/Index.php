<?php

namespace App\Http\Livewire\Admin\About;

use App\Models\About;
use Exception;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class Index extends Component
{
    protected $listeners = ['render'];

    public function render(){
        if(Cache::has('about')):
            $about = Cache::get('about');
        else:
            $about = About::first();
            Cache::put('about', $about);
        endif;
        return view('livewire.admin.about.index', compact('about'));
    }
    public function destroy(About $about){
        try{
            $about->delete();
            Cache::forget('about');
            $this->emit('alert', 'success', __('Successful elimination'));
        }catch(Exception $e){
            $this->emit('alert', 'error', $e->getMessage());
        }
    }
}
