<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class UserDashboardController extends Controller
{
    public function dashboard(Request $request)
    {
        if (!Auth::user() || Auth::user()->role != 'user') {
            return view('auth.login');
        }
        return view('user.dashboard');
    }
}
