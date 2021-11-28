<?php

namespace App\Http\Controllers\Student\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Authenticatable;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use Authenticatable; 
    use AuthenticatesUsers;

    #login page 
    public function index() 
    {
        # Check if user already login - redirect back to account page 
        if(Auth::check()) 
            return redirect('/account');
            
        return view('pages.student.login');
    }

    #login function 
    public function login(Request $request){
        # 0 : Check if user exists 
        $user = User::where('email',$request->email)->first();
        if($user)
        {
            # 1 : Check if user is not superadmin or staff 
            if(!$user->checkRole(['superadmin','staff']))
            {
                # 2 : Check login credential
                $credentials = $request->only('email', 'password');    
                if (Auth::attempt($credentials))
                   return redirect()->intended('/account');                        
            }

        } 
   
       return back()->with('err', "Incorrect Username or Password");
   }
}
