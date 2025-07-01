<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
class profileupodatecontroller extends Controller
{
public function update(Request $request)
{
    // Validate inputs
    $request->validate([
        'name' => 'required|string|max:255',
        'phone_number' => 'nullable|string|max:20',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
    ]);

    $user = Auth::user();

    // Assign values
    $user->name = $request->name;
    $user->phone_number = $request->phone_number;

    // Handle Image Upload
    if ($request->hasFile('image')) {
        // Delete old image if exists
        $oldImagePath = public_path('storage/profile/' . $user->image);
        if ($user->image && File::exists($oldImagePath)) {
            File::delete($oldImagePath);
        }

        // Save new image
        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('storage/profile'), $imageName);
        $user->image = $imageName;
    }

    // Save changes
    $user->save();

    return redirect()->back()->with('success', 'Profile updated successfully!');
}


}
