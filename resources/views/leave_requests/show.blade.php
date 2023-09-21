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
                        <dt class="text-gray-600">Leave Type:</dt>
                        <dd>{{ $leaveRequest->leave_type }}</dd>
                    </div>
                    <div class="mb-2">
                        <dt class="text-gray-600">Reason:</dt>
                        @if ($leaveRequest->leave_type === 'sick')
                            <dd>{{ $leaveRequest->reason }}</dd>
                        @else
                            <dd>{{ $leaveRequest->other_reason }}</dd>
                        @endif

                        @if ($leaveRequest->leave_type === 'sick' && !empty($leaveRequest->other_reason))
                        <dt class="text-gray-600">Explanation of your Leave:</dt>
                        <dd>{{ $leaveRequest->other_reason }}</dd>
                        @endif
                    </div>
                    <div class="mb-2">
                        <dt class="text-gray-600">Status:</dt>
                        <dd>{{ $leaveRequest->status }}</dd>
                    </div>
                </dl>

                <!-- Actions Buttons (if pending) -->
                @if ($leaveRequest->status === 'pending')
                    <form method="POST" action="{{ route('leave-requests.accept', ['leaveRequest' => $leaveRequest->id]) }}" class="inline">
                        @csrf
                        <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-full mt-4 mr-2">
                            Accept Leave Request
                        </button>
                    </form>

                    <form method="POST" action="{{ route('leave-requests.reject', $leaveRequest) }}" class="inline">
                        @csrf
                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-full mt-4">
                            Reject Leave Request
                        </button>
                    </form>
                @endif
            </div>
        </div>

        <!-- Back Button -->
        <div class="mt-4 text-center">
            <a href="{{ route('leave-requests.index') }}" class="text-indigo-600 hover:underline">Back to Leave Requests</a>
        </div>
    </div>
</x-app-layout>
