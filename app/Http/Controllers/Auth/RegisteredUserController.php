<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {

        return view('users.create');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|string|in:user,admin',
            'address' => 'nullable|string|max:255',
            'gender' => 'nullable|in:male,female,other',
            'date_of_birth' => 'nullable|date',
            'department' => 'nullable|string|max:255',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = $request->hasFile('profile_picture')
            ? $request->file('profile_picture')->store('profile_pictures', 'public')
            : null;

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
            'address' => $request->address,
            'gender' => $request->gender,
            'date_of_birth' => $request->date_of_birth,
            'department' => $request->department,
            'profile_picture' => $imagePath,
        ]);

        event(new Registered($user));



        return redirect()->route('users.index')
            ->with('success', 'User created successfully.');
    }

    public function index()
{

    $users = User::all();
    $header = 'Users'; // Set the header title
    return view('users.index', compact('users', 'header'));
}

public function show(User $user)
    {

        return view('users.show', compact('user'));
    }

public function edit(User $user)
{
    return view('users.edit', compact('user'));
}

public function update(Request $request, User $user)
{
    // Validate form data, including profile_picture field.
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        'role' => 'required|string|in:user,admin',
        'address' => 'nullable|string|max:255',
        'gender' => 'nullable|in:male,female,other',
        'date_of_birth' => 'nullable|date',
        'department' => 'nullable|string|max:255',
        'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust the validation rules as needed.
    ]);

    // Handle profile picture upload.
    if ($request->hasFile('profile_picture')) {
        // Delete the old profile picture if it exists.
        if ($user->profile_picture) {
            Storage::disk('public')->delete($user->profile_picture);
        }

        // Store the new profile picture.
        $imagePath = $request->file('profile_picture')->store('profile_pictures', 'public');
        $user->profile_picture = $imagePath; // Update the user's profile_picture field.
    }

    // Update other user information.
    $user->update($request->except('profile_picture'));

    return redirect()->route('users.index')->with('success', 'User updated successfully.');
}



public function destroy(User $user)
{
    $user->delete();
    return redirect()->route('users.index');
}


}
