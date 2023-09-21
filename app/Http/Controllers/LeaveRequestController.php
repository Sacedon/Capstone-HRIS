<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LeaveRequest;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use App\Notifications\LeaveRequestAccepted;
use Illuminate\Support\Facades\Notification;
use App\Notifications\LeaveRequestRejected;

class LeaveRequestController extends Controller
{
    public function index()
    {
        // Fetch and display leave requests
        $leaveRequests = LeaveRequest::all();
        return view('leave_requests.index', compact('leaveRequests'));
    }

    public function create()
    {
        // Display the leave request form
        return view('leave_requests.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'reason' => 'required|string|max:255',
            'other_reason' => 'required|string|max:255',
            'leave_type' => 'required|in:vacation,sick,personal',

        ]);

        $request->merge(['status' => 'pending']);

        LeaveRequest::create([
            'user_id' => auth()->id(),
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),
            'reason' => $request->input('reason'),
            'other_reason' => $request->input('other_reason'),
            'status' => $request->input('status'),
            'leave_type' => $request->input('leave_type')

        ]);

        return redirect()->route('dashboard')->with('success', 'Leave request submitted successfully.');
    }

    public function show(LeaveRequest $leaveRequest)
{
    return view('leave_requests.show', compact('leaveRequest'));
}

public function accept(Request $request, LeaveRequest $leaveRequest)
{

    // Check if the leave request status is pending before accepting
    if ($leaveRequest->status === 'pending') {
        $leaveRequest->update([
            'status' => 'accepted',
        ]);

        $leaveRequest->user->notify(new LeaveRequestAccepted($leaveRequest));



        return redirect()->route('leave-requests.index', $leaveRequest)->with('success', 'Leave request accepted.');
    }

    return back()->with('error', 'Leave request cannot be accepted.');
}

public function reject(LeaveRequest $leaveRequest)
{

    // Check if the leave request status is pending before rejecting
    if ($leaveRequest->status === 'pending') {
        $leaveRequest->update([
            'status' => 'rejected',
        ]);


        $leaveRequest->user->notify(new LeaveRequestRejected($leaveRequest));

        return redirect()->route('leave-requests.index', $leaveRequest)->with('success', 'Leave request rejected.');
    }

    return back()->with('error', 'Leave request cannot be rejected.');
}


public function destroy(LeaveRequest $leaveRequest)
    {
        // Check if the leave request belongs to the authenticated user


        // Delete the leave request
        $leaveRequest->delete();

        return redirect()->route('leave-requests.index')->with('success', 'Leave request deleted successfully.');
    }

    public function filtered($status)
{
    // Retrieve leave requests based on the status
    $leaveRequests = LeaveRequest::where('status', $status)->get();

    // Return the view with filtered leave requests
    return view('leave_requests.index', compact('leaveRequests'));
}

public function dashboard()
{
    $totalUsers = User::count();
    $totalAcceptedRequests = LeaveRequest::where('status', 'accepted')->count();
    $totalPendingRequests = LeaveRequest::where('status', 'pending')->count();
    $totalRejectedRequests = LeaveRequest::where('status', 'rejected')->count();

    return view('dashboard', compact('totalUsers', 'totalAcceptedRequests', 'totalPendingRequests', 'totalRejectedRequests'));
}

}
