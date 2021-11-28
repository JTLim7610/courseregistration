<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewCourseRegistration extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $user;
    public $course;
    public $registeredCourse;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $course, $registeredCourse)
    {
        $this->user = $user;
        $this->course = $course;
        $this->registeredCourse = $registeredCourse;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.newCourseRegistration');
    }
}
