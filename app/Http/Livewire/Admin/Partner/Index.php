<?php

namespace App\Http\Livewire\Admin\Partner;

use App\Models\Partner;
use Exception;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class Index extends Component
{
    protected $listeners = ['render'];

    public function render(){
        if(Cache::has('partners')):
            $partners = Cache::get('partners');
        else:
            $partners = Partner::with('image')->orderBy('id', 'desc')->get();
            Cache::put('partners', $partners);
        endif;
        return view('livewire.admin.partner.index', compact('partners'));
    }
    public function destroy(Partner $partner){
        try{
            if($partner->image):
                if(Storage::exists($partner->image->url)):
                    Storage::delete($partner->image->url);
                endif;
                $partner->image()->delete();
            endif;
            $partner->delete();
            Cache::forget('partners');
            $this->emit('alert', 'success', __('Successful elimination'));
        }catch(Exception $e){
            $this->emit('alert', 'error', $e->getMessage());
        }
    }
}
