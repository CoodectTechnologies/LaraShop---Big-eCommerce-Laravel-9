<?php

namespace App\Observers;

use App\Models\Subscriber;
use Illuminate\Support\Facades\Log;
use Spatie\Newsletter\NewsletterFacade as Newsletter;


class SubscriberObserver
{
    /**
     * Handle the Subscriber "created" event.
     *
     * @param  \App\Models\Subscriber  $subscriber
     * @return void
     */
    public function created(Subscriber $subscriber)
    {
        if($this->getStatus()):
            if (!Newsletter::isSubscribed($subscriber->email)):
                Newsletter::subscribe($subscriber->email);
                Log::debug($subscriber->email);
            endif;
        endif;
    }

    /**
     * Handle the Subscriber "updated" event.
     *
     * @param  \App\Models\Subscriber  $subscriber
     * @return void
     */
    public function updated(Subscriber $subscriber)
    {
        //
    }

    /**
     * Handle the Subscriber "deleted" event.
     *
     * @param  \App\Models\Subscriber  $subscriber
     * @return void
     */
    public function deleted(Subscriber $subscriber)
    {
        if($this->getStatus()):
            if (Newsletter::isSubscribed($subscriber->email)):
                Newsletter::unsubscribe($subscriber->email);
            endif;
        endif;
    }

    /**
     * Handle the Subscriber "restored" event.
     *
     * @param  \App\Models\Subscriber  $subscriber
     * @return void
     */
    public function restored(Subscriber $subscriber)
    {
        //
    }

    /**
     * Handle the Subscriber "force deleted" event.
     *
     * @param  \App\Models\Subscriber  $subscriber
     * @return void
     */
    public function forceDeleted(Subscriber $subscriber)
    {
        //
    }
    private function getStatus(){
        $response = false;
        if(
            config('newsletter.status') &&
            config('newsletter.apiKey') &&
            config('newsletter.lists.subscribers.id')
        ):
            $response = true;
        endif;
        return $response;
    }
}
