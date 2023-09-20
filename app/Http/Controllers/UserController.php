<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Department;
use Illuminate\Support\Facades\Storage; // Import the Storage facade.
use App\Models\User;

class UserController extends Controller
{
    public function show()
    {
        // Retrieve the authenticated user
        $user = Auth::user();

        // Load any additional user-related data if needed
        // Example: $user->load('profile');

        // Pass user data to the dashboard view
        $departments = Department::all();
        return view('profile-show', compact('user', 'departments'));
    }

    public function updateProfilePicture(Request $request)
    {
        // Validate the uploaded file
        $request->validate([
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust validation rules as needed
        ]);

        // Get the authenticated user
        $user = Auth::user();

        // Handle profile picture upload
        if ($request->hasFile('profile_picture')) {
            // Delete the old profile picture if it exists
            if ($user->profile_picture) {
                Storage::disk('public')->delete($user->profile_picture);
            }

            // Store the new profile picture
            $imagePath = $request->file('profile_picture')->store('profile_pictures', 'public');
            $user->profile_picture = $imagePath;
        }



        $user->save(); // Save the user model

        return redirect()->route('profile.show')->with('success', 'Profile picture updated successfully.');
    }

    public function update(Request $request)
    {
        // Validate the form data
        $request->validate([
            'surname' => ['required', 'string', 'max:255'],
            'first_name' => ['required', 'string', 'max:255'],
            'middle_name' => ['nullable', 'string', 'max:255'],
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
            'address' => 'nullable|string|max:255',
            'gender' => 'nullable|in:male,female,other',
            'date_of_birth' => 'nullable|date',
            'department' => 'nullable|string|in:CAST,CCJ,COE,CON,CABM-H,CABM-M',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = Auth::user();

        // Get the authenticated user
        if ($request->hasFile('profile_picture')) {
            // Delete the old profile picture if it exists.
            if ($user->profile_picture) {
                Storage::disk('public')->delete($user->profile_picture);
            }

            // Store the new profile picture.
            $imagePath = $request->file('profile_picture')->store('profile_pictures', 'public');
            $user->profile_picture = $imagePath; // Update the user's profile_picture field.
        }

        if ($request->has('department')) {
            $department = Department::where('name', $request->input('department'))->first();
            $user->department()->associate($department);
        }

        // Update other user information.
        $user->update($request->except('profile_picture'));

        return redirect()->route('users.index')->with('success', 'Profile information updated successfully.');
    }
}
