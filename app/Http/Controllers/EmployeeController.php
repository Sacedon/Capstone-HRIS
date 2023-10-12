<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Department;

class EmployeeController extends Controller
{
    public function showEmployeeDepartmentUsers(Request $request)
{
    $departments = Department::all();
    $selectedDepartment = null;

    // Check if the logged-in user is a supervisor
    if (auth()->user()->role === 'supervisor') {
        $departmentId = auth()->user()->department_id;
        $selectedDepartment = Department::find($departmentId);

        $users = User::with('department')->where('department_id', $departmentId)->get();
    } else {
        $users = User::with('department')->get();
    }

    return view('employee-users.index', compact('users', 'departments', 'selectedDepartment'));
}

public function deleteUser($id)
{
    $user = User::findOrFail($id);

    // Check if the logged-in user is a supervisor
    if (auth()->user()->role === 'supervisor') {
        $supervisorDepartment = Department::find(auth()->user()->department_id);
        $userDepartment = Department::find($user->department_id);

        // Check if the department name of the supervisor matches the user's department name
        if ($supervisorDepartment->name === $userDepartment->name) {
            $user->delete();
            return redirect()->route('employee-users.index')->with('success', 'User deleted successfully');
        }
    }

    return redirect()->route('employee-users.index')->with('error', 'Permission denied. You cannot delete this user.');
}


}
