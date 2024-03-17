<?php

namespace App\Http\Livewire\Admin\Package\Package;

use App\Models\Package;
use Exception;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    protected $listeners = ['render'];

    public function render(){
        if(Cache::has('packages')):
            $packages = Cache::get('packages');
        else:
            $packages = Package::with('packageFeatures')->orderBy('order')->get();
            Cache::put('packages', $packages);
        endif;
        return view('livewire.admin.package.package.index', compact('packages'));
    }
    public function destroy(Package $package){
        try{
            $package->delete();
            Cache::forget('packages');
            $this->emit('alert', 'success', __('Successful elimination'));
        }catch(Exception $e){
            $this->emit('alert', 'error', $e->getMessage());
        }
    }
}
