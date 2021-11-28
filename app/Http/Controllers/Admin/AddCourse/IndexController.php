<?php

namespace App\Http\Controllers\Admin\AddCourse;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CourseDetails;
use App\Models\Courses;

class IndexController extends Controller
{
    public function index(){
        return view('pages.admin.main.course.add');
    }

    public function create(Request $request){

        $courseDetails = CourseDetails::create([
            'capacity' => $request->course_capacity, 
            'date' => $request->course_date, 
            'time' => $request->course_time, 
            'description' => $request->description,
            'price' => $request->price,
            'feedback_link' => $request->feedback_link
        ]);

        $file = $request->file('course_pic');
        $picName = $file->getClientOriginalName();
        $imagePath = '/public/courses/';
        $file->move(public_path($imagePath), $picName);

        $course = Courses::create([
            'name' => $request->course_name, 
            'code' => $request->course_code,
            'course_details_id' => $courseDetails->id,
            'course_pic' => '/public/courses/' .$picName,
            'activity_type' => getConfig('activity_type.'.$request->activity_type),
        ]);
    
        return redirect()->route('admin.account.course.index')->with('success', 'Course Created Successfully');

    }

    public function delete(Request $request){
        $course = Courses::with('courseDetails')->where('id', $request->course_id)->first(); 
        $course->delete();         
        return back()->with('success', 'Course Deleted Successfully');
    }
}
