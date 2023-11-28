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
                            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" onchange="showAdditionalOptions()">
                        <option value="vacation">Vacation Leave</option>
                        <option value="sick">Sick Leave</option>
                        <option value="personal">Personal Leave</option>
                        <option value="fiesta">Fiesta Leave</option>
                        <option value="birthday">Birthday Leave</option>
                        <option value="maternity">Maternity Leave</option>
                        <option value="paternity">Paternity Leave</option>
                        <option value="educational">Educational Leave</option>
                    </select>
                </div>

                <div id="additionalOptions" style="display: none;">
                    <!-- Add your additional choices here -->
                    <label for="educational_reason" class="block text-sm font-medium text-gray-700">Educational Reason:</label>
                    <select name="educational_reason" id="educational_reason"
                            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" onchange="showAdditionalOptions()">
                        <option value="Completion of Doctor's Degree">Completion of Doctor's Degree</option>
                        <option value="Completion of Master's Degree">Completion of Master's Degree</option>
                        <option value="Board Examination Review">Board Examination Review</option>
                        <option value="other">Other</option> <!-- Added "Other" option -->
                    </select>

                    <!-- Additional input field for "Other" option -->
                    <div id="otherEducationalReason" style="display: none;">
                        <label for="other_educational_reason" class="block text-sm font-medium text-gray-700">Specify Other Reason:</label>
                        <input type="text" id="other_educational_reason" name="other_educational_reason"
                               class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    </div>
                </div>

                <script>
                    function showAdditionalOptions() {
                        var leaveType = document.getElementById('leave_type').value;
                        var additionalOptions = document.getElementById('additionalOptions');
                        var otherEducationalReason = document.getElementById('otherEducationalReason');

                        if (leaveType === 'educational') {
                            additionalOptions.style.display = 'block';
                        } else {
                            additionalOptions.style.display = 'none';
                        }

                        var educationalReason = document.getElementById('educational_reason');
                        if (leaveType === 'educational' && educationalReason.value === 'other') {
                            otherEducationalReason.style.display = 'block';
                        } else {
                            otherEducationalReason.style.display = 'none';
                        }
                    }
                </script>

                <div class="mb-4" id="reason-container" style="display: none;">
                    <!-- Initially hidden, will be shown only when "Sick" is selected -->
                    <label for="reason" class="block text-sm font-medium text-gray-700">Specific Type of Sick:</label>
                    <div class="mt-1">
                        <input type="checkbox" name="reason[]" id="flu" value="Flu" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                        <label for="flu" class="ml-2 text-sm text-gray-700">Flu</label>
                    </div>
                    <div class="mt-1">
                        <input type="checkbox" name="reason[]" id="cough" value="Cough" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                        <label for="cough" class="ml-2 text-sm text-gray-700">Cough</label>
                    </div>
                    <div class="mt-1">
                        <input type="checkbox" name="reason[]" id="diarrhea" value="Diarrhea" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                        <label for="diarrhea" class="ml-2 text-sm text-gray-700">Diarrhea</label>
                    </div>
                    <div class="mt-1">
                        <input type="checkbox" name="reason[]" id="headache" value="Headache" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                        <label for="headache" class="ml-2 text-sm text-gray-700">Headache</label>
                    </div>
                    <div class="mt-1">
                        <input type="checkbox" name="reason" id="other" value="other" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                        <label for="other" class="ml-2 text-sm text-gray-700">other</label>
                    </div>
                    <div class="mt-1" id="custom-reason-container" style="display: none;">
                        <label for="custom_reason" class="block text-sm font-medium text-gray-700">Custom Reason:</label>
                        <input type="text" name="reason[]" id="custom_reason" class="form-input rounded-md shadow-sm mt-1 block w-full" />
                    </div>
                </div>

                <script>
                    document.addEventListener("DOMContentLoaded", function () {
                        // Get the leave type dropdown element and reason container
                        const leaveTypeDropdown = document.getElementById("leave_type");
                        const reasonContainer = document.getElementById("reason-container");
                        const customReasonContainer = document.getElementById("custom-reason-container");

                        // Event listener for leave type dropdown change
                        leaveTypeDropdown.addEventListener("change", function () {
                            const selectedLeaveType = this.value;

                            // Toggle visibility of reason container based on the selected leave type
                            if (selectedLeaveType === "sick") {
                                reasonContainer.style.display = "block";
                                customReasonContainer.style.display = "none"; // Hide custom reason field
                            } else {
                                reasonContainer.style.display = "none";
                                customReasonContainer.style.display = "block"; // Show custom reason field
                            }
                        });

                        // Event listener for the "Other" checkbox
                        const otherCheckbox = document.getElementById("other");
                        otherCheckbox.addEventListener("change", function () {
                            customReasonContainer.style.display = this.checked ? "block" : "none";
                            if (!this.checked) {
                                document.getElementById("custom_reason").value = ""; // Clear custom reason input
                            }
                        });

                        // Trigger change event to set the initial state
                        leaveTypeDropdown.dispatchEvent(new Event("change"));
                        otherCheckbox.dispatchEvent(new Event("change"));
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

                <div class="mb-4">
                    <label for="number_of_days" class="block text-sm font-medium text-gray-700">Number of Days:</label>
                    <input type="text" id="number_of_days" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" readonly>
                </div>

                <script>
                    document.addEventListener("DOMContentLoaded", function () {
                        // Your existing JavaScript code...

                        // Event listener for start date and end date change
                        const startDateInput = document.getElementById("start_date");
                        const endDateInput = document.getElementById("end_date");
                        const numberOfDaysInput = document.getElementById("number_of_days");

                        function updateNumberOfDays() {
                            const startDate = new Date(startDateInput.value);
                            const endDate = new Date(endDateInput.value);

                            // Calculate the difference in days
                            const timeDifference = endDate - startDate;
                            const daysDifference = Math.ceil(timeDifference / (1000 * 60 * 60 * 24));

                            // Display the number of days
                            numberOfDaysInput.value = daysDifference;
                        }

                        // Event listeners for date inputs
                        startDateInput.addEventListener("change", updateNumberOfDays);
                        endDateInput.addEventListener("change", updateNumberOfDays);

                        // Trigger change event to set the initial state
                        leaveTypeDropdown.dispatchEvent(new Event("change"));
                        otherCheckbox.dispatchEvent(new Event("change"));
                        startDateInput.dispatchEvent(new Event("change"));
                        endDateInput.dispatchEvent(new Event("change"));
                    });
                </script>

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
