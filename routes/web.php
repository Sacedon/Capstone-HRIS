<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LeaveRequestController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\ChildController;
use App\Http\Controllers\EmployeeController;






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


// routes/web.php

Route::middleware('auth')->group(function () {
    Route::post('/additonal_fields', [ChildController::class, 'store'])->name('additional_fields.store');
    Route::delete('/additonal_fields/{id}', [ChildController::class, 'destroy'])->name('additional_fields.destroy');


});

// Login Routes



Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

});

Route::middleware('auth', 'supervisor')->group(function () {
    Route::get('/employee-users', [EmployeeController::class, 'showEmployeeDepartmentUsers'])->name('employee-users.index');
    Route::delete('/user/delete/{id}', [EmployeeController::class, 'deleteUser'])->middleware('role:admin')->name('user.delete');


});







Route::middleware('auth')->group(function () {
    Route::get('/evaluations', [EvaluationController::class, 'index'])->middleware('role:admin,supervisor')->name('evaluations.index');
    Route::get('/evaluations/form{user_id}', [EvaluationController::class, 'showForm'])->middleware('supervisor')->name('evaluations.form');
    Route::post('/evaluations', [EvaluationController::class, 'submitEvaluation'])->name('evaluations.submit');

});



Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/departments', [DepartmentController::class, 'index'])->name('departments.index');
    Route::get('/departments/create', [DepartmentController::class, 'create'])->name('departments.create');
    Route::post('/departments', [DepartmentController::class, 'store'])->name('departments.store');
    Route::get('/departments/{department}/edit', [DepartmentController::class, 'edit'])->name('departments.edit');
    Route::put('/departments/{department}', [DepartmentController::class, 'update'])->name('departments.update');
    Route::delete('/departments/{department}', [DepartmentController::class, 'destroy'])->name('departments.destroy');
});

Route::middleware('auth')->group(function () {
    Route::post('/notifications/mark-read', [NotificationController::class, 'markAsRead'])->name('notifications.markRead');
    Route::delete('/notifications/remove/{notification}', [NotificationController::class, 'remove'])->name('notifications.remove');



});



Route::middleware('auth')->group(function () {
    Route::get('/leave-requests', [LeaveRequestController::class, 'index'])->middleware('role:admin,supervisor')->name('leave-requests.index');
    Route::get('/leave-requests/create', [LeaveRequestController::class, 'create'])->name('leave-requests.create');
    Route::post('/leave-requests', [LeaveRequestController::class, 'store'])->name('leave-requests.store');
    Route::get('/leave-requests/{leaveRequest}', [LeaveRequestController::class, 'show'])->name('leave-requests.show');
    Route::post('/leave-requests/{leaveRequest}/accept', [LeaveRequestController::class, 'accept'])
    ->name('leave-requests.accept');
    Route::delete('/leave-requests/{leaveRequest}', [LeaveRequestController::class, 'destroy'])
        ->name('leave-requests.destroy');
    Route::post('/leave-requests/{leaveRequest}/reject', [LeaveRequestController::class, 'reject'])->name('leave-requests.reject');
    Route::get('leave-requests/filtered/{status}', [LeaveRequestController::class, 'filtered'])->name('leave-requests.filtered');
    Route::get('/leave-requests/filter-by-month/{month}', [LeaveRequestController::class, 'filterByMonth'])
    ->name('leave-requests.filter-by-month');
    Route::get('/users/{user}/leave-requests', [LeaveRequestController::class, 'showUserLeaveRequests'])->name('users.records');




});



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


});

Route::middleware('auth',)->group(function () {
    Route::get('profile-show', [UserController::class, 'show'])->name('profile-show');
    Route::post('profile-show', [UserController::class, 'updateProfilePicture'])->name('profile-show');
    Route::put('profile-show', [UserController::class, 'update'])->name('profile-show');
    Route::get('/user_report', [UserController::class, 'generate'])->name('user_report');
    Route::get('/additional_fields', [UserController::class, 'showAdditionalFields'])->name('additional_fields');
    Route::post('/update-additional-fields', [UserController::class, 'updateAdditionalFields'])->name('update-additional-fields');
});


Route::middleware(['auth', 'admin'])->group(function () {

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

Route::get('/logs', [RegisteredUserController::class, 'showLogs'])->name('logs.index');



});



// Routes for login and logout
// routes/web.php



// The rest of your routes...



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
