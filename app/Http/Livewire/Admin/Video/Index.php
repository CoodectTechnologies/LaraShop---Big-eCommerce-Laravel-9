<?php

namespace App\Http\Livewire\Admin\Video;

use App\Models\ModuleWeb;
use App\Models\Video;
use Exception;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class Index extends Component
{
    protected $listeners = ['render'];

    public function render(){
        $videos = Video::orderByDesc('id')->get();
        return view('livewire.admin.video.index', compact('videos'));
    }
    public function destroy(Video $video){
        try{
            if(Storage::exists($video->video)):
                Storage::delete($video->video);
            endif;
            $video->delete();
            $this->emit('alert', 'success', __('Successful elimination'));
        }catch(Exception $e){
            $this->emit('alert', 'error', $e->getMessage());
        }
    }
}
