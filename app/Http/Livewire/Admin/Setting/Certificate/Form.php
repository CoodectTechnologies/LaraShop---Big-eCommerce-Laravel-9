<?php

namespace App\Http\Livewire\Admin\Setting\Certificate;

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
    public $watermark, $watermarkTmp;
    public $signature, $signatureTmp;
    public $signatureName;
    public $method;
    public $destinationPath = 'assets/admin/media/certificate/';

    protected function rules(){
        return [
            'logoTmp' => $this->logo ? 'image|nullable' : 'image|required',
            'watermarkTmp' => $this->watermark ? 'image|nullable' : 'image|required',
            'signatureTmp' => $this->signature ? 'image|nullable' : 'image|required',
            'signatureName' => $this->signatureName ? 'nullable' : 'required',
        ];
    }
    public function mount($method){
        $this->method = $method;
        $this->logo = config('certificate.logo');
        $this->watermark = config('certificate.watermark');
        $this->signature = config('certificate.signature');
        $this->signatureName = config('certificate.signature_name');
    }
    public function render(){
        return view('livewire.admin.setting.certificate.form');
    }
    public function update(){
        $this->validate();
        $this->saveLogo();
        $this->saveWatermark();
        $this->saveSignature();
        $this->saveSignatureName();
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
    public function waterMarkPreview(){
        $url = asset('assets/admin/media/svg/files/blank-image.svg');
        if($this->watermark):
            return asset($this->watermark);
        else:
            return $url;
        endif;
    }
    public function signaturePreview(){
        $url = asset('assets/admin/media/svg/files/blank-image.svg');
        if($this->signature):
            return asset($this->signature);
        else:
            return $url;
        endif;
    }
    private function saveLogo(){
        if($this->logoTmp):
            $imageName = 'logo.webp';
            $url = $this->logoTmp->store('public/directory-tmp');
            $this->imageManager($url, $imageName, 300, 'CERTIFICATE_LOGO');
        endif;
    }
    private function saveWatermark(){
        if($this->watermarkTmp):
            $imageName = 'watermark.webp';
            $url = $this->watermarkTmp->store('public/directory-tmp');
            $this->imageManager($url, $imageName, 700, 'CERTIFICATE_WATERMARK');
        endif;
    }
    private function saveSignature(){
        if($this->signatureTmp):
            $imageName = 'signature.webp';
            $url = $this->signatureTmp->store('public/directory-tmp');
            $this->imageManager($url, $imageName, 200, 'CERTIFICATE_SIGNATURE');
        endif;
    }
    private function saveSignatureName(){
        if($this->signatureName):
            DotenvEditor::setKey('CERTIFICATE_SIGNATURE_NAME', $this->signatureName)->save();
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
