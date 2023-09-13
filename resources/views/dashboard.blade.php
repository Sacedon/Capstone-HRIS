<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Dashboard') }}
            </h2>
        </div>
    </x-slot>

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
