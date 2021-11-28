<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Courses;
use App\Models\RegisteredCourses;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function index(){
        $courses = Courses::all()->count();
        $students = User::where('role_id', getConfig('role.student'))->count();
        $staff = User::where('role_id', getConfig('role.staff'))->count();
        $courses_pending = RegisteredCourses::where('status', getConfig('registered_course_status.pending_approved'))->count();
        $user = auth()->user()->name;
        $data = [
            'courses_count' => $courses, 
            'students_count' =>  $students, 
            'staff_count' =>  $staff, 
            'pending_course_count' =>  $courses_pending,
            'user' => $user
        ];
        return view('pages.admin.main.dashboard', compact('data'));
    }
}
