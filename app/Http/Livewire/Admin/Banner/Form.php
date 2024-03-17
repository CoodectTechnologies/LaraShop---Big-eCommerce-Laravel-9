<?php

namespace App\Http\Livewire\Admin\Banner;

use App\Models\Banner;
use App\Models\ModuleWeb;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Form extends Component
{
    use WithFileUploads;

    public $banner;
    public $method;
    public $imageTmp, $videoTmp;
    //Tools
    public $order;

    protected function rules(){
        return [
            'banner.module_web_id' => 'required|exists:module_webs,id',
            'banner.order' => 'nullable',
            'banner.type' => 'required',
            'banner.title.'.translatable() => 'nullable',
            'banner.subtitle.'.translatable() => 'nullable',
            'banner.btn_url' => 'nullable|url',
            'banner.btn_text.'.translatable() => 'nullable',
            'banner.color' => 'nullable',
        ];
    }
    public function mount(Banner $banner, $method){
        $this->banner = $banner;
        $this->method = $method;
        $this->order = $banner->order;
        $banner->type = 'Imagen';
        $this->loadLastOrder();
    }
    public function render(){
        $modulesWeb = ModuleWeb::orderBy('name')->get();
        return view('livewire.admin.banner.form', compact('modulesWeb'));
    }
    public function store(){
        $this->validate();
        $this->validateType();
        $this->reOrder();
        $this->saveVideo();
        $this->banner->save();
        $this->saveImage();
        $this->banner = new Banner([
            'type' => 'Imagen'
        ]);
        $this->reset('imageTmp');
        $this->emit('alert', 'success', __('Registration successfully added'));
        $this->emit('render');
    }
    public function update(){
        $this->validate();
        $this->validateType();
        $this->reOrder();
        $this->saveVideo();
        $this->banner->update();
        $this->saveImage();
        $this->emit('alert', 'success', __('Registration successfully updated'));
        $this->emit('render');
    }
    private function validateType(){
        if($this->banner->type == 'Imagen'):
            if(!$this->banner->image):
                $this->validate(['imageTmp' => 'required']);
            endif;
        endif;
        if($this->banner->type == 'Video'):
            if(!$this->banner->video):
                $this->validate(['videoTmp' => 'required']);
            endif;
        endif;
    }
    public function saveImage(){
        if($this->imageTmp):
            $url = $this->imageTmp->store('public/banner/'.strtolower($this->banner->module));
            imageManager($url, 1920, $this->banner);
        endif;
    }
    public function saveVideo(){
        if($this->videoTmp):
            $url = $this->videoTmp->store('public/banner/'.strtolower($this->banner->module));
            if($this->banner->video):
                if(Storage::exists($this->banner->video)):
                    Storage::delete($this->banner->video);
                endif;
            endif;
            $this->banner->video = $url;
        endif;
    }
    public function removeImage(){
        if($this->banner->image):
            if(Storage::exists($this->banner->image->url)):
                Storage::delete($this->banner->image->url);
            endif;
            $this->banner->image()->delete();
            $this->banner->image = null;
        endif;
        $this->reset('imageTmp');
        $this->emit('alert', 'success', __('Image successfully deleted'));
    }
    public function removeVideo(){
        if($this->banner->video):
            if(Storage::exists($this->banner->video)):
                Storage::delete($this->banner->video);
            endif;
            $this->banner->video = null;
        endif;
        $this->reset('videoTmp');
        $this->emit('alert', 'success', __('Video successfully deleted'));
    }
    private function reOrder(){
        if($this->order != $this->banner->order):
            $reOrder = Banner::where('order', $this->banner->order)->where('module_web_id', $this->banner->module_web_id)->where('id', '<>', $this->banner->id)->first();
            if($reOrder):
                $bannersToOrders = Banner::where('order', '>=', $this->banner->order);
                if($this->banner->exists):
                    $bannersToOrders = $bannersToOrders->where('id', '<>', $this->banner->id)->where('module_web_id', $this->banner->module_web_id);
                endif;
                $bannersToOrders->increment('order');
            endif;
        endif;
    }
    public function loadLastOrder($moduleWebId = null){
        if($this->banner->module_web_id && !$this->banner->exists):
            $modulesWebIdTMP = $this->banner->module_web_id;
            if($moduleWebId):
                $modulesWebIdTMP = $moduleWebId;
            endif;
            $lastOrder = Banner::latest('order');
            if($modulesWebIdTMP):
                $lastOrder = $lastOrder->where('module_web_id', $modulesWebIdTMP);
            endif;
            $lastOrder = $lastOrder->first();
            if($lastOrder):
                $this->banner->order = ($lastOrder->order + 1);
            else:
                $this->banner->order = 1;
            endif;
        endif;

    }
}
