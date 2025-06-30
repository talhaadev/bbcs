<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Plan;
use App\Models\Deposit;
use App\Models\Withdrawal;
use App\Models\Reward;
class UserDashboardController extends Controller
{
    public function dashboard(Request $request)
    {
        if (!Auth::user() || Auth::user()->role != 'user') {
            return view('auth.login');
        }
        $users = User::where('p_id', Auth::id())->get();
        $plans =  Plan::all();
        $totalDeposit = Deposit::where('user_id', Auth::id())->where('status','accepted')->sum('amount');
        $totalWithdrawal = Withdrawal::where('user_id', Auth::id())->where('status','accepted')->sum('amount');

        // dd($users);
        return view('user.dashboard',compact('users','plans','totalDeposit','totalWithdrawal'));
    }
    public function profile(Request $request)
    {
        if (!Auth::user() || Auth::user()->role != 'user') {
            return view('auth.login');
        }
        return view('user.profile');
    }

    public function getReward($id)
    {
        $user = User::find($id);
        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }
        if($user->balance <= 0){
            return redirect()->back()->with('error', 'Insufficient balance to receive reward.');
        }

       $percentage = $user->percentage;
       if($percentage == 0){
           return redirect()->back()->with('error', 'Reward percentage is not set for this user.');
         }
        $today = now()->format('Y-m-d');

        $reward = Reward::where('user_id', $id)
            ->whereDate('created_at', $today)
            ->first();

        if ($reward) {
            return redirect()->back()->with('error', 'You have already received your reward for today.');

        }

        if($reward == null){
            $reward = new Reward();
            $reward->user_id = $id;
            $reward->amount = $user->balance * ($percentage / 100);
            $reward->save();
            return redirect()->back()->with('success', 'Reward received successfully!');
        }

        return redirect()->back();


    }
}
