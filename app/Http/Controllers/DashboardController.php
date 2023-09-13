<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\LeaveRequest;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
{
    $totalUsers = User::count();
    $totalAcceptedRequests = LeaveRequest::where('status', 'accepted')->count();
    $totalPendingRequests = LeaveRequest::where('status', 'pending')->count();
    $totalRejectedRequests = LeaveRequest::where('status', 'rejected')->count();

    return view('dashboard', compact('totalUsers', 'totalAcceptedRequests', 'totalPendingRequests', 'totalRejectedRequests'));
}
}
