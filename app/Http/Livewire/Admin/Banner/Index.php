<?php

namespace App\Http\Livewire\Admin\Banner;

use App\Models\Banner;
use App\Models\ModuleWeb;
use Exception;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class Index extends Component
{
    protected $listeners = ['render'];
    public $module;

    public function render(){
        $modulesWeb = ModuleWeb::orderBy('id')->get();
        $banners = Banner::with(['image', 'moduleWeb']);
        if($this->module):
            $banners = $banners->where('module_web_id', $this->module);
        endif;
        $banners = $banners->orderBy('order')->get();
        return view('livewire.admin.banner.index', compact('banners', 'modulesWeb'));
    }
    public function destroy(Banner $banner){
        try{
            if($banner->image):
                if(Storage::exists($banner->image->url)):
                    Storage::delete($banner->image->url);
                endif;
                $banner->image()->delete();
            endif;
            if($banner->video):
                if(Storage::exists($banner->video)):
                    Storage::delete($banner->video);
                endif;
            endif;
            $banner->delete();
            $this->emit('alert', 'success', __('Successful elimination'));
        }catch(Exception $e){
            $this->emit('alert', 'error', $e->getMessage());
        }
    }
}
