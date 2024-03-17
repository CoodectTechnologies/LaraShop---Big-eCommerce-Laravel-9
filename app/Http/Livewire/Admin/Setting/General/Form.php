<?php

namespace App\Http\Livewire\Admin\Setting\General;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic;
use Jackiedo\DotenvEditor\Facades\DotenvEditor;
use Livewire\Component;
use Livewire\WithFileUploads;

class Form extends Component
{
    use WithFileUploads;

    public $logo, $logoTmp;
    public $logoWhite, $logoWhiteTmp;
    public $logoFavicon, $logoFaviconTmp;
    public $name;
    public $method;
    public $destinationPath = 'assets/admin/media/logo/';

    protected function rules(){
        return [
            'logoTmp' => $this->logo ? 'image|nullable' : 'image|required',
            'logoWhiteTmp' => $this->logoWhite ? 'image|nullable' : 'image|required',
            'logoFaviconTmp' => $this->logoFavicon ? 'image|nullable' : 'image|required',
            'name' => $this->name ? 'nullable' : 'required',
        ];
    }
    public function mount($method){
        $this->method = $method;
        $this->logo = config('app.logo');
        $this->logoWhite = config('app.logo_white');
        $this->logoFavicon = config('app.logo_favicon');
        $this->name = config('app.name');
    }
    public function render(){
        return view('livewire.admin.setting.general.form');
    }
    public function update(){
        $this->validate();
        $this->saveLogo();
        $this->saveLogoWhite();
        $this->saveLogoFavicon();
        $this->saveName();
        DotenvEditor::deleteBackups();
        if (file_exists(App::getCachedConfigPath())):
            Artisan::call("config:cache");
        endif;
        $this->emit('alert', 'success', __('Registration successfully updated'));
        $this->emit('render');
    }
    public function logoPreview(){
        $url = asset('assets/admin/media/svg/files/blank-image.svg');
        if($this->logo):
            return asset($this->logo);
        else:
            return $url;
        endif;
    }
    public function logoWhitePreview(){
        $url = asset('assets/admin/media/svg/files/blank-image.svg');
        if($this->logoWhite):
            return asset($this->logoWhite);
        else:
            return $url;
        endif;
    }
    public function logoFaviconPreview(){
        $url = asset('assets/admin/media/svg/files/blank-image.svg');
        if($this->logoFavicon):
            return asset($this->logoFavicon);
        else:
            return $url;
        endif;
    }
    private function saveLogo(){
        if($this->logoTmp):
            $imageName = 'logo.webp';
            $url = $this->logoTmp->store('public/directory-tmp');
            $this->imageManager($url, $imageName, 300, 'APP_LOGO');
        endif;
    }
    private function saveLogoWhite(){
        if($this->logoWhiteTmp):
            $imageName = 'logo_white.webp';
            $url = $this->logoWhiteTmp->store('public/directory-tmp');
            $this->imageManager($url, $imageName, 300, 'APP_LOGO_WHITE');
        endif;
    }
    private function saveLogoFavicon(){
        if($this->logoFaviconTmp):
            $imageName = 'logo_favicon.webp';
            $url = $this->logoFaviconTmp->store('public/directory-tmp');
            $this->imageManager($url, $imageName, 100, 'APP_LOGO_FAVICON');
        endif;
    }
    private function saveName(){
        if($this->name):
            DotenvEditor::setKey('APP_NAME', $this->name)->save();
        endif;
    }
    private function imageManager($url, $imageName, $width, $envKEY){
        $imageOptimized = ImageManagerStatic::make(Storage::get($url))->widen($width)->encode('webp');
        $urlNew = $this->destinationPath.$imageName;
        Storage::put($url, (string) $imageOptimized);
        rename(public_path(Storage::url($url)), public_path($urlNew));
        DotenvEditor::setKey($envKEY, $urlNew)->save();
    }
}
