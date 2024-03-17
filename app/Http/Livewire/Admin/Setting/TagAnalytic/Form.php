<?php

namespace App\Http\Livewire\Admin\Setting\TagAnalytic;

use App\Models\TagAnalytic;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class Form extends Component
{
    public $tagAnalytic;
    public $method;

    protected function rules(){
        return [
            'tagAnalytic.header' => 'nullable',
            'tagAnalytic.footer' => 'nullable',
        ];
    }
    public function mount(TagAnalytic $tagAnalytic, $method){
        $this->tagAnalytic = $tagAnalytic;
        $this->method = $method;
    }
    public function render(){
        return view('livewire.admin.setting.tag-analytic.form');
    }
    public function update(){
        $this->validate();
        $this->tagAnalytic->save();
        $this->_refreshCache();
        $this->emit('alert', 'success', __('Registration successfully added'));
        $this->emit('render');
    }
    private function _refreshCache(){
        Cache::forget('tagAnalytic');
        $tagAnalytic = TagAnalytic::first();
        Cache::put('tagAnalytic', $tagAnalytic);
    }
}
