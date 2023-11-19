<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Leaves') }}
        </h2>
    </x-slot>

    @if(session('success'))
    <div id="successMessage" class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4">
        <div class="flex">
            <div class="py-1">
                <svg class="w-6 h-6 mr-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>
            <div>
                {{ session('success') }}
            </div>
        </div>
    </div>
@endif

<script>
    function hideMessages() {
    const successMessage = document.getElementById('successMessage');
    const errorMessage = document.getElementById('errorMessage');

    if (successMessage) {
        setTimeout(function() {
            successMessage.style.display = 'none';
        }, 3000); // 3 seconds
    }

    if (errorMessage) {
        setTimeout(function() {
            errorMessage.style.display = 'none';
        }, 3000); // 3 seconds
    }
}

// Call the hideMessages function when the page loads
window.addEventListener('load', hideMessages);
</script>

    <div class="container mx-auto py-6">
        <h2 class="text-3xl font-semibold text-gray-800 mb-6">Leave Requests</h2>

        <div class="mb-4 relative">
            <select id="filterDropdown" class="block appearance-none bg-white border border-gray-300 hover:border-gray-400 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                <option disabled selected value="">Select Status</option>
                <option value="{{ route('leave-requests.index') }}">All Requests</option>
                <option value="{{ route('leave-requests.filtered', 'approved') }}">Approved</option>
                <option value="{{ route('leave-requests.filtered', 'rejected') }}">Rejected</option>
                <option value="{{ route('leave-requests.filtered', 'pending') }}">Pending</option>
                <option value="{{ route('leave-requests.filtered', 'ended') }}">Ended</option>
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.293a1 1 0 011.414 0L12 13.586l1.293-1.293a1 1 0 111.414 1.414l-2 2a1 1 0 01-1.414 0l-2-2a1 1 0 010-1.414 1 1 0 011.414 0z"/></svg>
            </div>
        </div>

        <div class="mb-4 relative">
            <select id="filterMonthDropdown" class="block appearance-none bg-white border border-gray-300 hover:border-gray-400 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                <option disabled selected value="">Select Month</option>
                <option value="{{ route('leave-requests.index') }}">All Requests</option>
                <option value="{{ route('leave-requests.filter-by-month', ['month' => '01']) }}">January</option>
                <option value="{{ route('leave-requests.filter-by-month', ['month' => '02']) }}">February</option>
                <option value="{{ route('leave-requests.filter-by-month', ['month' => '03']) }}">March</option>
                <option value="{{ route('leave-requests.filter-by-month', ['month' => '04']) }}">April</option>
                <option value="{{ route('leave-requests.filter-by-month', ['month' => '05']) }}">May</option>
                <option value="{{ route('leave-requests.filter-by-month', ['month' => '06']) }}">June</option>
                <option value="{{ route('leave-requests.filter-by-month', ['month' => '07']) }}">July</option>
                <option value="{{ route('leave-requests.filter-by-month', ['month' => '08']) }}">August</option>
                <option value="{{ route('leave-requests.filter-by-month', ['month' => '09']) }}">September</option>
                <option value="{{ route('leave-requests.filter-by-month', ['month' => '10']) }}">October</option>
                <option value="{{ route('leave-requests.filter-by-month', ['month' => '11']) }}">November</option>
                <option value="{{ route('leave-requests.filter-by-month', ['month' => '12']) }}">December</option>
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.293a1 1 0 011.414 0L12 13.586l1.293-1.293a1 1 0 111.414 1.414l-2 2a1 1 0 01-1.414 0l-2-2a1 1 0 010-1.414 1 1 0 011.414 0z"/></svg>
            </div>
        </div>


        <script>
            document.getElementById('filterDropdown').addEventListener('change', function() {
                var selectedOption = this.value;
                if (selectedOption === "{{ route('leave-requests.filtered', 'pending_supervisor') }}" || selectedOption === "{{ route('leave-requests.filtered', 'pending_admin') }}") {
                    window.location = "{{ route('leave-requests.filtered', 'pending') }}";
                } else {
                    window.location = selectedOption;
                }
            });

            document.getElementById('filterMonthDropdown').addEventListener('change', function() {
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
                                <th class="px-6 py-3 bg-indigo-500 text-left text-xs leading-4 font-medium text-white uppercase tracking-wider">Name</th>
                                <th class="px-6 py-3 bg-indigo-500 text-left text-xs leading-4 font-medium text-white uppercase tracking-wider">Start Date</th>
                                <th class="px-6 py-3 bg-indigo-500 text-left text-xs leading-4 font-medium text-white uppercase tracking-wider">End Date</th>
                                <th class="px-6 py-3 bg-indigo-500 text-left text-xs leading-4 font-medium text-white uppercase tracking-wider">Leave Type</th>
                                <th class="px-6 py-3 bg-indigo-500 text-left text-xs leading-4 font-medium text-white uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 bg-indigo-500 text-left text-xs leading-4 font-medium text-white uppercase tracking-wider">Department</th>
                                <th class="px-6 py-3 bg-indigo-500 text-left text-xs leading-4 font-medium text-white uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($leaveRequests as $leaveRequest)
                                <tr>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">{{ $leaveRequest->id }}</td>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">{{ $leaveRequest->user->first_name }} {{ $leaveRequest->user->surname }}</td>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">{{ $leaveRequest->start_date }}</td>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">{{ $leaveRequest->end_date }}</td>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">{{ $leaveRequest->leave_type }}</td>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                        <span class="px-2 py-1 text-xs font-semibold leading-5 text-white
                                            @if ($leaveRequest->status === 'pending')
                                                bg-yellow-500
                                            @elseif ($leaveRequest->status === 'rejected')
                                                bg-red-500 text-white
                                            @else
                                                bg-green-500
                                            @endif
                                            rounded-full">
                                            {{ $leaveRequest->status }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                        @if ($leaveRequest->user && $leaveRequest->user->department)
                                            {{ $leaveRequest->user->department->name }}
                                        @else
                                            Department not found
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                        <a href="{{ route('leave-requests.show', $leaveRequest->id) }}" class="text-indigo-600 hover:text-indigo-900">View</a>
                                        @if (auth()->user()->role === 'admin')
    <form method="POST" action="{{ route('leave-requests.destroy', $leaveRequest) }}" class="inline">
        @csrf
        @method('DELETE')
        <button type="submit" class="text-red-600 hover:text-red-900 ml-2">Delete</button>
    </form>
@endif


                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-4">
                        {{ $leaveRequests->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
