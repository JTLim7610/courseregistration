<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Providers\EventServiceProvider;
use Illuminate\Auth\Events\Registered;
use App\Notifications\WelcomeEmailNotiications;
use App\Mail\NewUserWelcomeEmail;

class WelcomeEmailListeners
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
     * @param  Registered  $event
     * @return void
     */
    public function handle(Registered $event)
    {
        //        
        $authUser = $event->user;

        $event->user->notify(new WelcomeEmailNotiications($authUser));
    }

    
}
