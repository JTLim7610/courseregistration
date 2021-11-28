<?php

namespace App\Http\Controllers\Admin\Course;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Courses;
use App\Models\RegisteredCourses;

class IndexController extends Controller
{
    public function index(Request $request){
        $courses = Courses::with('courseDetails');
        $startDate = getFilterStartDate($request->startDate);
        $endDate = getFilterEndDate($request->endDate);    

        if($searchQuery = $request->input('query'))
			$records = $courses->where(function ($query) use ($searchQuery) {
                $query->where('name', 'like', "%$searchQuery%");
            });

        $courses = $courses->where('created_at', '>=', $startDate)->where('created_at', '<=', $endDate)->get();

        return view('pages.admin.main.course.index', compact('courses'));
    }

    public function get($id) {
        $course = Courses::with('courseDetails')->where('id', customDecryption($id))->first();
        $course_students = RegisteredCourses::with('user')->where('course_id', $course->id)->where('status', getConfig('registered_course_status.approved'))->get();

        return view('pages.admin.main.course.details', compact(['course', 'course_students']));
    }

    public function update(Request $request){
        $course = Courses::with('courseDetails')->where('id', $request->course_id)->first();

        $course->update([
            'name' => $request->course_name, 
            'code' => $request->course_code
        ]);


        $file = $request->file('course_pic');
        if($file){
            $picName = $file->getClientOriginalName();
            $imagePath = '/public/courses/';
            $file->move(public_path($imagePath), $picName);

            $course->update([
                'course_pic' => '/public/courses/' .$picName
            ]);
        }
  
        $course->courseDetails()->update([
            'capacity' => $request->course_capacity, 
            'date' => $request->course_date, 
            'time' => $request->course_time, 
            'description' => $request->description,
            'price' => $request->price,
            'feedback_link' => $request->feedback_link
        ]);

        return back()->with('success', 'Course Update Successfully');
    }

    public function removeStudent(Request $request){
        $registered = RegisteredCourses::where('course_id', $request->course_id)->first(); 
        $registered->delete(); 

        return back()->with('success', 'Student Remove Successfully');
    }

    public function markAsComplete(Request $request) {
        $registeredCourse = RegisteredCourses::where('id',customDecryption($request->id))->first(); 

        $registeredCourse->update([
            'is_completed' => true,
            'status' => getConfig('registered_course_status.course_completed'),
            'certificate_generated' => true,
        ]);

        return back()->with('success', 'Successfully mark student as course_completed');
    }

    public function markAllCompleted(Request $request){
        $students = json_decode($request->students);
        foreach($students as $student){
            $registeredCourse = RegisteredCourses::where('id',$student->id)->first(); 
            $registeredCourse->update([
                'is_completed' => true,
                'status' => getConfig('registered_course_status.course_completed'),
                'certificate_generated' => true,
            ]);
        }

        return back()->with('success', 'Successfully mark all student as course_completed');

    } 

    public function generateCertificateForAllStudent(Request $request){
        $students = json_decode($request->students);
        foreach($students as $student){
            $registeredCourse = RegisteredCourses::where('id',$student->id)->first(); 
            $registeredCourse->update([
                'certificate_generated' => true,
            ]);
        }

        return back()->with('success', 'Successfully Generate Cert For All Students');

    } 


    public function generateCertificate(Request $request) {
        $registeredCourse = RegisteredCourses::where('id',customDecryption($request->id))->first(); 

        $registeredCourse->update([
            'certificate_generated' => true
        ]);

        return back()->with('success', "Successfully generate cert for student");
    }

    public function markCourseComplete(Request $request){
        $course = Courses::where('id', customDecryption(($request->course_id)))->first();

        $course->update([
            'is_completed' => true
        ]);

        return back()->with('success', "Successfully mark course as completed");
    }
}
