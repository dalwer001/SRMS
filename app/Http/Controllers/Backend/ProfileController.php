<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Commission;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function employeeProfile()
    {
        $title = 'User Profile';
        $users = auth()->user();
        $employees = $users->employeeProfile;
        $commission = Commission::where('employee_id',$employees->id)->get();
        return view('backend.contents.profiles.profiles-list', compact('title', 'users', 'employees','commission'));
    }


    public function profileUpdate(Request $request)
    {


        if (!Hash::check($request->input('current_password'), auth()->user()->password)) {
            return redirect()->back()->with('error-message', 'Current Password does not match.');
        }


        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6',
            'confirm_password' => 'required|same:new_password'

        ]);


        if (Hash::check($request->input('new_password'), auth()->user()->password)) {
            return redirect()->back()->with('error-message', 'New password can not be the old password.');
        }


        $users = User::find(auth()->user()->id);
        // dd($users);
        $users->update([
            'password' => bcrypt($request->new_password)
        ]);

        // $users->password = $request->bcrypt($request->password);
        // $users->save();
        return redirect()->back()->with('success-message', 'Password updated successfully.');
    }
}
