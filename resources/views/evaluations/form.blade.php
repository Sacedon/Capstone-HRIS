<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Evaluations') }}
        </h2>
    </x-slot>

    <div class="container">
        <h2>Submit an Evaluation</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('evaluations.submit') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="user_id">Select User to Evaluate:</label>
                <select name="user_id" id="user_id" class="form-control">
                    @foreach($users as $user)
                    <option value="{{ $user->id }}">
                        {{ $user->first_name }} {{ $user->middle_name }} {{ $user->surname }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="criteria">Criteria:</label>
                <input type="text" name="criteria" id="criteria" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="comments">Comments:</label>
                <textarea name="comments" id="comments" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <label for="rating">Rating:</label>
                <input type="number" name="rating" id="rating" class="form-control" required min="1" max="5">
            </div>
            <button type="submit" class="btn btn-primary">Submit Evaluation</button>
        </form>
    </div>
</x-app-layout>
