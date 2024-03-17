<?php

namespace App\Providers;

use App\Listeners\MailSuccessfulDatabaseBackup;
use App\Models\EmailWeb;
use App\Models\File;
use App\Models\Image;
use App\Models\Order;
use App\Models\Subscriber;
use App\Models\User;
use App\Observers\EmailWebObserver;
use App\Observers\FileObserver;
use App\Observers\ImageObserver;
use App\Observers\OrderObserver;
use App\Observers\SubscriberObserver;
use App\Observers\UserObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Spatie\Backup\Events\BackupZipWasCreated;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        BackupZipWasCreated::class => [
            MailSuccessfulDatabaseBackup::class
        ],
    ];

    /**
     * The model observers for your application.
     *
     * @var array
     */

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        User::observe(UserObserver::class);
        Image::observe(ImageObserver::class);
        File::observe(FileObserver::class);
        Subscriber::observe(SubscriberObserver::class);
        EmailWeb::observe(EmailWebObserver::class);
        Order::observe(OrderObserver::class);
    }
}
