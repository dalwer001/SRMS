<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function employeeProfile()
    {
        $title = 'User Profile';
        $users = auth()->user();
        $employees = $users->employeeProfile;
        return view('backend.contents.profiles.profiles-list', compact('title', 'users', 'employees'));
    }
}
