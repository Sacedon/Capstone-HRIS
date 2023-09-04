<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User Details') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <div>
                        @if ($user->profile_picture)
                            <div class="mb-4">
                                <img src="{{ Storage::url($user->profile_picture) }}" alt="{{ $user->name }} Profile Picture"
                                    class="w-32 h-32 object-cover rounded-full">
                            </div>
                        @else
                            <div class="text-gray-400 mb-4">No Profile Picture</div>
                        @endif
                        <div class="text-gray-600">Surname</div>
                        <div class="text-lg font-semibold">{{ $user->surname }}</div>
                    </div>
                    <div>
                        <div class="text-gray-600">Middle Name</div>
                        <div class="text-lg font-semibold">{{ $user->middle_name }}</div>
                    </div>
                    <div>
                        <div class="text-gray-600">First Name</div>
                        <div class="text-lg font-semibold">{{ $user->first_name }}</div>
                    </div>
                    <div>
                        <div class="text-gray-600">Email</div>
                        <div class="text-lg font-semibold">{{ $user->email }}</div>
                    </div>
                    <div>
                        <div class="text-gray-600">Role</div>
                        <div class="text-lg font-semibold">{{ $user->role }}</div>
                    </div>
                    <div>
                        <div class="text-gray-600">Address</div>
                        <div class="text-lg font-semibold">{{ $user->address }}</div>
                    </div>
                    <div>
                        <div class="text-gray-600">Gender</div>
                        <div class="text-lg font-semibold">{{ $user->gender }}</div>
                    </div>
                    <div>
                        <div class="text-gray-600">Date of Birth</div>
                        <div class="text-lg font-semibold">{{ $user->date_of_birth }}</div>
                    </div>
                    <div>
                        <div class="text-gray-600">Department</div>
                        <div class="text-lg font-semibold">{{ $user->department }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
