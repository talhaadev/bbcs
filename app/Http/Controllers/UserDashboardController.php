<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
class UserDashboardController extends Controller
{
    public function dashboard(Request $request)
    {
        if (!Auth::user() || Auth::user()->role != 'user') {
            return view('auth.login');
        }
        $users = User::where('p_id', Auth::id())->get();
        // dd($users);
        return view('user.dashboard',compact('users'));
    }
    public function profile(Request $request)
    {
        if (!Auth::user() || Auth::user()->role != 'user') {
            return view('auth.login');
        }
        return view('user.profile');
    }
}
