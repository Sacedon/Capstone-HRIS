<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create User') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <form method="post" action="{{ route('users.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700">Name:</label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" required
                            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    </div>
                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-700">Email:</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required
                            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    </div>
                    <div class="mb-4">
                        <label for="password" class="block text-sm font-medium text-gray-700">Password:</label>
                        <input type="password" id="password" name="password" required
                            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    </div>
                    <div class="mb-4">
                        <label for="password_confirmation"
                            class="block text-sm font-medium text-gray-700">Confirm Password:</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" required
                            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    </div>
                    <div class="mb-4">
                        <label for="role" class="block text-sm font-medium text-gray-700">Role:</label>
                        <select id="role" name="role"
                            class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="user">User</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="address" class="block text-sm font-medium text-gray-700">Address:</label>
                        <input type="text" id="address" name="address" value="{{ old('address') }}"
                            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    </div>
                    <div class="mb-4">
                        <label for="gender" class="block text-sm font-medium text-gray-700">Gender:</label>
                        <select id="gender" name="gender"
                            class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="male">Male</option>
                            <option value="female">Female</option>

                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="date_of_birth" class="block text-sm font-medium text-gray-700">Date of Birth:</label>
                        <input type="date" id="date_of_birth" name="date_of_birth"
                            value="{{ old('date_of_birth') }}"
                            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    </div>
                    <div class="mb-4">
                        <label for="department" class="block text-sm font-medium text-gray-700">Department:</label>
                        <input type="text" id="department" name="department"
                            value="{{ old('department') }}"
                            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    </div>

                    <div class="mb-4">
                        <label for="profile_picture" class="block text-sm font-medium text-gray-700">Profile Picture:</label>
                        <input type="file" id="profile_picture" name="profile_picture"
                            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    </div>

                    <div class="flex items-center justify-end">
                        <button type="submit"
                            class="bg-indigo-500 text-white px-4 py-2 rounded-md hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Create User
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
