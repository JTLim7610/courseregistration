<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payments extends Model
{
    protected $fillable = ['amount', 'registered_course_id', 'user_id', 'status_id', 'uuid', 'payslip'];

    public function getStatus()
    {        
        return  array_flip(getConfig('payment_status'))[$this->status_id];
    }
}
