<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Request Leave') }}
        </h2>
    </x-slot>

    <div class="container mx-auto mt-6">
        <!-- Card Container -->
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-2xl font-semibold mb-4">Create Leave Request</h2>

            <form method="POST" action="{{ route('leave-requests.store') }}">
                @csrf

                <div class="mb-4">
                    <label for="leave_type" class="block text-sm font-medium text-gray-700">Leave Type:</label>
                    <select name="leave_type" id="leave_type" required
                            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        <option value="vacation">Vacation</option>
                        <option value="sick">Sick</option>
                        <option value="personal">Personal</option>
                    </select>
                </div>

                <div class="mb-4" id="reason-container" style="display: none;">
                    <!-- Initially hidden, will be shown only when "Sick" is selected -->
                    <label for="reason" class="block text-sm font-medium text-gray-700">Specific Type of Sick:</label>
                    <select name="reason" id="reason"
                            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        <!-- Options for "Sick" leave type reasons -->
                        <option value="Flu">Flu</option>
                        <option value="Cough">Cough</option>
                        <option value="Diarrhea">Diarrhea</option>
                        <option value="Headache">Headache</option>
                    </select>
                </div>

                <script>
                    document.addEventListener("DOMContentLoaded", function () {
                        // Get the leave type dropdown element and reason container
                        const leaveTypeDropdown = document.getElementById("leave_type");
                        const reasonContainer = document.getElementById("reason-container");

                        // Event listener for leave type dropdown change
                        leaveTypeDropdown.addEventListener("change", function () {
                            const selectedLeaveType = this.value;

                            // Toggle visibility of reason container based on the selected leave type
                            if (selectedLeaveType === "sick") {
                                reasonContainer.style.display = "block";
                            } else {
                                reasonContainer.style.display = "none";
                            }
                        });

                        // Trigger change event to set the initial state
                        leaveTypeDropdown.dispatchEvent(new Event("change"));
                    });
                </script>

                <div class="mb-4">
                    <label for="other_reason" class="block text-sm font-medium text-gray-700">Reason for Leave:</label>
                    <input type="text" name="other_reason" id="other_reason"
                           class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label for="start_date" class="block text-sm font-medium text-gray-700">Start Date:</label>
                        <input type="date" name="start_date" id="start_date"
                            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                    </div>
                    <div>
                        <label for="end_date" class="block text-sm font-medium text-gray-700">End Date:</label>
                        <input type="date" name="end_date" id="end_date"
                            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                    </div>
                </div>

                <div class="flex items-center justify-end">
                    <button type="submit"
                        class="bg-indigo-500 text-white px-4 py-2 rounded-md hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Submit Leave Request
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
