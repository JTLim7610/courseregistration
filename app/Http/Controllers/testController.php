<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Courses;
use App\Models\RegisteredCourses;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Providers\EventServiceProvider;
use App\Mail\newCourseRegistration;

class testController extends Controller
{

    public function get(Request $request){
        $course = Courses::with('courseDetails')->where('id',$request->course_id)->first();
        return view('pages.student.main.courseDetails', compact('course'));

    }

}