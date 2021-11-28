<?php

namespace App\Http\Controllers\Admin\Staff;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Rules\IsValidPassword;

class IndexController extends Controller
{
    public function index(Request $request){
        $staffs = User::where('role_id', getConfig('role.staff') ); 
        if($searchQuery = $request->input('query'))
			$staffs = $staffs->where(function ($query) use ($searchQuery) {
                $query->where('name', 'like', "%$searchQuery%");           
            });
        $staffs = $staffs->get();
        return view('pages.admin.main.staff.index',compact('staffs'));
    }

    public function createStaffPage(){
        return view('pages.admin.main.staff.add');
    }

    public function create(Request $request){
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
        ]);

        User::create([
            'name' => $request->name, 
            'email' => $request->email, 
            'role_id' => getConfig('role.staff'),
            'password' => Hash::make($request->password),
            'activity_token'=>\Str::random(60),
            'activity_expire'=>null,
            'is_activity' => 1,
        ]);

        return redirect()->route('admin.account.staff.index')->with('success', 'Staff Created Successfully');
    }

    public function removeStaff(Request $request){
        $user = User::where('id', $request->user_id)->first(); 

        $user->delete();

        return back()->with('success', 'Staff Deleted Successfully');
    }
}
