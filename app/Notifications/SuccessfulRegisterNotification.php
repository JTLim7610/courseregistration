<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Listeners\SuccessfulRegisterListeners;
use App\Models\User;
use App\Models\RegisteredCourses;

class SuccessfulRegisterNotification extends Notification
{
    use Queueable;

    public $user;
    public $registeredCourse;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user, $registeredCourse)
    {
        $this->user = $user;
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
                    ->line('Congratulations ' . $notifiable->name . '! You have successfully registered ' . $this->registeredCourse .'!')
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
