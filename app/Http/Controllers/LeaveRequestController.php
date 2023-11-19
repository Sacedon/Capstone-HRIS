<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LeaveRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Department;
use Illuminate\Support\Facades\Session;
use App\Notifications\LeaveRequestAccepted;
use Illuminate\Support\Facades\Notification;
use App\Notifications\LeaveRequestRejected;
use App\Notifications\LeaveRequestCreated;
use App\Notifications\SupervisorApprovedLeaveRequest;
use App\Notifications\LeaveRequestEndedNotification;


class LeaveRequestController extends Controller
{
    public function index()
    {
        // Fetch and display leave requests
        $user = auth()->user();

        $leaveRequests = LeaveRequest::where(function ($query) use ($user) {
            if ($user->role === 'supervisor') {
                $query->whereIn('status', ['pending_supervisor', 'pending_admin', 'rejected', 'approved', 'ended']);
            } elseif ($user->role === 'admin') {
                $query->whereIn('status', ['pending_admin', 'approved', 'rejected', 'ended']);
            }
        })
        ->orderBy('created_at', 'desc') // Order by creation date in descending order
        ->get();

        // Check and update status for approved leave requests with end date passed
        foreach ($leaveRequests as $leaveRequest) {
            if ($leaveRequest->status === 'approved' && now() > $leaveRequest->end_date && $leaveRequest->status !== 'ended') {
                $leaveRequest->update(['status' => 'ended']);

                // Notify the employee
                $leaveRequest->user->notify(new LeaveRequestEndedNotification($leaveRequest));
            }
        }

        // Paginate the results
        $leaveRequests = LeaveRequest::orderBy('created_at', 'desc')->paginate(10);

        return view('leave_requests.index', compact('leaveRequests'));
    }

    public function create()
    {
        // Display the leave request form
        return view('leave_requests.create');
    }

    public function store(Request $request, LeaveRequest $leaveRequest)
{

    $user = auth()->user();

    // Check if the user has any pending leave requests
    $pendingRequest = $user->leaveRequests()->whereIn('status', ['pending_supervisor', 'pending_admin'])->exists();

    if ($pendingRequest) {
        return redirect()->route('dashboard')->with('error', 'You have a pending or approved leave request. You cannot submit another one until it is resolved.');
    }

    $request->validate([
        'start_date' => 'required|date',
        'end_date' => 'required|date|after:start_date',
        'reason' => 'required|array',
        'other_reason' => 'required|string|max:255',
        'leave_type' => 'required|in:vacation,sick,personal',
    ]);

    $reason = implode(', ', $request->input('reason'));


    LeaveRequest::create([
        'user_id' => $user->id,
        'start_date' => $request->input('start_date'),
        'end_date' => $request->input('end_date'),
        'reason' => $reason,
        'other_reason' => $request->input('other_reason'),
        'status' => 'pending_supervisor',
        'leave_type' => $request->input('leave_type')
    ]);

    $department = $user->department;

    if ($department) {
        $supervisor = User::where('role', 'supervisor')
            ->where('department_id', $department->id)
            ->first();

        if ($supervisor) {
            $supervisor->notify(new LeaveRequestCreated($leaveRequest, $user));
        }
    }

    return redirect()->route('dashboard')->with('success', 'Leave request submitted successfully.');
}




    public function show(LeaveRequest $leaveRequest)
{
    $leaveRequests = LeaveRequest::all(); // You can modify this query to fetch the relevant leave requests.

    if ($leaveRequest->status === 'pending_supervisor' && auth()->user()->role === 'supervisor') {
        // Show supervisor approval form
        return view('leave_requests.show', compact('leaveRequest', 'leaveRequests'));
    } elseif ($leaveRequest->status === 'pending_admin' && auth()->user()->role === 'admin') {
        // Show admin approval form
        return view('leave_requests.show', compact('leaveRequest', 'leaveRequests'));
    } else {
        // Show leave request details for others
        return view('leave_requests.show', compact('leaveRequest', 'leaveRequests'));
    }
}



public function accept(Request $request, LeaveRequest $leaveRequest)
{

    // Check if the leave request status is pending before accepting
    $approvalType = $request->input('approval_type');

        if ($approvalType === 'supervisor') {
            // Check if the leave request status is pending_supervisor before supervisor's approval
            if ($leaveRequest->status === 'pending_supervisor') {
                $leaveRequest->update([
                    'status' => 'pending_admin', // Move to admin approval status
                    'supervisor_approval' => true, // Mark as supervisor approved
                ]);

                // Notify the user about supervisor's approval
                $admin = User::where('role', 'admin')->first();
                if ($admin) {
                    $admin->notify(new SupervisorApprovedLeaveRequest($leaveRequest, $admin));
                }

                return redirect()->route('leave-requests.show', $leaveRequest)->with('success', 'Supervisor approved the leave request.');
            }
        } elseif ($approvalType === 'admin') {
            // Check if the leave request status is pending_admin before admin's approval
            if ($leaveRequest->status === 'pending_admin') {
                $leaveRequest->update([
                    'status' => 'approved', // Final approval
                    'admin_approval' => true, // Mark as admin approved
                ]);

                // Notify the user about admin's approval
                $leaveRequest->user->notify(new LeaveRequestAccepted($leaveRequest));

                return redirect()->route('leave-requests.index')->with('success', 'Leave request approved.');
            }
        }

        return back()->with('error', 'Leave request cannot be approved.');
}

public function reject(Request $request, LeaveRequest $leaveRequest)
{
    // Check if the leave request status is pending before rejecting
    $rejectionType = $request->input('rejection_type');

    if ($rejectionType === 'supervisor') {
        // Check if the leave request status is pending_supervisor before supervisor's rejection
        if ($leaveRequest->status === 'pending_supervisor') {
            $leaveRequest->update([
                'status' => 'rejected', // Mark as rejected
                'supervisor_approval' => false, // Mark as supervisor rejection
            ]);

            // Notify the user about supervisor's rejection
            $leaveRequest->user->notify(new LeaveRequestRejected($leaveRequest));

            return redirect()->route('leave-requests.show', $leaveRequest)->with('success', 'Supervisor rejected the leave request.');
        }
    } elseif ($rejectionType === 'admin') {
        // Check if the leave request status is pending_admin before admin's rejection
        if ($leaveRequest->status === 'pending_admin') {
            $leaveRequest->update([
                'status' => 'rejected', // Mark as rejected
                'admin_approval' => false, // Mark as admin rejection
            ]);

            // Notify the user about admin's rejection
            $leaveRequest->user->notify(new LeaveRequestRejected($leaveRequest));

            return redirect()->route('leave-requests.show', $leaveRequest)->with('success', 'Admin rejected the leave request.');
        }
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
        // Query leave requests based on the status
        $query = LeaveRequest::query();

        if ($status === 'pending') {
            $query->whereIn('status', ['pending_supervisor', 'pending_admin']);
        } else {
            $query->where('status', $status);
        }

        $leaveRequests = $query->paginate(10); // Adjust the number of items per page as needed.

        return view('leave_requests.index', compact('leaveRequests'));
    }

    public function filterByMonth(Request $request, $month)
    {
        $leaveRequests = LeaveRequest::whereMonth('start_date', $month)
            ->paginate(10);

        return view('leave_requests.index', [
            'leaveRequests' => $leaveRequests,
        ]);
    }


    public function showUserLeaveRequests(User $user, Request $request)
{
    $leaveRequests = $user->leaveRequests;

    // Get the selected leave type from the request, default to 'all'
    $filterLeaveType = $request->input('leaveTypeFilter', 'all');

    $filteredLeaveRequests = LeaveRequest::where('user_id', $user->id)
        ->filterByLeaveType($filterLeaveType)
        ->get();

    return view('users.records', compact('user', 'leaveRequests', 'filterLeaveType', 'filteredLeaveRequests'));
}
}
