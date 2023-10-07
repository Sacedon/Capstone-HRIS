<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Login and Logout Details') }}
        </h2>
    </x-slot>

    <div class="container mx-auto px-4 py-6">
        <h1 class="text-2xl font-semibold mb-4">Login and Logout Records</h1>

        <!-- Date filter form -->
        <form method="GET" class="mb-4 grid grid-cols-2 gap-4">
            <div class="flex items-center">
                <label for="date" class="text-gray-700 text-sm font-bold mr-2">Filter by Date:</label>
                <input type="date" name="date" id="date" class="form-input rounded-md shadow-sm">
                <button type="submit" class="ml-2 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-700">Search</button>
            </div>

            <div class="flex items-center">
                <label for="first_name" class="text-gray-700 text-sm font-bold mr-2">Search Employee:</label>
                <input type="text" name="first_name" id="first_name" class="form-input rounded-md shadow-sm">
                <button type="submit" class="ml-2 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-700">Search</button>
            </div>
        </form>

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Employee
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Login Time
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Logout Time
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($logs as $log)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $log->user->first_name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $log->login_time ? $log->login_time->setTimezone('Asia/Manila')->format('Y-m-d H:i:s') : 'N/A' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $log->logout_time ? $log->logout_time->setTimezone('Asia/Manila')->format('Y-m-d H:i:s') : 'N/A' }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-6 py-4 text-center text-gray-500">No login/logout records found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-4">
                    {{ $logs->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
