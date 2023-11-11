<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\LeaveRequest;
use App\Models\Department;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
{
    $totalUsers = User::count();
    $totalAcceptedRequests = LeaveRequest::where('status', 'approved')->count();
    $totalPendingRequests = LeaveRequest::whereIn('status', ['pending_supervisor', 'pending_admin'])->count();
    $totalRejectedRequests = LeaveRequest::where('status', 'rejected')->count();

    $departments = Department::withCount('users')->get();

    return view('dashboard', compact('totalUsers', 'totalAcceptedRequests', 'totalPendingRequests', 'totalRejectedRequests', 'departments'));
}
}
