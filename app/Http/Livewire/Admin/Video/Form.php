<?php

namespace App\Http\Livewire\Admin\Video;

use App\Models\Video;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Form extends Component
{
    use WithFileUploads;

    public $video;
    public $method;
    public $videoTmp;

    protected function rules(){
        return [
            'video.platform' => 'required',
            'video.url' => in_array($this->video->platform, [Video::PLATFORM_YOUTUBE, Video::PLATFORM_VIMEO]) ? 'required|url' : 'nullable',
            'videoTmp' => in_array($this->video->platform, [Video::PLATFORM_LOCAL]) ? 'required' : 'nullable',
        ];
    }
    public function mount(Video $video, $method){
        $this->video = $video;
        $this->method = $method;
    }
    public function render(){
        return view('livewire.admin.video.form');
    }
    public function store(){
        $this->validate();
        $this->_saveIframe();
        $this->video->save();
        $this->video = new Video();
        $this->emit('alert', 'success', __('Registration successfully added'));
        $this->emit('render');
    }
    public function update(){
        $this->validate();
        $this->_saveIframe();
        $this->video->update();
        $this->emit('alert', 'success', __('Registration successfully updated'));
        $this->emit('render');
    }
    public function removeVideo(){
        if($this->video->video):
            if(Storage::exists($this->video->video)):
                Storage::delete($this->video->video);
            endif;
            $this->video->video = null;
            $this->video->update();
        endif;
        $this->reset('videoTmp');
        $this->emit('alert', 'success', __('Video successfully deleted'));
    }
    private function _saveIframe(){
        $url = $this->video->url;
        $platform = $this->video->platform;
        if($platform == Video::PLATFORM_YOUTUBE):
            $this->validate([
                'video.url' => ['regex:%^ (?:https?://)? (?:www\.)? (?: youtu\.be/ | youtube\.com (?: /embed/ | /v/ | /watch\?v= ) ) ([\w-]{10,12}) $%x']
            ]);
            $patron = '%^ (?:https?://)? (?:www\.)? (?: youtu\.be/ | youtube\.com (?: /embed/ | /v/ | /watch\?v= ) ) ([\w-]{10,12}) $%x';
            $array = preg_match($patron, $url, $parte);
            $this->video->iframe = '<iframe width="100%" height="315" src="https://www.youtube.com/embed/'. $parte[1] .'" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
        elseif($platform == Video::PLATFORM_VIMEO):
            $this->validate([
                'video.url' => ['regex:/\/\/(www\.)?vimeo.com\/(\d+)($|\/)/']
            ]);
            $patron = '/\/\/(www\.)?vimeo.com\/(\d+)($|\/)/';
            $array = preg_match($patron, $url, $parte);
            $this->video->iframe = '<iframe src="https://player.vimeo.com/video/' . $parte[2] . '" width="100%" height="360" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>';
        elseif($platform == Video::PLATFORM_LOCAL):
            if($this->videoTmp):
                $url = $this->videoTmp->store('public/video');
                if($this->video->video):
                    if(Storage::exists($this->video->video)):
                        Storage::delete($this->video->video);
                    endif;
                    $this->video->video = $url;
                else:
                    $this->video->video = $url;
                endif;
            endif;
        else:
            $this->emit('alert', 'warning', 'Plataforma no reconocida: '.$platform);
            return false;
        endif;
    }
}
