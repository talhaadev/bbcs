<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login based on role and status.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function authenticated()
    {
        // if (Auth::user()->status == 0) {
        //     // Redirect to homepage with a warning message if user is blocked
        //     return redirect('/')->with('warning', 'Your status is blocked, please contact super admin!');
        // }

        // Redirect based on user role
        $role = Auth::user()->role;
        $dashboardRoute = match ($role) {
            'admin' => 'admin/dashboard',
            'user' => 'user/dashboard',
            default => '/',
        };

        return redirect($dashboardRoute)->with('success', 'Login successfully.');
    }

    /**
     * Customize the username field to accept either email or username.
     *
     * @return string
     */
    public function username()
    {
        return 'login';
    }

    /**
     * Handle the login request with support for "Remember Me."
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = $this->credentials($request);
        $remember = $request->has('remember'); // Check if "Remember Me" is selected

        if (Auth::attempt($credentials, $remember)) {
            // Successful login
            return $this->authenticated();
        }

        // Failed login
        return redirect()->back()->withErrors([
            'email' => 'Invalid email or password',
        ])->withInput($request->except('password'));
    }

    /**
     * Customize the credentials used for login, allowing login by email or username.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    protected function credentials(Request $request)
    {
        $userName = trim($request->input('email'));
        $loginField = filter_var($userName, FILTER_VALIDATE_EMAIL) ? 'email' : 'user_name';

        return [
            $loginField => $userName,
            'password' => trim($request->input('password')),
        ];
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }
}
