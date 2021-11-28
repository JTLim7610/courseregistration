<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;

class User extends Authenticatable
{
    use Notifiable;
    
    protected $guarded = ['id'];
    protected $hidden = ['password'];

    protected $fillable = [
        'name',
        'email',
        'role_id',
        'status',
        'password',
        'activity_token',
        'activity_expire',
        'is_activity',
        'remember_token',
        'created_at',
        'update_at',
    ];
    
    protected $events = [
        'created' => Events\Registered::class
    ];

     # Function to check user status
    public function checkStatus($status)
    {
        return $this->status == getConfig("user.status.$status");
    }


    
    # Funtion to get user status
    public function getStatus()
    {
        if($this->status)
        {
            $status = array_flip(getConfig('user.status'))[$this->status];
            return $status;
        }        
        return '-';
    }


    # Function to check user role
    public function checkRole($role)
    { 
        if (is_array($role)) {

            foreach($role as $r)
            {          
                if ($this->role_id == config("system.role.$r"))
                    return true;
            }   
            return false;    
        }
        return $this->role_id == config("system.role.$role");
    }


    //relationships 
    public function feedbacks(){
        return $this->hasMany(Feedback::class);
    }
 
    public function registeredCourses(){
        return $this->hasMany(RegisteredCourses::class);
    }

}
