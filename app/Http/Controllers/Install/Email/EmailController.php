<?php

namespace App\Http\Controllers\Install\Email;

use Jackiedo\DotenvEditor\Facades\DotenvEditor;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Artisan;

class EmailController extends Controller
{
    public function index(){
        return view('install.email.index');
    }
    public function store(Request $request){
        $validated = $request->validate([
            'mailer' => 'required',
            'host' => 'required',
            'port' => 'required',
            'username' => 'required',
            'password' => 'required',
            'encriptation' => 'nullable',
        ]);
        try{
            DotenvEditor::setKey('MAIL_MAILER', $validated['mailer'])->save();
            DotenvEditor::setKey('MAIL_HOST', $validated['host'])->save();
            DotenvEditor::setKey('MAIL_PORT', $validated['port'])->save();
            DotenvEditor::setKey('MAIL_USERNAME', $validated['username'])->save();
            DotenvEditor::setKey('MAIL_FROM_ADDRESS', $validated['username'])->save();
            DotenvEditor::setKey('MAIL_PASSWORD', $validated['password'])->save();
            DotenvEditor::setKey('MAIL_ENCRYPTION', $validated['encriptation'])->save();
            DotenvEditor::deleteBackups();
            if (file_exists(App::getCachedConfigPath())):
                Artisan::call("config:cache");
            endif;
            return Redirect::route('install.user.index');
        }catch(Exception $e){
            Session::flash('alert', 'Ocurrio un error: '.$e->getMessage());
            Session::flash('alert-type', 'warning');
            return Redirect::route('install.email.index');
        }
    }
}
