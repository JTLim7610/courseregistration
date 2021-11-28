<?php

namespace App\Http\Controllers\Student;

use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Courses;
use App\Models\CourseDetails;
use App\Models\RegisteredCourses;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Date; 
use App\Providers\EventServiceProvider;
use App\Mail\newCourseRegistration;

class CourseController extends Controller
{
    public $user;

    public function get(Request $request){
        $user = Auth::user();
        $course = Courses::with('courseDetails')->where('id',$request->course_id)->first();
        $is_registred = RegisteredCourses::with('course')->where('course_id',$request->course_id)->where('user_id',$user->id)->get();

        return view('pages.student.main.courseDetails', compact('course','is_registred'));
    }

    public function unregisterCourse(Request $request) {
        $user = Auth::user(); 
        $registeredCourse = RegisteredCourses::where('user_id', $user->id)->where('course_id',$request->course_id)->first(); 
        $registeredCourse->update([
            'status' => getConfig('registered_course_status.cancelled')
        ]);

        return back()->with('success', 'Courses Unregistered Successfully');
    }

    public function registerCourse(Request $request){
        $user = Auth::user();
        $courseDetails = CourseDetails::where('id', $request->course_id)->first();
        $course = Courses::where('id', $request->course_id)->first();

        switch($request->action){
            case "cancel": 
                return redirect()->route('student.account.index');

            case "register":
                {
                    $is_registered = RegisteredCourses::where('user_id', $user->id)->where('course_id',$request->course_id)->first();
                    if($is_registered == null)
                    {
                        if(($courseDetails->current_capacity) < ($courseDetails->capacity))
                        {
                            DB::table('course_details')->where('id', $request->course_id)->increment('current_capacity');
    
                            RegisteredCourses::create([
                                'user_id' => $user->id, 
                                'course_id' => $request->course_id, 
                                'meta' => json_encode(setMeta(null, 'register_info', $request->all())),
                                'activity_token'=>\Str::random(60),
                                'activity_expire'=>Date::now('+24 hours')
                            ]);
    
                            $registeredCourse = RegisteredCourses::where('user_id', $user->id)->where('course_id',$request->course_id)->first(); 
    
                            Mail::to($user->email)
                                ->send(new newCourseRegistration($user, $course, $registeredCourse));
    
                            return redirect()->route('student.account.index')->with('success', 'Registration form submitted. Please verify your course registration ');  
                        }
                        return back()->with('err', "This course capacity is full. Please register for other available courses.");
                    }
                    return back()->with('err', "You have registered this course before. Please register for other available courses.");
                } 

        }       
    }

    public function unregisterAll(Request $request){

        switch($request->action){
            case "registered_approved":
                $registeredCourses = RegisteredCourses::where('user_id', Auth::user()->id)->where('status', getConfig('registered_course_status.approved'))->get(); 

            case "unregistered_pending":
                $registeredCourses = RegisteredCourses::where('user_id', Auth::user()->id)->where('status', getConfig('registered_course_status.pending_approved'))->get(); 
        }

        foreach($registeredCourses as $registeredCourse){
            $registeredCourse->update([
                'status' => getConfig('registered_course_status.cancelled')
            ]);
        }
        return back()->with('success', 'Courses Unregistered Successfully');
    }

    public function registerForm(Request $request){
        
        if(!Auth::user())
            return back()->with('success', 'Join us as a user with us to register for a course');

        $course = Courses::with('courseDetails')->where('id',$request->course_id)->first();
        return view('pages.student.main.registerForm', compact('course'));
    }
}
