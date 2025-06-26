<?php

namespace App\Http\Controllers;

use App\Models\Deposit;
use Illuminate\Http\Request;

class DepositController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function deposits()
    {
        $deposits = Deposit::where('user_id', auth()->user()->id)->get();

        return view('user.deposits', compact('deposits'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.deposits_create');
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
        $deposit =  new Deposit();
        $deposit->create($data);

        return redirect()->route('user.deposits')->with('success', 'Deposit request created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Deposit $deposit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Deposit $deposit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Deposit $deposit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Deposit $deposit)
    {
        //
    }
}
