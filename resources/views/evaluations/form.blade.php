<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Evaluate Employee') }}
        </h2>
    </x-slot>

    <div class="container mx-auto p-6 bg-white rounded-lg shadow-lg">
        <h2 class="text-2xl font-semibold mb-4">Evaluation Form for {{ $user->first_name }} {{ $user->last_name }}</h2>

        @if(session('success'))
            <div class="bg-green-200 text-green-800 border-l-4 border-green-500 p-3 mb-4">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="bg-green-200 text-green-800 border-l-4 border-green-500 p-3 mb-4">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('evaluations.submit') }}" method="POST">
            @csrf
            <input type="hidden" name="user_id" value="{{ $user->id }}">
            <div class="mb-4">
                <label for="criteria" class="block text-gray-700 font-semibold">Criteria:</label>
                <input type="text" name="criteria" id="criteria" class="form-input mt-1 block w-full rounded-md border-gray-300" required>
            </div>
            <div class="mb-4">
                <label for="comments" class="block text-gray-700 font-semibold">Comments:</label>
                <textarea name="comments" id="comments" class="form-textarea mt-1 block w-full rounded-md border-gray-300"></textarea>
            </div>
            <div class="mb-4">
                <label for="rating" class="block text-gray-700 font-semibold">Rating:</label>
                <input type="number" name="rating" id="rating" class="form-input mt-1 block w-full rounded-md border-gray-300" required min="1" max="5">
            </div>
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-md">Submit Evaluation</button>
        </form>
    </div>
</x-app-layout>
