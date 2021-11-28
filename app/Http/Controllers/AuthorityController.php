<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Payments;
use App\Models\CourseDetails;
use Illuminate\Support\Str;
use Illuminate\Auth\Authenticatable;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Date; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Rules\IsValidPassword;
use App\Models\RegisteredCourses;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Notifications\WelcomeEmailNotiications;
use App\Listeners\WelcomeEmailListeners;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestMail;
use App\Mail\VerifyNewRegister;

class AuthorityController extends Controller
{
    use Authenticatable; 
    use AuthenticatesUsers;

    public function index()
    {      
        return view('login');
    }

    #login page 
    // public function loginPage() 
    // {
    //     # Check if user already login - redirect back to account page 
    //     if(Auth::check())
    //     {
    //         return redirect('/index'); 
    //     }
    //     else
    //     {
    //         return view('login');      
    //     }
    // }

    public function regisPage(){
        return view('register');
    }

    public function attemptLogin(Request $request)
    {
        // $request->validate([
        //     'g-recaptcha-response' => 'required|captcha',
        // ]);

        if (Auth::attempt(['email' =>  $request->email, 'password' =>  $request->password, 'is_activity'=>1])) {
            $user = User::where('email',$request->email)->first();

            if($user)
            {
                # is admin and staff
                # 1 : Check user role
                if($user->checkRole(['superadmin','staff']))
                {
                    # 2 : Check login credential
                    $credentials = $request->only('email', 'password');    
                    if (Auth::attempt($credentials))
                    {
                    return redirect()->intended('/admin/account');
                    }    
                }
                # is student
                else if(!$user->checkRole(['superadmin','staff']))
                {
                    # 2 : Check login credential
                    $credentials = $request->only('email', 'password');    
                    if (Auth::attempt($credentials))
                    {
                        return redirect()->intended('/student/account');
                    }    
                }
            }
        }
        else if(Auth::attempt(['email' =>  $request->email, 'password' =>  $request->password, 'is_activity'=>0]))
        {
            return back()->with('err', "Your account have not activated. Please verify activate your account.");
        }
        else
        {
            return back()->with('err', "Incorrect Username or Password");
        }
    }

   public function registerUser(Request $request){
    //validate the user information
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => [
            'required',
            'string',
            'confirmed',
            // call isValidPassword to check the password validation         
            new isValidPassword(),
        ],
        'g-recaptcha-response' => 'required|captcha',

    ]);

    //create the user
    $user = User::create([
        'name' => $request->name, 
        'email' => $request->email, 
        'role_id' => getConfig('role.student'),
        'password' => Hash::make($request->password),
        'activity_token'=>\Str::random(60),
        'activity_expire'=>Date::now('+24 hours'),
    ]);

    //call event to send welcome email to new user
    // event(new Registered($user));
    Mail::to($user->email)->send(new VerifyNewRegister($user));

    // return view('login')->with('success', "Register Successfully. You can now log in.");
    return view('pages.notificationView.verifyNotification');
}

   public function logout(Request $request)
   {
       Auth::logout();
       return redirect('/')->withSuccess('Logout Successfully');
   }


   public function verifyAccount($request)
   {      
        $user = User::where('activity_token', $request)->first();
        $res = false;
        if($user && strtotime($user->activity_expire)>time())
        {
            $user->is_activity = 1;
            $res = $user->save();
        }
        return view('pages.notificationView.VerificationView',['res'=>$res]);
   }
   
   public function verifyCourse($request)
   {      
        $registeredCourses = RegisteredCourses::where('activity_token', $request)->first();
        $courseDetails = CourseDetails::where('id', $registeredCourses->course_id)->first();

        $res = false;
        if($registeredCourses && strtotime($registeredCourses->activity_expire)>time())
        { 
            $payment = Payments::create([
                'uuid' => Str::uuid(),
                'amount' => $courseDetails->price, 
                'user_id' => $registeredCourses->user_id, 
            ]);

            $registeredCourses->update([
                'payment_id' => $payment->id,
                'status' => getConfig('registered_course_status.pending_payment'),
            ]);

            $res = $registeredCourses->save();
        }
        
        return view('pages.notificationView.newCourseVerification',['res'=>$res]);
   }
}
