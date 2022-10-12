<?php

namespace App\Listeners;

use App\Events\EmailVerify;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Notifications\EmailVerificationNotification;


class EmailVerifyListener implements ShouldQueue
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
     * @param  object  $event
     * @return void
     */
    public function handle(EmailVerify $event)
    {
        /*
         * Send a notification to registered user to verity their email
         * Notification includes custom url from the registered auth guard
         * Email and token value

        */

        $event->user->notify(new EmailVerificationNotification($event->url));




    }
}
