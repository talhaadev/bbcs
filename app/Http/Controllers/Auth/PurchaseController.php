<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\purchase;

class PurchaseController extends Controller
{

    public function index()
    {
        $purchases = purchase::with('user', 'plan')->get();

        return view('admin.purchase', ['purchases' => $purchases]);
    }

    public function purchase()
    {
        $purchases = purchase::with('user', 'plan')->where('user_id', Auth::user()->id)->get();

        return view('admin.purchase', ['purchases' => $purchases]);
    }

    public function store(Request $request)
    {
        // Find user and get balance
        $user = \App\Models\User::find($request->user_id);
        $planAmount = $request->amount;

        // Check if user has sufficient balance
        if ($user->balance < $planAmount) {
            return redirect()->back()->with('error', 'Insufficient balance!');
        }

        // Add entry to purchases table
        \App\Models\Purchase::create([
            'user_id' => $request->user_id,
            'plan_id' => $request->plan_id,
            'amount' => $planAmount,
        ]);

        // Deduct amount from user balance
        $user->balance -= $planAmount;
        $user->save();

        return redirect()->back()->with('success', 'Plan purchased successfully!');
    }
}
