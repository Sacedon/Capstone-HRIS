<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Employee List') }}
        </h2>
    </x-slot>

    <div class="container mx-auto p-6 bg-white rounded-lg shadow-lg">
        <h2 class="text-2xl font-semibold mb-4">Select a User for Evaluation</h2>

        @if(session('success'))
            <div class="bg-green-200 text-green-800 border-l-4 border-green-500 p-3 mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-200 text-red-800 border-l-4 border-red-500 p-3 mb-4">
                {{ session('error') }}
            </div>
        @endif

        <ul class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach($users as $user)
                <li>
                    <div class="bg-white border rounded-lg overflow-hidden shadow-md">
                        <div class="p-4">
                            <h3 class="text-lg font-semibold">{{ $user->first_name }} {{ $user->last_name }}</h3>
                            <p class="text-gray-600">{{ $user->email }}</p>
                        </div>
                        <div class="px-4 pb-4">
                            @if (!$user->hasEvaluated(auth()->user()))
                                @if (!$user->hasEvaluated(auth()->user()))
                                    <a href="{{ route('evaluations.form', ['user_id' => $user->id]) }}" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-md">Evaluate</a>
                                @else
                                    <span class="text-gray-500">Already Evaluated</span>
                                @endif
                            @else
                                <span class="text-gray-500">Already Evaluated</span>
                            @endif
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</x-app-layout>
