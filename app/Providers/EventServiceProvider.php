<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use App\Listeners\WelcomeEmailListeners;
use App\Notifications\WelcomeEmailNotiications;
use Illuminate\Auth\Events\SuccessfulRegister;
use App\Listeners\SuccessfulRegisterListeners;
use App\Notifications\SuccessfulRegisterNotification;
use Illuminate\Auth\Events\NewCourseRegistration;
use App\Listeners\NewCourseRegistrationListeners;
use App\Notifications\NewCourseRegistrationNotification;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
            WelcomeEmailListeners::class,
        ],
        SuccessfulRegister::class => [
            SuccessfulRegisterListeners::class,
        ],
        NewCourseRegistration::class => [
            NewCourseRegistrationListeners::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
