<?php

use App\Models\Currency;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic;

if(!function_exists('active')):
    function active($routeNames){
        $active = false;
        if(is_array($routeNames)):
            foreach($routeNames as $routeName):
               if(setActive($routeName)):
                    $active = true;
                    break;
               endif;
            endforeach;
        else:
            if(setActive($routeNames)):
                $active = true;
            endif;
        endif;
        return $active ? "menu-item-active active menu-active hover show current" : "";
    }
endif;
if(!function_exists('setActive')):
    function setActive($routeName){
        return request()->routeIs($routeName);
    }
endif;
if(!function_exists('formatBytes')):
    function formatBytes($size, $precision = 2){
        $base = log($size, 1024);
        $suffixes = array('', 'KB', 'MB', 'GB', 'TB');
        return round(pow(1024, $base - floor($base)), $precision) .' '. $suffixes[floor($base)];
    }
endif;
if(!function_exists('currency')):
    function currency(){
        return session()->get('currency');
    }
endif;
if(!function_exists('currencies')):
    function currencies(){
        return Currency::getCache();
    }
endif;
if(!function_exists('language')):
    function language(){
        return session()->get('language');
    }
endif;
if(!function_exists('languages')):
    function languages(){
        return config('translatable.status') ? config('translatable.locales') : [];
    }
endif;
if(!function_exists('translatable')):
    function translatable(){
        return config('translatable.status') ? session()->get('language') : config('translatable.fallback');
    }
endif;
if(!function_exists('imageManager')):
    function imageManager($url, $width, $model, $name = null){
        $urlTMP = explode('.', $url);
        $extension = end($urlTMP);
        if($extension != 'gif'):
            $imageOptimized = ImageManagerStatic::make(Storage::get($url))->widen($width)->encode('webp');
            $urlEncode = $url.'.webp';
            Storage::put($url, (string) $imageOptimized);
            Storage::move($url, $urlEncode);
        else:
            $urlEncode = $url;
        endif;
        if($model->image):
            if(Storage::exists($model->image->url)):
                Storage::delete($model->image->url);
            endif;
            $model->image()->update([
                'url' => $urlEncode,
            ]);
        else:
            $model->image()->create([
                'url' => $urlEncode,
                'main' => true,
                'name' => $name
            ]);
        endif;
    }
endif;
if(!function_exists('imagesManager')):
    function imagesManager($url, $width, $model){
        $urlTMP = explode('.', $url);
        $extension = end($urlTMP);
        if($extension != 'gif'):
            $imageOptimized = ImageManagerStatic::make(Storage::get($url))->widen($width)->encode('webp');
            $urlEncode = $url.'.webp';
            Storage::put($url, (string) $imageOptimized);
            Storage::move($url, $urlEncode);
        else:
            $urlEncode = $url;
        endif;
        $model->images()->create([
            'url' => $urlEncode
        ]);
    }
endif;
if(!function_exists('sectionMenuIsVisible')):
    function sectionMenuIsVisible($section){
        $response = false;
        foreach($section['modules'] as $module):
            if($module['urlName']):
                if(
                    Route::has($module['urlName']) &&
                    auth()->user()->canany($module['canany'])
                ):
                    $response = true;
                endif;
            else:
                foreach($module['submodules'] as $submodule):
                    if($submodule['urlName']):
                        if(
                            Route::has($submodule['urlName']) &&
                            auth()->user()->canany($submodule['canany'])
                        ):
                            $response = true;
                        endif;
                    endif;
                endforeach;
            endif;
        endforeach;
        return $response;
    }
endif;
if(!function_exists('moduleMenuIsVisible')):
    function moduleMenuIsVisible($module){
        $response = false;
        if($module['urlName']):
            if(Route::has($module['urlName'])):
                $response = true;
            endif;
        else:
            foreach($module['submodules'] as $submodule):
                if($submodule['urlName']):
                    if(Route::has($submodule['urlName'])):
                        $response = true;
                        break;
                    endif;
                endif;
            endforeach;
        endif;
        return $response;
    }
endif;
if(!function_exists('mediaManagerSeeder')):
    function mediaManagerSeeder($url, $pathSave){
        $publicPath = public_path($url);
        if(File::exists($publicPath)):
            $fileName = basename($pathSave);
            $pathSave = str_replace($fileName, '', $pathSave);
            $pathSave = Storage::putFileAs($pathSave, $publicPath, $fileName);
            $pathSave = str_replace('//', '/', $pathSave);
            return $pathSave;
        else:
            try {
                $fileContent = file_get_contents($url);
                return Storage::put($pathSave, $fileContent);
            } catch (Exception $e) {
                return null;
            }
        endif;
    }
endif;

