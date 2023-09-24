<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit User') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-9xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <form method="post" action="{{ route('users.update', $user) }}" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <!-- Surname -->
                        <div>
                            <label for="surname" class="form-label">Surname:</label>
                            <input type="text" id="surname" name="surname" value="{{ old('surname', $user->surname) }}" required
                                class="form-input">
                        </div>
                        <!-- First Name -->
                        <div>
                            <label for="first_name" class="form-label">First Name:</label>
                            <input type="text" id="first_name" name="first_name" value="{{ old('first_name', $user->first_name) }}" required
                                class="form-input">
                        </div>
                        <!-- Middle Name -->
                        <div>
                            <label for="middle_name" class="form-label">Middle Name:</label>
                            <input type="text" id="middle_name" name="middle_name" value="{{ old('middle_name', $user->middle_name) }}" required
                                class="form-input">
                        </div>
                        <!-- Email -->
                        <div>
                            <label for="email" class="form-label">Email:</label>
                            <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required
                                class="form-input">
                        </div>
                        <!-- Role -->
                        <div>
                            <label for="role" class="form-label">Role:</label>
                            <select id="role" name="role" class="form-select">
                                <option value="user" {{ old('role', $user->role) === 'user' ? 'selected' : '' }}>User</option>
                                <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>Admin</option>
                            </select>
                        </div>
                        <!-- Address -->
                        <div>
                            <label for="address" class="form-label">Address:</label>
                            <input type="text" id="address" name="address"
                                value="{{ old('address', $user->address) }}"
                                class="form-input">
                        </div>
                        <!-- Gender -->
                        <div>
                            <label for="gender" class="form-label">Gender:</label>
                            <select id="gender" name="gender" class="form-select">
                                <option value="male" {{ old('gender', $user->gender) === 'male' ? 'selected' : '' }}>Male</option>
                                <option value="female" {{ old('gender', $user->gender) === 'female' ? 'selected' : '' }}>Female</option>
                                <option value="other" {{ old('gender', $user->gender) === 'other' ? 'selected' : '' }}>Other</option>
                            </select>
                        </div>
                        <!-- Date of Birth -->
                        <div>
                            <label for="date_of_birth" class="form-label">Date of Birth:</label>
                            <input type="date" id="date_of_birth" name="date_of_birth"
                                value="{{ old('date_of_birth', $user->date_of_birth) }}"
                                class="form-input">
                        </div>
                        <!-- Department -->
                        <div>
                            <label for="department" class="form-label">Department:</label>
                            <select id="department" name="department" class="form-select">
                                @foreach ($departments as $department)
                                    <option value="{{ $department->name }}" {{ optional($user->department)->name === $department->name ? 'selected' : '' }}>
                                        {{ $department->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <!-- Civil Status -->
                        <div>
                            <label for="civil_status" class="form-label">Civil Status:</label>
                            <select id="civil_status" name="civil_status" class="form-select">
                                <option value="single" {{ old('civil_status', $user->civil_status) === 'single' ? 'selected' : '' }}>Single</option>
                                <option value="married" {{ old('civil_status', $user->civil_status) === 'married' ? 'selected' : '' }}>Married</option>
                                <option value="separated" {{ old('civil_status', $user->civil_status) === 'separated' ? 'selected' : '' }}>Separated</option>
                                <option value="widowed" {{ old('civil_status', $user->civil_status) === 'widowed' ? 'selected' : '' }}>Widowed</option>
                            </select>
                        </div>
                        <!-- Height -->
                        <div>
                            <label for="height" class="form-label">Height (m):</label>
                            <input type="number" id="height" name="height"
                            step="0.01"
                                value="{{ old('height', $user->height) }}"
                                class="form-input">
                        </div>
                        <!-- Weight -->
                        <div>
                            <label for="weight" class="form-label">Weight (kg):</label>
                            <input type="number" id="weight" name="weight"
                                value="{{ old('weight', $user->weight) }}"
                                class="form-input">
                        </div>
                        <!-- Blood Type -->
                        <div>
                            <label for="blood_type" class="form-label">Blood Type:</label>
                            <input type="text" id="blood_type" name="blood_type"
                                value="{{ old('blood_type', $user->blood_type) }}"
                                class="form-input">
                        </div>
                        <!-- SSS ID NO -->
                        <div>
                            <label for="sss_id_no" class="form-label">SSS ID NO:</label>
                            <input type="text" id="sss_id_no" name="sss_id_no"
                                value="{{ old('sss_id_no', $user->sss_id_no) }}"
                                class="form-input">
                        </div>
                        <!-- PAG-IBIG ID NO -->
                        <div>
                            <label for="pag_ibig_id_no" class="form-label">PAG-IBIG ID NO:</label>
                            <input type="text" id="pag_ibig_id_no" name="pag_ibig_id_no"
                                value="{{ old('pag_ibig_id_no', $user->pag_ibig_id_no) }}"
                                class="form-input">
                        </div>
                        <!-- PHILHEALTH NO -->
                        <div>
                            <label for="philhealth_no" class="form-label">PHILHEALTH NO:</label>
                            <input type="text" id="philhealth_no" name="philhealth_no"
                                value="{{ old('philhealth_no', $user->philhealth_no) }}"
                                class="form-input">
                        </div>
                        <!-- TIN NO -->
                        <div>
                            <label for="tin_no" class="form-label">TIN NO:</label>
                            <input type="text" id="tin_no" name="tin_no"
                                value="{{ old('tin_no', $user->tin_no) }}"
                                class="form-input">
                        </div>
                        <!-- MDC-ID No -->
                        <div>
                            <label for="mdc_id" class="form-label">MDC-ID No:</label>
                            <input type="text" id="mdc_id" name="mdc_id"
                                value="{{ old('mdc_id', $user->mdc_id) }}"
                                class="form-input">
                        </div>
                        <!-- Place of Birth -->
                        <div>
                            <label for="place_of_birth" class="form-label">Place of Birth:</label>
                            <input type="text" id="place_of_birth" name="place_of_birth"
                                value="{{ old('place_of_birth', $user->place_of_birth) }}"
                                class="form-input">
                        </div>
                        <!-- Profile Picture -->
                        <div>
                            <label for="profile_picture" class="form-label">Profile Picture</label>
                            <input type="file" id="profile_picture" name="profile_picture" accept="image/*"
                                class="form-input">
                        </div>

                        <div class="mb-6">
                            <h3 class="text-lg font-medium text-gray-700 mb-2">RESIDENTIAL ADDRESS</h3>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label for="residential_house_no" class="form-label">House/Block/Lot No.:</label>
                                    <input type="text" id="residential_house_no" name="residential_house_no" value="{{ old('residential_house_no', $user->residential_house_no) }}"
                                        class="form-input">
                                </div>
                                <div>
                                    <label for="residential_street" class="form-label">Street:</label>
                                    <input type="text" id="residential_street" name="residential_street" value="{{ old('residential_street', $user->residential_street) }}"
                                        class="form-input">
                                </div>
                                <div>
                                    <label for="residential_subdivision" class="form-label">Subdivision/Village:</label>
                                    <input type="text" id="residential_subdivision" name="residential_subdivision" value="{{ old('residential_subdivision', $user->residential_subdivision) }}"
                                        class="form-input">
                                </div>
                                <div>
                                    <label for="residential_barangay" class="form-label">Barangay:</label>
                                    <input type="text" id="residential_barangay" name="residential_barangay" value="{{ old('residential_barangay', $user->residential_barangay) }}"
                                        class="form-input">
                                </div>
                                <div>
                                    <label for="residential_city" class="form-label">City/Municipality:</label>
                                    <input type="text" id="residential_city" name="residential_city" value="{{ old('residential_city', $user->residential_city) }}"
                                        class="form-input">
                                </div>
                                <div>
                                    <label for="residential_province" class="form-label">Province:</label>
                                    <input type="text" id="residential_province" name="residential_province" value="{{ old('residential_province', $user->residential_province) }}"
                                        class="form-input">
                                </div>
                                <div>
                                    <label for="residential_zip_code" class="form-label">ZIP CODE:</label>
                                    <input type="text" id="residential_zip_code" name="residential_zip_code" value="{{ old('residential_zip_code', $user->residential_zip_code) }}"
                                        class="form-input">
                                </div>
                            </div>
                        </div>

                        <!-- Permanent Address -->
                        <div class="mb-6">
                            <h3 class="text-lg font-medium text-gray-700 mb-2">PERMANENT ADDRESS</h3>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label for="permanent_house_no" class="form-label">House/Block/Lot No.:</label>
                                    <input type="text" id="permanent_house_no" name="permanent_house_no" value="{{ old('permanent_house_no', $user->permanent_house_no) }}"
                                        class="form-input">
                                </div>
                                <div>
                                    <label for="permanent_street" class="form-label">Street:</label>
                                    <input type="text" id="permanent_street" name="permanent_street" value="{{ old('permanent_street', $user->permanent_street) }}"
                                        class="form-input">
                                </div>
                                <div>
                                    <label for="permanent_subdivision" class="form-label">Subdivision/Village:</label>
                                    <input type="text" id="permanent_subdivision" name="permanent_subdivision" value="{{ old('permanent_subdivision', $user->permanent_subdivision) }}"
                                        class="form-input">
                                </div>
                                <div>
                                    <label for="permanent_barangay" class="form-label">Barangay:</label>
                                    <input type="text" id="permanent_barangay" name="permanent_barangay" value="{{ old('permanent_barangay', $user->permanent_barangay) }}"
                                        class="form-input">
                                </div>
                                <div>
                                    <label for="permanent_city" class="form-label">City/Municipality:</label>
                                    <input type="text" id="permanent_city" name="permanent_city" value="{{ old('permanent_city', $user->permanent_city) }}"
                                        class="form-input">
                                </div>
                                <div>
                                    <label for="permanent_province" class="form-label">Province:</label>
                                    <input type="text" id="permanent_province" name="permanent_province" value="{{ old('permanent_province', $user->permanent_province) }}"
                                        class="form-input">
                                </div>
                                <div>
                                    <label for="permanent_zip_code" class="form-label">ZIP CODE:</label>
                                    <input type="text" id="permanent_zip_code" name="permanent_zip_code" value="{{ old('permanent_zip_code', $user->permanent_zip_code) }}"
                                        class="form-input">
                                </div>
                            </div>
                        </div>

                        <!-- Telephone Number -->
                        <div class="mb-6">
                            <h3 class="text-lg font-medium text-gray-700 mb-2">TELEPHONE NO.</h3>
                            <input type="text" id="telephone_number" name="telephone_number" value="{{ old('telephone_number', $user->telephone_number) }}"
                                class="form-input">
                        </div>

                        <!-- Mobile Number -->
                        <div class="mb-6">
                            <h3 class="text-lg font-medium text-gray-700 mb-2">MOBILE NO.</h3>
                            <input type="text" id="mobile_number" name="mobile_number" value="{{ old('mobile_number', $user->mobile_number) }}"
                                class="form-input">
                        </div>

                        <!-- Messenger Account -->
                        <div class="mb-6">
                            <h3 class="text-lg font-medium text-gray-700 mb-2">MESSENGER ACCT.</h3>
                            <input type="text" id="messenger_account" name="messenger_account" value="{{ old('messenger_account', $user->messenger_account) }}"
                                class="form-input">
                        </div>
                    </div>

                    <div class="flex items-center justify-end">
                        <button type="submit"
                            class="btn-save">
                            Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

<style scoped>
    .form-label {
        display: block;
        margin-bottom: 0.25rem;
        font-size: 1.400rem;
        color: #0e1011;
    }

    .form-input {
        border: 1px solid #e2e8f0;
        padding: 0.5rem;
        border-radius: 0.25rem;
        width: 100%;
        transition: border-color 0.3s ease;
    }

    .form-input:focus {
        outline: none;
        border-color: #4a90e2;
    }

    .form-select {
        border: 1px solid #e2e8f0;
        padding: 0.5rem;
        border-radius: 0.25rem;
        width: 100%;
        transition: border-color 0.3s ease;
    }

    .form-select:focus {
        outline: none;
        border-color: #4a90e2;
    }

    .btn-save {
        background-color: #4a90e2;
        color: white;
        padding: 0.5rem 1rem;
        border: none;
        border-radius: 0.25rem;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .btn-save:hover {
        background-color: #357abd;
    }
</style>
