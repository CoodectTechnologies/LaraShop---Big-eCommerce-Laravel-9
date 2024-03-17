<?php

namespace App\Http\Livewire\Admin\Package\Feature;

use App\Models\PackageFeature;
use Exception;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{

    protected $listeners = ['render'];

    public function render(){
        // if(Cache::has('packageFeatures')):
            // $packageFeatures = Cache::get('packageFeatures');
        // else:
            $packageFeatures = PackageFeature::with('packages')->orderBy('id', 'desc')->get();
            // Cache::put('packageFeatures', $packageFeatures);
        // endif;
        return view('livewire.admin.package.feature.index', compact('packageFeatures'));
    }
    public function destroy(PackageFeature $packageFeature){
        try{
            $packageFeature->delete();
            Cache::forget('packageFeatures');
            $this->emit('alert', 'success', __('Successful elimination'));
        }catch(Exception $e){
            $this->emit('alert', 'error', $e->getMessage());
        }
    }
}
