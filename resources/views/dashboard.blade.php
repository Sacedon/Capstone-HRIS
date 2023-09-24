<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Dashboard') }}
            </h2>
        </div>
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
    </div>


</x-app-layout>
