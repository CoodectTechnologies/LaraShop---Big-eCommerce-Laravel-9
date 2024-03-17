<?php

namespace App\Mail\Contact;

use App\Models\EmailWeb;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactCreate extends Mailable
{
    use Queueable, SerializesModels;

    private $emailWeb;

    public function __construct(EmailWeb $emailWeb){
        $this->emailWeb = $emailWeb;
    }
    public function build(){
        return $this->subject($this->emailWeb->subject)->markdown('emails.contact.create', [
            'emailWeb' => $this->emailWeb
        ]);
    }
}
