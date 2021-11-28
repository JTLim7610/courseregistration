<?php

namespace App\Http\Controllers\Student\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    
    public function index(){
        return view('pages.student.register');
    }

    public function registerUser(Request $request){
        $user = User::create([
            'name' => $request->name, 
            'email' => $request->email, 
            'role_id' => getConfig('role.student'),
            'password' => Hash::make($request->password)
        ]);
        return view('pages.student.login')->with('success', "Register Successfully. You can now log in.");
    }

    // public function logout(Request $request)
    // {
    //     Auth::logout();
    //     return redirect('/auth');
    // }
}
