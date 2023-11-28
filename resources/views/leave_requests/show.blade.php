<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Leave Request Details') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto bg-white shadow-md rounded-lg overflow-hidden">
            <div class="px-6 py-4">
                <h2 class="text-2xl font-semibold mb-4">Leave Request Details</h2>

                <!-- Leave Request Details -->
                <dl>
                    <div class="mb-2">
                        <dt class="text-gray-600">Start Date:</dt>
                        <dd>{{ $leaveRequest->start_date }}</dd>
                    </div>
                    <div class="mb-2">
                        <dt class="text-gray-600">End Date:</dt>
                        <dd>{{ $leaveRequest->end_date }}</dd>
                    </div>
                    <div class="mb-2">
                        <dt class="text-gray-600">Number of Days:</dt>
                        <dd>{{ $leaveRequest->number_of_days }}</dd>
                    </div>
                    <div class="mb-2">
                        <dt class="text-gray-600">Leave Type:</dt>
                        <dd>{{ $leaveRequest->leave_type }}</dd>
                    </div>
                    <div class="mb-2">
                        <dt class="text-gray-600">Reason:</dt>
                        @if ($leaveRequest->leave_type === 'sick')
                            <dd>{{ $leaveRequest->reason }}</dd>
                        @elseif ($leaveRequest->leave_type === 'educational')
                            <dd>{{ $leaveRequest->educational_reason }}</dd>
                        @else
                            <dd>{{ $leaveRequest->other_reason }}</dd>
                        @endif

                        @if ($leaveRequest->leave_type === 'sick' && !empty($leaveRequest->other_reason))
                            <dt class="text-gray-600">Explanation of your Leave:</dt>
                            <dd>{{ $leaveRequest->other_reason }}</dd>
                        @endif

                        @if ($leaveRequest->leave_type === 'educational' && !empty($leaveRequest->other_reason))
                            <dt class="text-gray-600">Explanation of your Leave:</dt>
                            <dd>{{ $leaveRequest->other_reason }}</dd>
                        @endif
                    </div>
                    <div class="mb-2">
                        <dt class="text-gray-600">Status:</dt>
                        <dd>{{ $leaveRequest->status }}</dd>
                    </div>
                </dl>

                @if ($leaveRequest->status === 'rejected' && $leaveRequest->rejection_reason)
                   <div class="mt-4">
                   <strong>Rejected Reason:</strong>
                   <p>{{ $leaveRequest->rejection_reason }}</p>
                   </div>
                @endif

                <!-- Actions Buttons (if pending) -->
                @if ($leaveRequest->status === 'pending_supervisor' && auth()->user()->role === 'supervisor')
                    @if (auth()->user()->department_id === $leaveRequest->user->department_id)
                        <form method="POST" action="{{ route('leave-requests.accept', ['leaveRequest' => $leaveRequest->id]) }}" class="inline">
                            @csrf
                            <input type="hidden" name="approval_type" value="supervisor">
                            <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-full mt-4 mr-2">
                                Accept Leave Request
                            </button>
                        </form>

                        <button type="button" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-full mt-4" data-bs-toggle="modal" data-bs-target="#rejectionModal">
                            Reject Leave Request
                        </button>

                        <div class="modal fade" id="rejectionModal" tabindex="-1" aria-labelledby="rejectionModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="rejectionModalLabel">Provide Rejection Reason</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" action="{{ route('leave-requests.reject', $leaveRequest) }}">
                                            @csrf
                                            <input type="hidden" name="rejection_type" value="supervisor">
                                            <div class="mb-3">
                                                <label for="rejectionReason" class="form-label">Rejection Reason:</label>
                                                <textarea class="form-control" id="rejectionReason" name="rejected_reason" rows="3" placeholder="Enter rejection reason"></textarea>
                                            </div>
                                            <button type="submit" class="btn btn-danger">Reject Leave Request</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @elseif ($leaveRequest->status === 'recommend_for_approval' && auth()->user()->role === 'admin')
                    @if (auth()->user())
                        <form method="POST" action="{{ route('leave-requests.accept', $leaveRequest) }}" class="inline">
                            @csrf
                            <input type="hidden" name="approval_type" value="admin">
                            <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-full mt-4 mr-2">
                                Accept Leave Request
                            </button>
                        </form>

                        <button type="button" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-full mt-4" data-bs-toggle="modal" data-bs-target="#adminRejectionModal">
                            Reject Leave Request
                        </button>

                        <!-- Admin Rejection Reason Modal -->
        <div class="modal fade" id="adminRejectionModal" tabindex="-1" aria-labelledby="adminRejectionModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="adminRejectionModalLabel">Provide Rejection Reason</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('leave-requests.reject', ['leaveRequest' => $leaveRequest->id]) }}">
                            @csrf
                            <input type="hidden" name="rejection_type" value="admin">
                            <div class="mb-3">
                                <label for="adminRejectionReason" class="form-label">Rejection Reason:</label>
                                <textarea class="form-control" id="adminRejectionReason" name="rejected_reason" rows="3" placeholder="Enter rejection reason"></textarea>
                            </div>
                            <button type="submit" class="btn btn-danger">Reject Leave Request</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
                    @endif
                @endif

            </div>
        </div>

        <!-- Back Button -->
        <div class="mt-4 text-center">
            <a href="{{ route('leave-requests.index') }}" class="text-indigo-600 hover:underline">Back to Leave Requests</a>
        </div>
    </div>
</x-app-layout>
