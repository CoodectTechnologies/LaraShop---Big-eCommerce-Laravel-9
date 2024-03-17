<?php

namespace App\Http\Livewire\Ecommerce\Contact;

use App\Mail\Contact\ContactCreate as MailContactCreate;
use App\Models\EmailWeb;
use App\Models\User;
use App\Notifications\Contact\ContactCreate as NotificationContactCreate;
use Exception;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Livewire\Component;
use Lukeraymonddowning\Honey\Traits\WithRecaptcha;

class Index extends Component
{
    use WithRecaptcha;

    public $emailWeb;

    protected function rules(){
        return [
            'emailWeb.name' => 'required',
            'emailWeb.email' => 'required|email',
            'emailWeb.phone' => 'required',
            'emailWeb.subject' => 'required',
            'emailWeb.body' => 'required'
        ];
    }
    public function mount(EmailWeb $emailWeb, $subject = null, $body = null){
        $this->emailWeb = $emailWeb;
        if($subject){
            $this->emailWeb->subject = $subject;
        }
        if($body){
            $this->emailWeb->body = $body;
        }
    }
    public function render(){
        return view('livewire.ecommerce.contact.index');
    }
    public function sendEmail(){
        $this->validate();
        if(!$this->recaptchaPasses()):
            session()->flash('alert','¡Ups! ocurrio un error.');
            session()->flash('alert-type', 'danger');
        else:
            $this->emailWeb->phone = str_replace(' ', '', $this->emailWeb->phone);
            $this->emailWeb->save();
            try{
                Notification::send(
                    User::permission('correos')->get(),
                    new NotificationContactCreate($this->emailWeb)
                );
                Mail::to(config('contact.email'))
                ->bcc(User::permission(['correos'])->where('email', '<>', config('contact.email'))->pluck('email'))
                ->send(new MailContactCreate($this->emailWeb));
                $this->emailWeb = new EmailWeb();
                session()->flash('alert','Correo enviado con éxito');
                session()->flash('alert-type','success');
            }catch(Exception $e){
                session()->flash('alert','¡Ups! ocurrio un error.'.$e->getMessage());
                session()->flash('alert-type','danger');
            }
        endif;
    }
}
