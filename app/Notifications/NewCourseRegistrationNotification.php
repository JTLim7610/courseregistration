<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Listeners\NewCourseRegistrationListeners;
use App\Models\User;

class NewCourseRegistrationNotification extends Notification
{
    use Queueable;

    public $user;
    public $registeredCourse;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($userName, $registeredCourse)
    {
        $this->userName = $userName;
        $this->registeredCourse = $registeredCourse;
    }
    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('Hello Admin')
                    ->line('A new user : '. $this->userName . 'have registered ' . $this->registeredCourse .'.')
                    ->line('Kindly proceed to approvement process.')
                    ->action('UTAR Short Course', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
