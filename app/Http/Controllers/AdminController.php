<?php

namespace App\Http\Controllers;

use App\Helpers\GlobalFunctionsTrait;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    use GlobalFunctionsTrait;
    public function dashboard(Request $request)
    {
        if (!Auth::user() || Auth::user()->role != 'admin') {
            return view('auth.login');
        }
        return view('admin.dashboard');
    }
    public function getSettings()
    {
        $user = Auth::user();
        $paypal_client_id = $this->getConfigValue('paypal_client_id');
        $paypal_secret = $this->getConfigValue('paypal_secret');
        $paypal_mode = $this->getConfigValue('paypal_mode');
        $paypal_status = $this->getConfigValue('paypal_status');
        return view('admin.setting', compact(
            'user',
            'paypal_client_id',
            'paypal_secret',
            'paypal_status',
            'paypal_mode'
        ));
    }
    public function editSetting(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|max:50',
        ]);
        if (isset($request->password)) {
            $request->validate([
                'password' => 'required|confirmed|min:6'
            ]);
        }
        $id = Auth::id();
        $user = User::find($id);
        if ($request->hasFile('profile_image')) {
            $file = $request->file('profile_image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $path = 'upload/admin/profile/';
            $file->move(public_path($path), $filename);
            $profile_image = $path . $filename;
            $user->profile_image = $profile_image;
        }
        $user->name = $request->name;
        if (isset($request->password)) {
            $user->decoded_password = $request->password;
            $user->password = Hash::make($request->password);
        }
        $user->update();

        return redirect()->route('setting')->with('success', 'Basic Settings Updated.');
    }
    

    public function paymentSetting(Request $request)
    {
        // PayPal Settings
        $this->storeGlobalConfig('paypal_client_id', $request->paypal_client_id);
        $this->storeGlobalConfig('paypal_secret', $request->paypal_secret);
        $this->storeGlobalConfig('paypal_mode', $request->paypal_mode);
        $this->storeGlobalConfig('paypal_status', $request->has('paypal_status') ? 1 : 0);
        
        
        return redirect()->route('setting')->with('success', 'Payment settings updated successfully');
    }
}
