<?php

namespace App\Http\Controllers\Admin\Staff;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UpdateController extends Controller
{
    public function index(Request $request){
        $staff = User::where('id', customDecryption($request->id))->first();
        return view('pages.admin.main.staff.edit', compact('staff'));
    }

    public function update(Request $request){

        $user = User::where('id', customDecryption($request->id))->first();

        if($request->password){

            if($request->confirm_password !== $request->password)
                return back()->with('error', 'Confirm Password and Password Not Tally');

            $user->update([
                'name' => $request->name, 
                'email' => $request->email, 
                'role_id' => getConfig('role.staff') ,
                'password' => Hash::make($request->password)
            ]);
        
        }

        $user->update([
            'name' => $request->name, 
            'email' => $request->email, 
            'role_id' => getConfig('role.staff') 
        ]);
        
        return back()->with('success', 'Staff updated Successfully');
    }
}
