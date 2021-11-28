<?php

namespace App\Listeners;

use Illuminate\Notifications\Notification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Providers\EventServiceProvider;
use Illuminate\Auth\Events\NewCourseRegistration;
use App\Notifications\NewCourseRegistrationNotification;
use Illuminate\Support\Facades\Auth;


class NewCourseRegistrationListeners
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
    public function handle(NewCourseRegistration $event)
    {
        $userName = $event->user->name;
        $courseTitle = $event->course->name;
        $admin->email = 'admin@site.com';
        $admin->save();
        echo $admin;
        // $admin->email = 'demo@admin.com';
        // $admin->notify(new NewCourseRegistrationNotification($userName, $courseTitle));
       // Notification::route('mail', 'demo@admin.com')->notify(new NewCourseRegistrationNotification($userName, $courseTitle));
    }
}
