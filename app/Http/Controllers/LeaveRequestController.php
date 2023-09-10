<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LeaveRequest;

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
        ]);

        $request->merge(['status' => 'pending']);

        LeaveRequest::create([
            'user_id' => auth()->id(),
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),
            'reason' => $request->input('reason'),
            'status' => $request->input('status'),
        ]);

        return redirect()->route('leave-requests.index')->with('success', 'Leave request submitted successfully.');
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
}
