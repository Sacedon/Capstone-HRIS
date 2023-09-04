<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        return view('profile-show', compact('user'));
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
            'address' => 'nullable|string|max:255',
            'gender' => 'nullable|in:male,female,other',
            'date_of_birth' => 'nullable|date',
            'department' => 'nullable|string|max:255',
        ]);

        // Get the authenticated user
        $user = Auth::user();

        // Update the user's information
        $user->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'address' => $request->input('address'),
            'gender' => $request->input('gender'),
            'date_of_birth' => $request->input('date_of_birth'),
            'department' => $request->input('department'),
        ]);

        return redirect()->route('users.index')->with('success', 'Profile information updated successfully.');
    }
}
