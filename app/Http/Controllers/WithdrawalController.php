<?php

namespace App\Http\Controllers;

use App\Models\Withdrawal;
use Illuminate\Http\Request;

class WithdrawalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function withdrawl()
    {
        $withdrawl = Withdrawal::where('user_id', auth()->user()->id)->get();

        return view('user.withdrawals.withdrawl', compact('withdrawl'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.withdrawals.withdrawl_create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        unset($data['_token']);
        if ($request->hasFile('proof')) {
            $file = $request->file('proof');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $directory = 'Files';
            $file->storeAs($directory, $fileName, 'public');
            $url = url('/');
            $data['proof'] = $fileName;
        }
        $data['user_id'] = auth()->user()->id;
        $withdrawls =  new Withdrawal();
        $withdrawls->create($data);

        return redirect()->route('user.withdrawl')->with('success', 'Withdrawal request created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Withdrawal $withdrawls)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Withdrawal $withdrawls)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Withdrawal $withdrawls)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Withdrawal $withdrawls)
    {
        //
    }
}
