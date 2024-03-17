<?php

namespace App\Observers;

use App\Models\EmailWeb;
use App\Models\Subscriber;

class EmailWebObserver
{
    /**
     * Handle the EmailWeb "created" event.
     *
     * @param  \App\Models\EmailWeb  $emailWeb
     * @return void
     */
    public function created(EmailWeb $emailWeb)
    {
        //Registrar en el newsletters
        if(!Subscriber::where('email', $emailWeb->email)->first()):
            Subscriber::create(['email' => $emailWeb->email]);
        endif;
    }

    /**
     * Handle the EmailWeb "updated" event.
     *
     * @param  \App\Models\EmailWeb  $emailWeb
     * @return void
     */
    public function updated(EmailWeb $emailWeb)
    {
        //
    }

    /**
     * Handle the EmailWeb "deleted" event.
     *
     * @param  \App\Models\EmailWeb  $emailWeb
     * @return void
     */
    public function deleted(EmailWeb $emailWeb)
    {
        //
    }

    /**
     * Handle the EmailWeb "restored" event.
     *
     * @param  \App\Models\EmailWeb  $emailWeb
     * @return void
     */
    public function restored(EmailWeb $emailWeb)
    {
        //
    }

    /**
     * Handle the EmailWeb "force deleted" event.
     *
     * @param  \App\Models\EmailWeb  $emailWeb
     * @return void
     */
    public function forceDeleted(EmailWeb $emailWeb)
    {
        //
    }
}
