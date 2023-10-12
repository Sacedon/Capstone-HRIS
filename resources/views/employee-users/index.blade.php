<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('All Department Users') }}
        </h2>
    </x-slot>

    @if(session('success'))
    <!-- Success Message -->
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

    @if(session('error'))
    <!-- Error Message -->
    <div id="errorMessage" class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded relative" role="alert">
        <strong class="font-bold">Access Denied:</strong>
        <span class="block sm:inline">{{ session('error') }}</span>
        <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
            <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <title>Close</title>
                <path d="M6.293 6.293a1 1 0 011.414 0L10 10.586l2.293-2.293a1 1 0 111.414 1.414L11.414 12l2.293 2.293a1 1 0 01-1.414 1.414L10 13.414l-2.293 2.293a1 1 0 01-1.414-1.414L8.586 12 6.293 9.707a1 1 0 010-1.414z"></path>
            </svg>
        </span>
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


    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h1 class="text-2xl font-semibold mb-4">List of Department Employees</h1>

                <!-- Department Selection Dropdown -->
                @if (auth()->user()->role === 'admin')
                <form action="{{ route('employee-users.index') }}" method="GET" class="mb-4">
                    <div class="flex items-center space-x-4">
                        <label for="department_id" class="text-sm font-medium text-gray-700">Select Department:</label>
                        <div class="relative">
                            <select name="department_id" id="department_id" class="w-48 border rounded px-3 py-2">
                                <option value="">All Departments</option>
                                @foreach ($departments as $dept)
                                    <option value="{{ $dept->id }}" @if($selectedDepartment && $selectedDepartment->id == $dept->id) selected @endif>{{ $dept->name }}</option>
                                @endforeach
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M13.293 7.293a1 1 0 011.414 0l3 3a1 1 0 01-1.414 1.414l-3-3a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                    <path fill-rule="evenodd" d="M3.293 9.293a1 1 0 011.414 0l3 3a1 1 0 01-1.414 1.414l-3-3a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                        </div>
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover-bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">Filter</button>
                    </div>
                </form>
                @endif

                @if ($users->isEmpty())
                    <p class="text-gray-500">No users found in the department.</p>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Department</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($users as $user)
                                    @if ($user->role != 'admin' && $user->role != 'supervisor')
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $user->first_name }} {{ $user->last_name }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $user->department->name }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <form method="POST" action="{{ route('user.delete', $user->id) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
