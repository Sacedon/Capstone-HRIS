<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Additional Fields') }}
        </h2>
    </x-slot>

    <div id="successMessage" class="alert alert-success" style="display: none;"></div>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <form method="post" action="{{ route('update-additional-fields') }}">
                    @csrf


                    <div class="flex items-center justify-end">
                        <button type="submit" class="btn-save">Next</button>
                    </div>
                    <!-- Residential Address -->
                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-700 mb-2">RESIDENTIAL ADDRESS</h3>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="residential_house_no" class="block text-sm font-medium text-gray-700">House/Block/Lot No.:</label>
                                <input type="text" id="residential_house_no" name="residential_house_no" value="{{ old('residential_house_no', $user->residential_house_no) }}"
                                    class="input-field">
                            </div>
                            <div>
                                <label for="residential_street" class="block text-sm font-medium text-gray-700">Street:</label>
                                <input type="text" id="residential_street" name="residential_street" value="{{ old('residential_street', $user->residential_street) }}"
                                    class="input-field">
                            </div>
                            <div>
                                <label for="residential_subdivision" class="block text-sm font-medium text-gray-700">Subdivision/Village:</label>
                                <input type="text" id="residential_subdivision" name="residential_subdivision" value="{{ old('residential_subdivision', $user->residential_subdivision) }}"
                                    class="input-field">
                            </div>
                            <div>
                                <label for="residential_barangay" class="block text-sm font-medium text-gray-700">Barangay:</label>
                                <input type="text" id="residential_barangay" name="residential_barangay" value="{{ old('residential_barangay', $user->residential_barangay) }}"
                                    class="input-field">
                            </div>
                            <div>
                                <label for="residential_city" class="block text-sm font-medium text-gray-700">City/Municipality:</label>
                                <input type="text" id="residential_city" name="residential_city" value="{{ old('residential_city', $user->residential_city) }}"
                                    class="input-field">
                            </div>
                            <div>
                                <label for="residential_province" class="block text-sm font-medium text-gray-700">Province:</label>
                                <input type="text" id="residential_province" name="residential_province" value="{{ old('residential_province', $user->residential_province) }}"
                                    class="input-field">
                            </div>
                            <div>
                                <label for="residential_zip_code" class="block text-sm font-medium text-gray-700">ZIP CODE:</label>
                                <input type="text" id="residential_zip_code" name="residential_zip_code" value="{{ old('residential_zip_code', $user->residential_zip_code) }}"
                                    class="input-field">
                            </div>
                        </div>
                    </div>

                    <!-- Permanent Address -->
                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-700 mb-2">PERMANENT ADDRESS</h3>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="permanent_house_no" class="block text-sm font-medium text-gray-700">House/Block/Lot No.:</label>
                                <input type="text" id="permanent_house_no" name="permanent_house_no" value="{{ old('permanent_house_no', $user->permanent_house_no) }}"
                                    class="input-field">
                            </div>
                            <div>
                                <label for="permanent_street" class="block text-sm font-medium text-gray-700">Street:</label>
                                <input type="text" id="permanent_street" name="permanent_street" value="{{ old('permanent_street', $user->permanent_street) }}"
                                    class="input-field">
                            </div>
                            <div>
                                <label for="permanent_subdivision" class="block text-sm font-medium text-gray-700">Subdivision/Village:</label>
                                <input type="text" id="permanent_subdivision" name="permanent_subdivision" value="{{ old('permanent_subdivision', $user->permanent_subdivision) }}"
                                    class="input-field">
                            </div>
                            <div>
                                <label for="permanent_barangay" class="block text-sm font-medium text-gray-700">Barangay:</label>
                                <input type="text" id="permanent_barangay" name="permanent_barangay" value="{{ old('permanent_barangay', $user->permanent_barangay) }}"
                                    class="input-field">
                            </div>
                            <div>
                                <label for="permanent_city" class="block text-sm font-medium text-gray-700">City/Municipality:</label>
                                <input type="text" id="permanent_city" name="permanent_city" value="{{ old('permanent_city', $user->permanent_city) }}"
                                    class="input-field">
                            </div>
                            <div>
                                <label for="permanent_province" class="block text-sm font-medium text-gray-700">Province:</label>
                                <input type="text" id="permanent_province" name="permanent_province" value="{{ old('permanent_province', $user->permanent_province) }}"
                                    class="input-field">
                            </div>
                            <div>
                                <label for="permanent_zip_code" class="block text-sm font-medium text-gray-700">ZIP CODE:</label>
                                <input type="text" id="permanent_zip_code" name="permanent_zip_code" value="{{ old('permanent_zip_code', $user->permanent_zip_code) }}"
                                    class="input-field">
                            </div>
                        </div>
                    </div>

                    <!-- Telephone Number -->
                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-700 mb-2">TELEPHONE NO.</h3>
                        <input type="text" id="telephone_number" name="telephone_number" value="{{ old('telephone_number', $user->telephone_number) }}"
                            class="input-field">
                    </div>

                    <!-- Mobile Number -->
                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-700 mb-2">MOBILE NO.</h3>
                        <input type="text" id="mobile_number" name="mobile_number" value="{{ old('mobile_number', $user->mobile_number) }}"
                            class="input-field">
                    </div>

                    <!-- Messenger Account -->
                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-700 mb-2">MESSENGER ACCT.</h3>
                        <input type="text" id="messenger_account" name="messenger_account" value="{{ old('messenger_account', $user->messenger_account) }}"
                            class="input-field">
                    </div>

                    <div>
                        <h3 class="text-lg font-medium text-gray-700 mb-2">SPOUSE'S INFORMATION</h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div>
                                <label for="spouse_surname" class="block text-sm font-medium text-gray-700">Spouse's Surname:</label>
                                <input type="text" id="spouse_surname" name="spouse_surname" value="{{ old('spouse_surname', $user->spouse_surname) }}" class="input-field">
                            </div>
                            <div>
                                <label for="spouse_first_name" class="block text-sm font-medium text-gray-700">Spouse's First Name:</label>
                                <input type="text" id="spouse_first_name" name="spouse_first_name" value="{{ old('spouse_first_name', $user->spouse_first_name) }}" class="input-field">
                            </div>
                            <div>
                                <label for="spouse_name_extension" class="block text-sm font-medium text-gray-700">Name Extension (JR., SR):</label>
                                <input type="text" id="spouse_name_extension" name="spouse_name_extension" value="{{ old('spouse_name_extension', $user->spouse_name_extension) }}" class="input-field">
                            </div>
                            <div>
                                <label for="spouse_middle_name" class="block text-sm font-medium text-gray-700">Spouse's Middle Name:</label>
                                <input type="text" id="spouse_middle_name" name="spouse_middle_name" value="{{ old('spouse_middle_name', $user->spouse_middle_name) }}" class="input-field">
                            </div>
                            <div>
                                <label for="spouse_occupation" class="block text-sm font-medium text-gray-700">Spouse's Occupation:</label>
                                <input type="text" id="spouse_occupation" name="spouse_occupation" value="{{ old('spouse_occupation', $user->spouse_occupation) }}" class="input-field">
                            </div>
                            <div>
                                <label for="spouse_employer" class="block text-sm font-medium text-gray-700">Spouse's Employer/Business Name:</label>
                                <input type="text" id="spouse_employer" name="spouse_employer" value="{{ old('spouse_employer', $user->spouse_employer) }}" class="input-field">
                            </div>
                            <div>
                                <label for="spouse_business_address" class="block text-sm font-medium text-gray-700">Spouse's Business Address:</label>
                                <input type="text" id="spouse_business_address" name="spouse_business_address" value="{{ old('spouse_business_address', $user->spouse_business_address) }}" class="input-field">
                            </div>
                            <div>
                                <label for="spouse_telephone" class="block text-sm font-medium text-gray-700">Spouse's Telephone No.:</label>
                                <input type="text" id="spouse_telephone" name="spouse_telephone" value="{{ old('spouse_telephone', $user->spouse_telephone) }}" class="input-field">
                            </div>
                        </div>
                    </div>





                    <div>
                        <h3 class="text-lg font-medium text-gray-700 mb-2">FATHER'S INFORMATION</h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div>
                                <label for="father_surname" class="block text-sm font-medium text-gray-700">Father's Surname:</label>
                                <input type="text" id="father_surname" name="father_surname" value="{{ old('father_surname', $user->father_surname) }}" class="input-field">
                            </div>

                            <div>
                                <label for="father_first_name" class="block text-sm font-medium text-gray-700">Father's First Name:</label>
                                <input type="text" id="father_first_name" name="father_first_name" value="{{ old('father_first_name', $user->father_first_name) }}" class="input-field">
                            </div>

                            <div>
                                <label for="father_name_extension" class="block text-sm font-medium text-gray-700">Father's First Name Extension (JR., SR):</label>
                                <input type="text" id="father_name_extension" name="father_name_extension" value="{{ old('father_name_extension', $user->father_name_extension) }}" class="input-field">
                            </div>

                            <div>
                                <label for="father_middle_name" class="block text-sm font-medium text-gray-700">Father's Middle Name:</label>
                                <input type="text" id="father_middle_name" name="father_middle_name" value="{{ old('father_middle_name', $user->father_middle_name) }}" class="input-field">
                            </div>
                            <!-- Add the rest of the father's fields here -->
                        </div>
                    </div>

                    <div>
                        <h3 class="text-lg font-medium text-gray-700 mb-2">MOTHER'S INFORMATION</h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div>
                                <label for="mother_maiden_surname" class="block text-sm font-medium text-gray-700">Mother's Maiden Surname:</label>
                                <input type="text" id="mother_maiden_surname" name="mother_maiden_surname" value="{{ old('mother_maiden_surname', $user->mother_maiden_surname) }}" class="input-field">
                            </div>

                            <div>
                                <label for="mother_first_name" class="block text-sm font-medium text-gray-700">Mother's Maiden First Name:</label>
                                <input type="text" id="mother_first_name" name="mother_first_name" value="{{ old('mother_first_name', $user->mother_first_name) }}" class="input-field">
                            </div>

                            <div>
                                <label for="mother_middle_name" class="block text-sm font-medium text-gray-700">Mother's Maiden Middle Name:</label>
                                <input type="text" id="mother_middle_name" name="mother_middle_name" value="{{ old('mother_middle_name', $user->mother_middle_name) }}" class="input-field">
                            </div>
                            <!-- Add the rest of the mother's fields here -->
                        </div>
                    </div>


                </form>

                <!-- Display the table of children here -->
                <div class="py-6">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                            <form method="post" action="{{ route('update-additional-fields') }}" class="form">
                                @csrf

                                <!-- CHILDREN INFORMATION -->
                                <div class="section">
                                    <h3 class="section-title">CHILDREN INFORMATION</h3>

                                    <!-- Table for displaying children -->
                                    <table class="w-full table">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Birthdate</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($user->children as $child)
                                            <tr>
                                                <td>{{ $child->name }}</td>
                                                <td>{{ $child->birthdate }}</td>
                                                <td>
                                                    <button type="button" class="btn btn-danger delete-button" data-child-id="{{ $child->id }}" data-bs-toggle="modal" data-bs-target="#deleteChildModal{{ $child->id }}">Delete</button>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                    <!-- Add button for adding a new child -->
                                    <button type="button" class="add-button" id="addChildButton">Add Child</button>
                                </div>
                            </form>

                            @foreach ($user->children as $child)
                            <div class="modal-container" id="deleteChildModal{{ $child->id }}">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteChildModalLabel{{ $child->id }}">Confirm Deletion</h5>
                                    </div>
                                    <div class="modal-body">
                                        <p>Are you sure you want to delete this child?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="modal-button cancel" data-bs-dismiss="modal">Cancel</button>
                                        <form method="POST" action="{{ route('additional_fields.destroy', ['id' => $child->id]) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="modal-button delete">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @endforeach

                            <!-- Add child form -->
                            <div id="childForm" style="display: none;">
                                <h3 class="section-title">Add Child</h3>
                                <form method="POST" action="{{ route('additional_fields.store') }}" class="form" id="addChildForm">
                                    @csrf

                                    <div class="mb-6">
                                        <label for="child_name" class="block text-sm font-medium text-gray-700">Child's Name:</label>
                                        <input type="text" id="child_name" name="name" value="{{ old('name') }}" class="input-field">
                                    </div>

                                    <div class="mb-6">
                                        <label for="child_birthdate" class="block text-sm font-medium text-gray-700">Child's Birthdate:</label>
                                        <input type="date" id="child_birthdate" name="birthdate" value="{{ old('birthdate') }}" class="input-field">
                                    </div>

                                    <!-- Hidden input to set the user_id -->
                                    <input type="hidden" name="user_id" value="{{ $user->id }}">

                                    <div class="flex items-center justify-end">
                                        <button type="submit" class="btn-save">Add</button>
                                        <button type="button" class="btn-cancel" id="cancelChildButton">Cancel</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <script>
                    // Function to add a child to the table
                    function addChildToTable(child) {
                        const tableBody = document.querySelector('.table tbody');
                        const newRow = document.createElement('tr');
                        newRow.innerHTML = `
                            <td>${child.name}</td>
                            <td>${child.birthdate}</td>
                            <td>
                                <button type="button" class="btn btn-danger delete-button" data-child-id="${child.id}" data-bs-toggle="modal" data-bs-target="#deleteChildModal${child.id}">Delete</button>
                            </td>
                        `;
                        tableBody.appendChild(newRow);
                    }

                    document.addEventListener('DOMContentLoaded', function () {
                        const addChildButton = document.getElementById('addChildButton');
                        const childForm = document.getElementById('childForm');
                        const cancelChildButton = document.getElementById('cancelChildButton');
                        const deleteButtons = document.querySelectorAll('.delete-button');

                        addChildButton.addEventListener('click', function () {
                            childForm.style.display = 'block';
                        });

                        cancelChildButton.addEventListener('click', function () {
                            childForm.style.display = 'none';
                        });

                        deleteButtons.forEach(function (deleteButton) {
                            deleteButton.addEventListener('click', function () {
                                // Get the ID of the clicked child
                                const childId = deleteButton.getAttribute('data-child-id');
                                // Get the corresponding modal by ID
                                const deleteChildModal = document.getElementById(`deleteChildModal${childId}`);
                                // Show the modal
                                deleteChildModal.classList.add('show');
                            });
                        });

                        const closeButtons = document.querySelectorAll('.modal-button.cancel');

                        closeButtons.forEach(function (closeButton) {
                            closeButton.addEventListener('click', function () {
                                // Get the parent modal
                                const deleteChildModal = closeButton.closest('.modal-container');
                                // Hide the modal
                                deleteChildModal.classList.remove('show');
                            });
                        });

                        function showSuccessMessage(message) {
            const successMessage = document.getElementById('successMessage');
            successMessage.innerText = message;
            successMessage.style.display = 'block';

            setTimeout(function() {
            successMessage.style.display = 'none';
        }, 3000);
        }

                        // Add Child Form Submission via AJAX
                        const addChildForm = document.getElementById('addChildForm');

                        addChildForm.addEventListener('submit', function (event) {
                            event.preventDefault();

                            const formData = new FormData(addChildForm);

                            fetch('{{ route("additional_fields.store") }}', {
                                method: 'POST',
                                body: formData
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    // Child added successfully, update the UI here
                                    addChildToTable(data.child);

                                    showSuccessMessage('Child added successfully');

                                    // Reset the form and hide it
                                    addChildForm.reset();
                                    childForm.style.display = 'none';
                                } else {
                                    // Handle the error case if needed
                                    console.error(data.message);
                                }
                            })
                            .catch(error => {
                                console.error('An error occurred:', error);
                            });
                        });

                    });
                </script>


            </div>
        </div>
    </div>
</x-app-layout>



<style scoped>

   /* styles.css */

/* Modal container style */
/* Modal container style */
.modal-container {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    z-index: 999;
    display: flex;
    justify-content: center;
    align-items: center;
    opacity: 0;
    visibility: hidden;
}

.modal-container.show {
    opacity: 1;
    visibility: visible;
    transition: opacity 0.3s ease-in-out, visibility 0.3s ease-in-out;
}

/* Modal content style */
.modal-content {
    background-color: #ffffff;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    max-width: 400px;
    text-align: center;
    overflow: hidden;
    transform: scale(0.9);
    transition: transform 0.3s ease-in-out;
}

.modal-container.show .modal-content {
    transform: scale(1);
}

/* Modal header style */
.modal-header {
    background-color: #e53e3e;
    color: #ffffff;
    padding: 12px;
    border-top-left-radius: 8px;
    border-top-right-radius: 8px;
}

/* Modal body style */
.modal-body {
    padding: 20px;
    color: #333;
}

/* Modal footer style */
.modal-footer {
    padding: 12px;
    text-align: center; /* Center align the buttons */
    background-color: #f3f4f6;
    border-bottom-left-radius: 8px;
    border-bottom-right-radius: 8px;
    display: flex; /* Use flex to align buttons horizontally */
    justify-content: center;
}

/* Modal buttons style */
.modal-button {
    padding: 8px 16px;
    margin-right: 8px;
    cursor: pointer;
    border: none;
    border-radius: 4px;
    transition: background-color 0.3s ease-in-out, color 0.3s ease-in-out;
}

.modal-button.cancel {
    background-color: #ccc;
    color: #333;
}

.modal-button.delete {
    background-color: #e53e3e;
    color: #ffffff;
}

.modal-button.delete:hover {
    background-color: #c53030;
}

.delete-button {
    background-color: #e53e3e; /* Background color */
    color: #fff; /* Text color */
    border: none; /* Remove border */
    border-radius: 5px; /* Rounded corners */
    padding: 8px 16px; /* Padding */
    cursor: pointer; /* Cursor style */
    transition: background-color 0.3s ease-in-out, color 0.3s ease-in-out; /* Smooth transition */
}

/* Button hover style */
.delete-button:hover {
    background-color: #c53030; /* Hover background color */
}


   .form {
    padding: 1rem;
}

/* Section title style */
.section-title {
    font-size: 1.5rem;
    font-weight: bold;
    color: #333;
    margin-top: 20px;
}

/* Table styles */
.table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 10px;
}

.table th,
.table td {
    border: 1px solid #e5e7eb;
    padding: 8px 12px;
    text-align: left;
}

/* Add button style */
.add-button {
    background-color: #2563eb;
    color: white;
    padding: 0.5rem 1rem;
    border: none;
    border-radius: 0.375rem;
    cursor: pointer;
    margin-top: 10px;
    margin-right: 7px;
}

.btn-cancel {
    background-color: #ff6347; /* Red color */
    color: white;
    padding: 0.5rem 1rem;
    border: none;
    border-radius: 0.375rem;
    cursor: pointer;
    margin-top: 10px;
    margin-right: 7px; /* Add some spacing between "Cancel" and "Save" buttons */
    margin-left: 7px;
}

/* Input field style */
.input-field {
    border: 1px solid #e5e7eb;
    border-radius: 0.375rem;
    padding: 0.5rem;
    width: 100%;
    margin-top: 0.25rem;
}

/* Submit button style */
.btn-save {
    background-color: #2563eb;
    color: white;
    padding: 0.5rem 1rem;
    border: none;
    border-radius: 0.375rem;
    cursor: pointer;
    margin-top: 10px;
}

/* Page title */
.page-title {
    font-size: 1.5rem;
    font-weight: bold;
    color: #333;
}

/* Page content */
.page-content {
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
    background-color: #fff;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

/* Section title */
.section-title {
    font-size: 1.2rem;
    font-weight: bold;
    color: #333;
    margin-top: 20px;
}

/* Input field */
.input-field {
    border: 1px solid #e5e7eb;
    border-radius: 0.375rem;
    padding: 0.5rem;
    width: 100%;
    margin-top: 0.25rem;
}

/* Add button for children */
.add-button {
    background-color: #2563eb;
    color: white;
    padding: 0.5rem 1rem;
    border: none;
    border-radius: 0.375rem;
    cursor: pointer;
}

/* Submit button */
.btn-save {
    background-color: #2563eb;
    color: white;
    padding: 0.5rem 1rem;
    border: none;
    border-radius: 0.375rem;
    cursor: pointer;
}

    /* Additional CSS styles go here */
</style>
