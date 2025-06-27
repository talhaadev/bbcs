<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class PhoneAuthController extends Controller
{
    public function handleOtpLogin(Request $request)
    {
        $request->validate([
            'phone_number' => 'required|string'
        ]);

        $phone = $request->input('phone_number');

        $user = User::where('phone_number', $phone)->first();

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        Auth::login($user); // login using Laravel auth

        // Redirect user based on role
        $redirectUrl = match ($user->role) {
            'admin' => route('dashboard'),         // for admin
            'user' => route('user.dashboard'),     // for regular user
            default => url('/')                    // fallback
        };

        return response()->json([
            'message' => 'User logged in',
            'redirect' => $redirectUrl
        ]);
    }
}
