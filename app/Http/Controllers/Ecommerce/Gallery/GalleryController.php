<?php

namespace App\Http\Controllers\Ecommerce\Gallery;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class GalleryController extends Controller
{
    public function index(){
        $galleries = Cache::get('galleries') ?? [];
        return view('ecommerce.gallery.index', compact('galleries'));
    }
}
