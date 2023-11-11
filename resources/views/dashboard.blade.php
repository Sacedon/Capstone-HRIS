<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Dashboard') }}
            </h2>
        </div>
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

    <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-4">
        <!-- Total Users Card -->
        <div class="bg-white rounded-lg shadow-md dark:bg-dark-eval-1 p-4">
            <h3 class="text-lg font-semibold mb-2">Total Users</h3>
            <p class="text-3xl font-bold text-indigo-500">{{ $totalUsers }}</p>
        </div>

        <!-- Total Accepted Requests Card -->
        <div class="bg-white rounded-lg shadow-md dark:bg-dark-eval-1 p-4">
            <h3 class="text-lg font-semibold mb-2">Total Accepted Requests</h3>
            <p class="text-3xl font-bold text-green-500">{{ $totalAcceptedRequests }}</p>
        </div>

        <!-- Total Pending Requests Card -->
        <div class="bg-white rounded-lg shadow-md dark:bg-dark-eval-1 p-4">
            <h3 class="text-lg font-semibold mb-2">Total Pending Requests</h3>
            <p class="text-3xl font-bold text-yellow-500">{{ $totalPendingRequests }}</p>
        </div>

        <!-- Total Rejected Requests Card -->
        <div class="bg-white rounded-lg shadow-md dark:bg-dark-eval-1 p-4">
            <h3 class="text-lg font-semibold mb-2">Total Rejected Requests</h3>
            <p class="text-3xl font-bold text-red-500">{{ $totalRejectedRequests }}</p>
        </div>

        @if($departments->isNotEmpty())
        @foreach($departments as $department)
            <div class="bg-white rounded-lg shadow-md dark:bg-dark-eval-1 p-4">
                <h3 class="text-lg font-semibold mb-2">{{ $department->name }}</h3>
                <p class="text-3xl font-bold">{{ $department->users_count }}</p>
            </div>
        @endforeach
        @else
          <p>No departments found.</p>
        @endif
    </div>
</x-app-layout>
