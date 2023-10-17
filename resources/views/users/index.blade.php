<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User Management') }}
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

@if(session('error'))
    <div id="errorMessage" class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4">
        <div class="flex">
            <div class="py-1">
                <svg class="w-6 h-6 mr-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>
            <div>
                {{ session('error') }}
            </div>
        </div>
    </div>
@endif


    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-2xl font-semibold text-gray-800">Users</h3>
                    <div class="space-x-4">
                        <a href="#" id="openCreateUserModal"
                        class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">Create User</a>

                        <a href="{{ route('user_report') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">Generate Report</a>
                    </div>
                </div>

                <div class="mb-4 flex items-center space-x-4">
                    <div class="relative">
                        <form action="{{ route('users.index') }}" method="GET" class="flex items-center">
                            @csrf

                            <div class="relative">
                                <input
                                    type="text"
                                    id="search"
                                    name="search"
                                    value="{{ request('search') }}"
                                    placeholder="Search users..."
                                    class="input-field"
                                >
                                <button
                                    type="submit"
                                    class="px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                                >
                                    Search
                                </button>
                            </div>
                        </form>

                    </div>

                    @if (auth()->user()->role === 'admin')
                        <form action="{{ route('users.index') }}" method="GET" class="flex items-center">
                            @csrf
                            <div class="relative">
                                <select
                                    name="department_id"
                                    id="department_id"
                                    class="dropdown"
                                >
                                    <option value="">All Departments</option>
                                    @foreach ($departments as $dept)
                                        <option value="{{ $dept->id }}" @if($selectedDepartment && $selectedDepartment->id == $dept->id) selected @endif>{{ $dept->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 ml-3">Filter</button>
                        </form>
                    @endif
                </div>



                <div class="overflow-x-auto mt-6">
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
                                    Role
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Department
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
                                        {{ $user->role }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if ($user->department)
                                            {{ $user->department->name }}
                                        @else
                                            No Department
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex space-x-2">
                                            <a href="{{ route('users.edit', $user) }}"
                                                class="text-indigo-600 hover:text-indigo-900">Edit</a>

                                                <button type="button" class="text-red-600 hover:text-red-900 open-delete-modal" data-user-id="{{ $user->id }}">Delete</button>

                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="mt-4">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Create User Modal -->
<div id="createUserModal" class="fixed inset-0 z-50 hidden overflow-auto bg-gray-800 bg-opacity-50">
    <div class="relative w-full max-w-md p-4 mx-auto mt-10">
        <div class="bg-white rounded-lg shadow-lg">
            <!-- Modal Header -->
            <div class="px-4 py-2 bg-gray-200 rounded-t-lg">
                <h2 class="text-xl font-semibold text-gray-800">Create User</h2>
            </div>
            <!-- Modal Body -->
            <div class="p-4">
                <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <!-- Add your form fields here -->
                    <div class="mb-4">
                        <label for="username" class="block text-sm font-medium text-gray-700">Username:</label>
                        <input type="text" id="username" name="username" value="{{ old('username') }}" required
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                    <div class="mb-4">
                        <label for="first_name" class="block text-sm font-medium text-gray-700">First Name:</label>
                        <input type="text" id="first_name" name="first_name" value="{{ old('first_name') }}" required
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                    <div class="mb-4">
                        <label for="surname" class="block text-sm font-medium text-gray-700">Surname:</label>
                        <input type="text" id="surname" name="surname" value="{{ old('surname') }}" required
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                    <div class="mb-4">
                        <label for="middle_name" class="block text-sm font-medium text-gray-700">Middle Name:</label>
                        <input type="text" id="middle_name" name="middle_name" value="{{ old('middle_name') }}"
                            required
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                    <div class="mb-4">
                        <label for="password" class="block text-sm font-medium text-gray-700">Password:</label>
                        <input type="password" id="password" name="password" required
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                    <div class="mb-4">
                        <label for="password_confirmation"
                            class="block text-sm font-medium text-gray-700">Confirm Password:</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" required
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                    <div class="mb-4">
                        <label for="role" class="block text-sm font-medium text-gray-700">Role:</label>
                        <select id="role" name="role"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="employee">Employee</option>
                            <option value="admin">Admin</option>
                            <option value="supervisor">Supervisor</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="department" class="block text-sm font-medium text-gray-700">Department:</label>
                        <select id="department" name="department"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="">Select Department</option> <!-- Add a default option -->
                            @foreach ($departments as $department)
                            <option value="{{ $department->name }}" {{ optional($user->department)->name === $department->name ? 'selected' : '' }}>
                                {{ $department->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="profile_picture" class="block text-sm font-medium text-gray-700">Profile Picture:</label>
                        <input type="file" id="profile_picture" name="profile_picture"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                    <div class="flex justify-end mt-4">
                        <button type="button" id="closeCreateUserModal"
                            class="px-4 py-2 text-gray-600 bg-gray-200 rounded-md hover:bg-gray-300 focus:outline-none mr-3">
                            Cancel
                        </button>
                        <button type="submit"
                            class="px-4 py-2 text-white bg-green-500 rounded-md hover:bg-green-600 focus:outline-none">
                            Create
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const createUserModal = document.getElementById('createUserModal');
        const openCreateUserModalButton = document.querySelector('#openCreateUserModal');
        const closeCreateUserModalButton = document.getElementById('closeCreateUserModal');

        openCreateUserModalButton.addEventListener('click', function () {
            createUserModal.classList.remove('hidden');
        });

        closeCreateUserModalButton.addEventListener('click', function () {
            createUserModal.classList.add('hidden');
        });
    });
</script>


   <!-- Delete User Confirmation Modal -->
<div id="deleteUserModal" class="fixed z-10 inset-0 overflow-y-auto hidden">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity" aria-hidden="true"></div>
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
                <form method="POST" id="deleteUserForm" action="" class="sm:inline">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" id="deleteUserId" name="user_id" value="">
                    <button
                        type="submit"
                        class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm"
                    >
                        Delete
                    </button>
                </form>
                <button type="button" x-on:click="closeModal" id="closeModalButton" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:w-auto sm:text-sm">
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
        const openModalButtons = document.querySelectorAll('.open-delete-modal');
        const deleteUserId = document.getElementById('deleteUserId');
        const deleteUserForm = document.getElementById('deleteUserForm');

        openModalButtons.forEach((button) => {
            button.addEventListener('click', (event) => {
                const userId = event.target.getAttribute('data-user-id');
                deleteUserId.value = userId;
                deleteUserForm.action = `{{ route('users.destroy', '') }}/${userId}`;
                deleteUserModal.classList.remove('hidden');
            });
        });

        const closeModalButton = document.getElementById('closeModalButton');
        closeModalButton.addEventListener('click', () => {
            deleteUserModal.classList.add('hidden');
        });

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
    });
</script>
