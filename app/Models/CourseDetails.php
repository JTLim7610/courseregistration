<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseDetails extends Model
{
    protected $guarded = ['id'];

    //relationships 

    public function course(){
        return $this->hasOne(Courses::class);
    }

    public function registeredCourses(){
        return $this->hasManyThrough(RegisteredCourses::class, Courses::class, 'id','id', 'course_details_id','course_id');
    }

}
