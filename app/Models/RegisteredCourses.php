<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Events\SuccessfulRegister;

class RegisteredCourses extends Model
{
    use Notifiable;

    protected $fillable = ['course_id', 'user_id', 'meta', 'status', 'payment_id','is_completed', 'certificate_generated', 'activity_token', 'activity_expire'];
    protected $guarded = ['id'];

    public function getStatus()
    {        
        return  array_flip(getConfig('registered_course_status'))[$this->status];
    }

    //relationships

    public function course(){
        return $this->belongsTo(Courses::class);
    }
    
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function payment(){
        return $this->belongsTo(Payments::class);
    }
}
