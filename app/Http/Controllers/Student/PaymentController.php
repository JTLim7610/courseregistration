<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Payments;
use App\Models\RegisteredCourses;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Courses;
use Illuminate\Support\Facades\Mail;
use App\Mail\paymentDone;

class PaymentController extends Controller
{
    public function index(){       
        $user = Auth::user();
        $pending_payments = RegisteredCourses::with(['course', 'payment'])->where('user_id', $user->id)->where('status', getConfig('registered_course_status.pending_payment'))->get();
        return view('pages.student.main.payment', compact('pending_payments'));
    }

    public function uploadReceipt(Request $request){
        $payment = Payments::where('id', $request->payment_id)->first();
        $course = Courses::where('id', $request->course_id)->first();
        $user = User::where('id', $request->user_id)->first();

        $file = $request->file('payslip');
        $picName = $file->getClientOriginalName();
        $imagePath = '/public/payslip/';
        $file->move(public_path($imagePath), $picName);

        $payment->update([
            'payslip' => '/public/payslip/' .$picName
        ]);

        Mail::to('demo@admin.com')->send(new paymentDone($user, $course));

        return back()->with('success', 'Payslip uploaded successfully');
    }
}
