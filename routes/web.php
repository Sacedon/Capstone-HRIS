<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('/auth/login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


});

Route::middleware('auth')->group(function () {
    Route::get('profile-show', [UserController::class, 'show'])->name('profile-show');
    Route::post('profile-show', [UserController::class, 'updateProfilePicture'])->name('profile-show');
    Route::put('profile-show', [UserController::class, 'update'])->name('profile-show');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/users/create', [RegisteredUserController::class, 'create'])->name('users.create');

// Route to store a new user
Route::post('/users', [RegisteredUserController::class, 'store'])->name('users.store');

// Route to display the user edit form
Route::get('/users/{user}/edit', [RegisteredUserController::class, 'edit'])->name('users.edit');

// Route to update a user
Route::put('/users/{user}', [RegisteredUserController::class, 'update'])->name('users.update');

// Route to delete a user
Route::delete('/users/{user}', [RegisteredUserController::class, 'destroy'])->name('users.destroy');

// Route to view a user
Route::get('/users/{user}', [RegisteredUserController::class, 'show'])->name('users.show');

// Route to display a list of users
Route::get('/users', [RegisteredUserController::class, 'index'])->name('users.index');
});





// useless routes
// Just to demo sidebar dropdown links active states.
Route::get('/buttons/text', function () {
    return view('buttons-showcase.text');
})->middleware(['auth'])->name('buttons.text');

Route::get('/buttons/icon', function () {
    return view('buttons-showcase.icon');
})->middleware(['auth'])->name('buttons.icon');

Route::get('/buttons/text-icon', function () {
    return view('buttons-showcase.text-icon');
})->middleware(['auth'])->name('buttons.text-icon');

require __DIR__ . '/auth.php';
