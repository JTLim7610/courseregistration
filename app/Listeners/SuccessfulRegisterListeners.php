<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Providers\EventServiceProvider;
use Illuminate\Auth\Events\SuccessfulRegister;
use App\Notifications\SuccessfulRegisterNotification;
use App\Mail\NewUserWelcomeEmail;
use App\Models\Courses;

class SuccessfulRegisterListeners
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
     * @param  SuccessfulRegister  $event
     * @return void
     */
    public function handle(SuccessfulRegister $event)
    {
        $userName = $event->user->name;
        $courseTitle = $event->course->name;

        $event->user->notify(new SuccessfulRegisterNotification($userName, $courseTitle));

    }
}
