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
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'surname' => ['required', 'string', 'max:255'],
            'first_name' => ['required', 'string', 'max:255'],
            'middle_name' => ['nullable', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|string|in:user,admin',
            'address' => 'nullable|string|max:255',
            'gender' => 'nullable|in:male,female,other',
            'date_of_birth' => 'nullable|date',
            'department' => 'nullable|string|max:255',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'civil_status' => ['nullable', 'string', 'in:single,married,separated,widowed'],
            'height' => ['nullable', 'numeric', 'min:0'],
            'weight' => ['nullable', 'numeric', 'min:0'],
            'blood_type' => ['nullable', 'string', 'max:255'],
            'sss_id_no' => ['nullable', 'string', 'max:255'],
            'pag_ibig_id_no' => ['nullable', 'string', 'max:255'],
            'philhealth_no' => ['nullable', 'string', 'max:255'],
            'tin_no' => ['nullable', 'string', 'max:255'],
            'mdc_id' => ['nullable', 'string', 'max:255'],
            'place_of_birth' => ['nullable', 'string', 'max:255'],
        ]);

        $imagePath = $request->hasFile('profile_picture')
            ? $request->file('profile_picture')->store('profile_pictures', 'public')
            : null;

        $user = User::create([
            'username' => $request->username,
            'surname' => $request->surname,
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
            'address' => $request->address,
            'gender' => $request->gender,
            'date_of_birth' => $request->date_of_birth,
            'department' => $request->department,
            'profile_picture' => $imagePath,
            'civil_status' => $request->civil_status,
            'height' => $request->height,
            'weight' => $request->weight,
            'blood_type' => $request->blood_type,
            'sss_id_no' => $request->sss_id_no,
            'pag_ibig_id_no' => $request->pag_ibig_id_no,
            'philhealth_no' => $request->philhealth_no,
            'tin_no' => $request->tin_no,
            'mdc_id' => $request->mdc_id,
            'place_of_birth' => $request->place_of_birth,
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
        'surname' => ['required', 'string', 'max:255'],
        'first_name' => ['required', 'string', 'max:255'],
        'middle_name' => ['nullable', 'string', 'max:255'],
        'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        'role' => 'required|string|in:user,admin',
        'address' => 'nullable|string|max:255',
        'gender' => 'nullable|in:male,female,other',
        'date_of_birth' => 'nullable|date',
        'department' => 'nullable|string|max:255',
        'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust the validation rules as needed.
        'civil_status' => ['nullable', 'string', 'in:single,married,separated,widowed'],
        'height' => ['nullable', 'numeric', 'min:0', 'max:999.99'],
        'weight' => ['nullable', 'numeric', 'min:0', 'max:999.99'],
        'blood_type' => ['nullable', 'string', 'max:255'],
        'sss_id_no' => ['nullable', 'string', 'max:255'],
        'pag_ibig_id_no' => ['nullable', 'string', 'max:255'],
        'philhealth_no' => ['nullable', 'string', 'max:255'],
        'tin_no' => ['nullable', 'string', 'max:255'],
        'mdc_id' => ['nullable', 'string', 'max:255'],
        'place_of_birth' => ['nullable', 'string', 'max:255'],
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
