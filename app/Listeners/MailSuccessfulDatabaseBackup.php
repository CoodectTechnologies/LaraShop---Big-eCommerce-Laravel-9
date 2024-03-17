<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use Spatie\Backup\Events\BackupZipWasCreated;

class MailSuccessfulDatabaseBackup
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \Spatie\Backup\Events\BackupZipWasCreated  $event
     * @return void
     */
    public function handle(BackupZipWasCreated $event)
    {
        $this->mailBackupFile($event->pathToZip);
    }

    public function mailBackupFile($path){
        try {
            Mail::raw('Tiene un nuevo archivo de copia de seguridad de la base de datos.',   function ($message) use ($path) {
                $message->to(env('DB_BACKUP_EMAIL', 'hola@example.com'))
                ->subject('Copia de seguridad de la base de datos Lista.')
                ->attach($path);
            });
        } catch (\Exception $exception) {
            throw $exception;
        }

    }
}
