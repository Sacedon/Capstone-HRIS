<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User Management') }}
        </h2>
    </x-slot>


    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-2xl font-semibold text-gray-800">Users</h3>
                    <div class="space-x-4">
                        <a href="{{ route('users.create') }}"  class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">Create User</a>
                        <a href="{{ route('user_report') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">Generate Report</a>
                    </div>
                </div>

                <div class="mb-4">
                    <form action="{{ route('users.index') }}" method="GET" class="flex items-center">
                        @csrf

                        <div class="relative">
                            <input type="text" id="search" name="search" value="{{ request('search') }}" placeholder="Search users..." class="px-3 py-2 border rounded w-full">
                            <button type="submit" class="absolute inset-y-0 right-0 px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Search
                            </button>
                        </div>
                    </form>
                </div>
                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Profile Pic
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Full Name
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Email
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Role
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($users as $user)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if ($user->profile_picture)
                                            <a href="{{ route('users.show', $user) }}">
                                                <img src="{{ Storage::url($user->profile_picture) }}"
                                                    alt="{{ $user->name }} Profile Picture"
                                                    class="w-12 h-12 rounded-full object-cover">
                                            </a>
                                        @else
                                            <span class="text-gray-400">No Picture</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $user->surname }}, {{ $user->middle_name }} {{ $user->first_name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $user->email }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $user->role }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex space-x-2">
                                            <a href="{{ route('users.edit', $user) }}"
                                                class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                            <form method="post" action="{{ route('users.destroy', $user) }}"
                                                class="inline">
                                                @csrf
                                                @method('delete')
                                                <button type="button"
                                                    class="text-red-600 hover:text-red-900 open-delete-modal">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete User Confirmation Modal -->
    <div id="deleteUserModal" class="fixed z-10 inset-0 overflow-y-auto hidden">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">

            </div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                <div class="bg-gray-200 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-headline">
                                Confirm Deletion
                            </h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500">
                                    Are you sure you want to delete this user?
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-200 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <form method="POST" action="{{ route('users.destroy', $user) }}" class="sm:inline">
                        @csrf
                        @method('delete')
                        <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                            Delete
                        </button>
                    </form>
                    <button type="button" x-on:click="closeModal" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:w-auto sm:text-sm">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>

<!-- JavaScript for handling the modal -->
<script>
    window.addEventListener('DOMContentLoaded', () => {
        const deleteUserModal = document.getElementById('deleteUserModal');
        const openDeleteModalButtons = document.querySelectorAll('.open-delete-modal');

        openDeleteModalButtons.forEach(button => {
            button.addEventListener('click', () => {
                deleteUserModal.classList.remove('hidden');
            });
        });

        const closeModalButton = document.querySelector('[x-on\\:click="closeModal"]');

        closeModalButton.addEventListener('click', () => {
            deleteUserModal.classList.add('hidden');
        });
    });
</script>
