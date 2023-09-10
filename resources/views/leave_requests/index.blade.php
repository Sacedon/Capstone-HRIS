<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Leaves') }}
        </h2>
    </x-slot>

    <div class="container mx-auto py-6">
        <h2 class="text-3xl font-semibold text-gray-800 mb-6">Leave Requests</h2>

        <div class="mb-4 relative">
            <select id="filterDropdown" class="block appearance-none bg-white border border-gray-300 hover:border-gray-400 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                <option value="{{ route('leave-requests.index') }}">Select Status</option>
                <option value="{{ route('leave-requests.index') }}">All Requests</option>
                <option value="{{ route('leave-requests.filtered', 'accepted') }}">Accepted</option>
                <option value="{{ route('leave-requests.filtered', 'rejected') }}">Rejected</option>
                <option value="{{ route('leave-requests.filtered', 'pending') }}">Pending</option>
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.293a1 1 0 011.414 0L12 13.586l1.293-1.293a1 1 0 111.414 1.414l-2 2a1 1 0 01-1.414 0l-2-2a1 1 0 010-1.414 1 1 0 011.414 0z"/></svg>
            </div>
        </div>

        <script>
            document.getElementById('filterDropdown').addEventListener('change', function() {
                var selectedOption = this.value;
                window.location = selectedOption;
            });
        </script>


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
