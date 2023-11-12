<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Records') }}
        </h2>
    </x-slot>

    <div class="container mx-auto mt-6">
        <div class="bg-white shadow-md rounded-lg p-8">
            <div class="flex items-center space-x-4 mb-6">
                <div class="flex-shrink-0">
                    <!-- Display profile picture or default image -->
                    <img src="{{ $user->profile_picture ? Storage::url($user->profile_picture) : asset('images/default-profile.jpeg') }}"
                        alt="{{ $user->first_name }} Profile Picture"
                        class="w-20 h-20 rounded-full object-cover border-2 border-gray-200">
                </div>
                <div>
                    <h2 class="text-4xl font-semibold">{{ $user->first_name }}</h2>
                    <p class="text-gray-600">{{ $user->email }}</p>
                </div>
            </div>

            <!-- Back Button -->
            <a href="{{ url()->previous() }}" class="text-indigo-600 hover:underline mb-4 inline-block">
                &larr; Back
            </a>

            @if($leaveRequests && $leaveRequests->count() > 0)
                <div class="bg-gray-100 p-6 rounded-md mb-6">
                    <h3 class="text-2xl font-semibold mb-4">{{ __('Leave Requests Records') }}</h3>

                    {{-- Count occurrences of each leave type --}}
                    @php
                        $leaveTypeData = $leaveRequests->groupBy('leave_type')->map(function ($requests, $leaveType) {
                            return [
                                'count' => $requests->count(),
                            ];
                        });
                    @endphp

                    @if($leaveTypeData->count() > 0)
                        <div class="mb-4">
                            <h4 class="text-xl font-semibold">{{ __('Leave Type Counts') }}</h4>
                            <table class="mt-4 w-full border border-gray-300 rounded-lg overflow-hidden">
                                <thead>
                                    <tr class="bg-gray-200">
                                        <th class="py-2 px-4 border-b border-r">{{ __('Leave Type') }}</th>
                                        <th class="py-2 px-4 border-b border-r">{{ __('Count') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($leaveTypeData as $leaveType => $data)
                                        <tr class="{{ $loop->even ? 'bg-gray-100' : 'bg-gray-50' }} hover:bg-gray-200">
                                            <td class="py-2 px-4 border-b border-r">{{ $leaveType }}</td>
                                            <td class="py-2 px-4 border-b border-r">{{ $data['count'] }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <p class="mt-4">{{ __('Total Number of Leave Requests') }}: {{ $leaveRequests->count() }}</p>
                        </div>
                    @else
                        <p class="text-gray-500">{{ __('No leave requests found for this user.') }}</p>
                    @endif

                    <hr class="my-6">

                    {{-- Leave Requests Records --}}
                    <h4 class="text-xl font-semibold mb-4">{{ __('Leave Requests List') }}</h4>
                    <table class="w-full border border-gray-300 rounded-lg overflow-hidden">
                        <thead>
                            <tr class="bg-gray-200">
                                <th class="py-2 px-4 border-b border-r">{{ __('Leave Type') }}</th>
                                <th class="py-2 px-4 border-b border-r">{{ __('Start Date') }}</th>
                                <th class="py-2 px-4 border-b border-r">{{ __('End Date') }}</th>
                                <th class="py-2 px-4 border-b border-r">{{ __('Reason') }}</th> {{-- Added this line --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($leaveRequests as $leaveRequest)
                                <tr class="{{ $loop->even ? 'bg-gray-100' : 'bg-gray-50' }} hover:bg-gray-200">
                                    <td class="py-2 px-4 border-b border-r">{{ $leaveRequest->leave_type }}</td>
                                    <td class="py-2 px-4 border-b border-r">{{ $leaveRequest->start_date }}</td>
                                    <td class="py-2 px-4 border-b border-r">{{ $leaveRequest->end_date }}</td>
                                    <td class="py-2 px-4 border-b border-r">
                                        @if($leaveRequest->leave_type === 'sick')
                                            @if(is_array($leaveRequest->reason))
                                                {{ implode(', ', $leaveRequest->reason) }}
                                            @else
                                                {{ $leaveRequest->reason }}
                                            @endif
                                        @else
                                            {{ $leaveRequest->other_reason }}
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

               {{-- Sickness Counts Table --}}
@if($leaveRequests->contains('leave_type', 'sick'))
<div class="bg-gray-100 p-6 rounded-md mb-6">
    <h4 class="text-xl font-semibold mb-4">{{ __('Sickness Counts') }}</h4>
    <table class="w-full border border-gray-300 rounded-lg">
        <thead>
            <tr class="bg-gray-200">
                <th class="py-2 px-4 border-b border-r">{{ __('Sickness') }}</th>
                <th class="py-2 px-4 border-b border-r">{{ __('Count') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach(['Diarrhea', 'Flu', 'Headache', 'Cough'] as $sickness)
                <tr class="{{ $loop->even ? 'bg-gray-100' : 'bg-gray-50' }} hover:bg-gray-200">
                    <td class="py-2 px-4 border-b border-r">{{ $sickness }}</td>
                    <td class="py-2 px-4 border-b border-r">
                        @php
                            $sicknessCount = $leaveRequests->filter(function ($request) use ($sickness) {
                                return $request->leave_type === 'sick' && stripos($request->reason, $sickness) !== false;
                            })->count();
                        @endphp
                        {{ $sicknessCount }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endif

            @else
                <p class="text-gray-500">{{ __('No leave requests found for this user.') }}</p>
            @endif
        </div>
    </div>
</x-app-layout>
