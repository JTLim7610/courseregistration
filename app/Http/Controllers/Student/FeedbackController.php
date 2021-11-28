<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    public function index(){
        return view('pages.student.main.feedback');
    }

    public function create(Request $request) {

        // dd($request->all());
        $user = Auth::user();

        $feedback = Feedback::create([
            'feedback_type' =>  $request->feedback_type, 
            'feedback' => $request->feedback, 
            'user_id' => $user->id
        ]);


        return back()->with('success', 'Thanks for the feedback');
    }
}
