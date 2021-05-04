<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function showLoginForm()
    {

        return view('backend.login.login-list');
    }

    //login
    public function login(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);



        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            if (auth()->user()->role == 'admin') {
                return redirect()->route('dashboard.list');
            } 
            
            elseif (auth()->user()->role == 'employee') {
                $status = Employee::where('user_id', auth()->user()->id);
                $status->update([
                    'status'=> 'active'
                ]);
                return redirect()->route('newSale.list');
            }

        }
        return back()->withErrors([
            'email' => 'Invalid Credentials.'
        ]);
    }

    //logout
    public function logout()
    {
        if(auth()->user()->role == 'employee')
        {
            $status = Employee::where('user_id', auth()->user()->id);
            $status->update([
                'status'=> 'inactive'
            ]);
        }
        Auth::logout();
        return redirect()->route('login.form')->with('success', 'Logout Successful.');
    }
}
