<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Leaves') }}
        </h2>
    </x-slot>

    <div class="container mx-auto py-6">
        <h2 class="text-3xl font-semibold text-gray-800 mb-6">Leave Requests</h2>

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="overflow-x-auto">
                    <table class="min-w-full table-auto">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 bg-indigo-500 text-left text-xs leading-4 font-medium text-white uppercase tracking-wider">ID</th>
                                <th class="px-6 py-3 bg-indigo-500 text-left text-xs leading-4 font-medium text-white uppercase tracking-wider">Start Date</th>
                                <th class="px-6 py-3 bg-indigo-500 text-left text-xs leading-4 font-medium text-white uppercase tracking-wider">End Date</th>
                                <th class="px-6 py-3 bg-indigo-500 text-left text-xs leading-4 font-medium text-white uppercase tracking-wider">Reason</th>
                                <th class="px-6 py-3 bg-indigo-500 text-left text-xs leading-4 font-medium text-white uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 bg-indigo-500 text-left text-xs leading-4 font-medium text-white uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($leaveRequests as $leaveRequest)
                                <tr>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">{{ $leaveRequest->id }}</td>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">{{ $leaveRequest->start_date }}</td>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">{{ $leaveRequest->end_date }}</td>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">{{ $leaveRequest->reason }}</td>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                        <span class="px-2 py-1 text-xs font-semibold leading-5 text-white bg-{{ $leaveRequest->status === 'pending' ? 'yellow' : 'green' }}-500 rounded-full">{{ $leaveRequest->status }}</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                        <a href="{{ route('leave-requests.show', $leaveRequest->id) }}" class="text-indigo-600 hover:text-indigo-900">View</a>
                                        <form method="POST" action="{{ route('leave-requests.destroy', $leaveRequest) }}" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900 ml-2">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
