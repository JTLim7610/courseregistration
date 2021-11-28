<?php

namespace App\Http\Controllers\Student;

use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Courses;
use App\Models\CourseDetails;
use App\Models\RegisteredCourses;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class IndexController extends Controller
{
    public function index(Request $request) {
        $user = Auth::user();  

        if($user){
            $registered_success = RegisteredCourses::with('course')->where('user_id', $user->id)->where('status', getConfig('registered_course_status.approved'))->get();
            // $registered_courses1 = RegisteredCourses::with('course')->where('user_id', $user->id)->select('course_id')->get();
            $pending_courses = RegisteredCourses::with('course')->where('user_id', $user->id)->where('status', getConfig('registered_course_status.pending_approved'))->get();
            $pending_payment = RegisteredCourses::with('course')->where('user_id', $user->id)->where('status', getConfig('registered_course_status.pending_payment'))->get();
            $registered_courses = DB::table('registered_courses')->where('user_id', $user->id)->select('course_id')->get();
            // $pop = RegisteredCourses::with('course')->where('user_id', $user->id)->select('course_id')->get();
            // $courses = Courses::with('courseDetails')->get();
            // if($searchQuery = $request->input('name'))
            //     $courses = $courses->where(function ($query) use ($searchQuery) {
            //         $query->where('name', 'like', "%$searchQuery%");           
            //     });
            $courses = Courses::with('courseDetails');
            if($searchQuery = $request->input('name'))
                $courses = $courses->where(function ($query) use ($searchQuery) {
                    $query->where('name', 'like', "%$searchQuery%");           
            });

            $courses = $courses->get();
            // $courses = DB::table('course_details')
            //             // ->whereRaw('current_capacity < capacity')
            //             ->join('courses', 'course_details_id', '=', 'course_details.id')
            //             // ->where('is_completed', false)
            //             ->get();

            return view('pages.student.main.index', compact(['courses', 'user', 'registered_success', 'registered_courses', 'pending_courses', 'pending_payment']));
        }

        $courses = Courses::with('courseDetails');
        if($searchQuery = $request->input('name'))
            echo '345';
            $courses = $courses->where(function ($query) use ($searchQuery) {
                $query->where('name', 'like', "%$searchQuery%");           
            });

        $courses = $courses->get();
        return view('pages.student.main.index', compact(['courses']));
     
    }

    public function dashboard()
    {
        return view('pages.student.main.student_dashboard');
    }
}
