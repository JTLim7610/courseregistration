<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Courses extends Model
{
    protected $guarded = ['id'];

    //relationships 
    public function courseDetails(){
        return $this->belongsTo('App\Models\CourseDetails', 'course_details_id');
    }

    public function registeredCourses(){
        return $this->hasMany(RegisteredCourses::class);
    }
}
