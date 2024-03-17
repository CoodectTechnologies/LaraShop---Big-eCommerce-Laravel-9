<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class File extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function fileable(){
        return $this->morphTo();
    }
    public function filePreview(){
        $file = asset('assets/admin/media/svg/files/upload.svg');
        if($this->url):
            if(Storage::exists($this->url)):
                $file = Storage::url($this->url);
            else:
                $file = $this->url;
            endif;
        endif;
        return $file;
    }
    public function dateToString(){
        return Carbon::parse($this->created_at)->toFormattedDateString();
    }
    public function dateHumansToString(){
        return Carbon::parse($this->created_at)->diffForHumans();
    }
    public function iconPreview($extension = null){
        $this->extension = $extension ?? $this->extension;
        if(in_array($this->extension, ['3ds'])):
            return asset('assets/admin/media/icons/3ds.png');

        elseif(in_array($this->extension, ['ai'])):
            return asset('assets/admin/media/icons/ai.png');

        elseif(in_array($this->extension, ['bin'])):
            return asset('assets/admin/media/icons/bin.png');

        elseif(in_array($this->extension, ['cad'])):
            return asset('assets/admin/media/icons/cad.png');

        elseif(in_array($this->extension, ['css'])):
            return asset('assets/admin/media/icons/css.png');

        elseif(in_array($this->extension, ['dll'])):
            return asset('assets/admin/media/icons/dll.png');

        elseif(in_array($this->extension, ['dmg'])):
            return asset('assets/admin/media/icons/dmg.png');

        elseif(in_array($this->extension, ['doc', 'docx', 'dot'])):
            return asset('assets/admin/media/icons/docx.png');

        elseif(in_array($this->extension, ['dwg'])):
            return asset('assets/admin/media/icons/dwg.png');

        elseif(in_array($this->extension, ['eml'])):
            return asset('assets/admin/media/icons/eml.png');

        elseif(in_array($this->extension, ['exe'])):
            return asset('assets/admin/media/icons/exe.png');

        elseif(in_array($this->extension, ['gif'])):
            return asset('assets/admin/media/icons/gif.png');

        elseif(in_array($this->extension, ['html'])):
            return asset('assets/admin/media/icons/html.png');

        elseif(in_array($this->extension, ['ini'])):
            return asset('assets/admin/media/icons/ini.png');

        elseif(in_array($this->extension, ['iso'])):
            return asset('assets/admin/media/icons/iso.png');

        elseif(in_array($this->extension, ['jpg', 'jpeg', 'webp', 'bpm', 'tif'])):
            return asset('assets/admin/media/icons/jpg.png');

        elseif(in_array($this->extension, ['mdb'])):
            return asset('assets/admin/media/icons/mdb.png');

        elseif(in_array($this->extension, ['mov'])):
            return asset('assets/admin/media/icons/mov.png');

        elseif(in_array($this->extension, ['mp4', 'wmv', 'avi', 'avchd', 'flv', 'f4v', 'swf', 'mkv', 'webm'])):
            return asset('assets/admin/media/icons/mp4.png');

        elseif(in_array($this->extension, ['pdf'])):
            return asset('assets/admin/media/icons/pdf.png');

        elseif(in_array($this->extension, ['png'])):
            return asset('assets/admin/media/icons/png.png');

        elseif(in_array($this->extension, ['pptx', 'pptm', 'ppt', 'pps', 'pot'])):
            return asset('assets/admin/media/icons/pptx.png');

        elseif(in_array($this->extension, ['psd'])):
            return asset('assets/admin/media/icons/psd.png');

        elseif(in_array($this->extension, ['rar'])):
            return asset('assets/admin/media/icons/rar.png');

        elseif(in_array($this->extension, ['skp'])):
            return asset('assets/admin/media/icons/skp.png');

        elseif(in_array($this->extension, ['ttf'])):
            return asset('assets/admin/media/icons/ttf.png');

        elseif(in_array($this->extension, ['txt'])):
            return asset('assets/admin/media/icons/txt.png');

        elseif(in_array($this->extension, ['vcf'])):
            return asset('assets/admin/media/icons/vcf.png');

        elseif(in_array($this->extension, ['xls', 'xlsx', 'xlsm', 'xlt', 'csv'])):
            return asset('assets/admin/media/icons/xlsx.png');

        elseif(in_array($this->extension, ['zip'])):
            return asset('assets/admin/media/icons/zip.png');

        else:
            return asset('assets/admin/media/icons/default.png');

        endif;
    }
}
