<?php

namespace App\Http\Controllers\Admin\RegisteredCourse;

use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Courses;
use App\Models\Payments;
use App\Models\User;
use App\Models\CourseDetails;
use App\Models\RegisteredCourses;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\SuccessfulRegister;
use App\Notifications\SuccessfulRegisterNotification;
use App\Listeners\SuccessfulRegisterListeners;
use Illuminate\Support\Facades\Mail;
use App\Providers\EventServiceProvider;
use App\Mail\courseApproved;
use App\Mail\CourseRegistrationRejected;

class IndexController extends Controller
{
    public function index(){
        $pending_courses = RegisteredCourses::with(['course', 'user'])->where('status', getConfig('registered_course_status.pending_approved'))->get()->groupBy(['course.name']);
        $registered_courses = RegisteredCourses::with(['course','user'])->where('status', getConfig('registered_course_status.approved'))->get()->groupBy(['course.name']);
        $pending_payments = RegisteredCourses::with(['course','user','payment'])->where('status', getConfig('registered_course_status.pending_payment'))->get()->groupBy(['course.name']);

        return view('pages.admin.main.registration_course.index', compact(['pending_courses', 'registered_courses', 'pending_payments']));
    }

    public function action(Request $request){

        $registeredCourse = RegisteredCourses::where('course_id', $request->course_id)->where('user_id', $request->user_id)->first();
                
        switch($request->action){
            case "approved":
                {
                    $payment = Payments::where('id', $request->payment_id)->first();
                    $user = User::where('id', $request->user_id)->first();
                    $course = Courses::where('id', $request->course_id)->first();
    
                    $payment->update([
                        'status_id' => getConfig('payment_status.done')
                    ]);
                    $registeredCourse->update([
                        'status' => getConfig('registered_course_status.approved')
                    ]);
                    event(new SuccessfulRegister($user, $course));
    
                    return back()->with('success', 'Approved Successfully');
                }

            case "pending_payment":
                {
                    $course = Courses::where('id', $request->course_id)->first();
                    $user = User::where('id', $request->user_id)->first();
                    $courseDetails = CourseDetails::where('id', $request->course_id)->first();

                    $payment = Payments::create([
                        'uuid' => Str::uuid(),
                        'amount' => $courseDetails->price, 
                        'user_id' => $request->user_id, 
                    ]);
                    $registeredCourse->update([
                        'payment_id' => $payment->id,
                        'status' => getConfig('registered_course_status.pending_payment')
                    ]);
    
                    Mail::to($user->email)->send(new courseApproved($user, $course));
    
                    return back()->with('success', 'User registration accepted');
                }

            case "reject":
                {
                    $course = Courses::where('id', $request->course_id)->first();
                    $user = User::where('id', $request->user_id)->first();
                    
                    $registeredCourse->update([
                        'status' => getConfig('registered_course_status.Rejected')
                    ]);

                    Mail::to($user->email)->send(new CourseRegistrationRejected($user, $course));

                    return back()->with('success', 'Reject Student Registration Successfully');
                }

        }
       
    }
}
