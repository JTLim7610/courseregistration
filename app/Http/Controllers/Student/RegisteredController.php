<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RegisteredCourses;
use Illuminate\Support\Facades\Auth;

class RegisteredController extends Controller
{
    public function index(){
        $user = Auth::user();
        $registeredCourses = RegisteredCourses::with('course')->where('user_id', $user->id)->get();
        return view('pages.student.main.registeredCourse', compact('registeredCourses'));
    }

    public function viewCert(Request $request){
        $user = Auth::user();
        $registeredCourses = RegisteredCourses::with(['course','user'])->where('id', $request->course_id)->where('user_id', $user->id)->first();
        return view('pages.student.main.certificate', compact('registeredCourses'));
    }
}
