<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

use App\Models\Employee;
use App\Models\PasswordReset;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;

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
            } elseif (auth()->user()->role == 'employee') {
                $status = Employee::where('user_id', auth()->user()->id);
                $status->update([
                    'status' => 'active'
                ]);
                return redirect()->route('dashboard.list');
            }
        }
        return back()->withErrors([
            'email' => 'Invalid Credentials.'
        ]);
    }

    //logout
    public function logout()
    {

        // dd();
        if (auth()->user() != null) {
            if (auth()->user()->role == 'employee') {
                $status = Employee::where('user_id', auth()->user()->id);
                $status->update([
                    'status' => 'inactive'
                ]);
            }
        } else {
            // Auth::logout();
            return redirect()->route('login.form')->with('success-message', 'Not Logged In.');
        }

        Auth::logout();
        return redirect()->route('login.form')->with('success-message', 'Logout Successful.');
    }

    public function forgetPass()
    {

        return view('backend.login.forget-password');
    }

    public function createNewPass(Request $request)
    {

        $user = User::where('email', $request->email)->first();
        // dd($user);
        if ($user) {
            //send forget password link
            Password::sendResetLink(
                $request->only('email')
            );
            // dd($request->email);
            return redirect()->route('login.form')->with('success-message', 'Email sent to ' . $request->email);
        } else {
            return redirect()->route('login.form')->with('error-message', 'Email not found.');
        }
    }

    public function showResetForm($p_token, $p_email)
    {
        // dd($token);
        $check = PasswordReset::where('email', $p_email)->where('created_at', '>=', Carbon::now()->subMinutes(2))->first();
        if ($check) {
            $token = $p_token;
            $email = $p_email;
            return view('backend.login.reset-password', compact('token', 'email'));
        } else {
            return redirect()->route('login.form')->with('error-message', 'Link expired');
        }
    }

    public function submitPassword(Request $request)
    {

        // dd($request->all());

        $request->validate([
            'token' => 'required',
            'email' => 'email|required',
            'password' => 'required|min:6|confirmed'
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => bcrypt($password)
                ])->setRememberToken(Str::random(60));

                $user->save();
            }
        );

        return redirect()->route('login.form')->with('success-message', 'Password updated successfully.');
    }
}
