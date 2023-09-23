<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Additional Fields') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <form method="post" action="{{ route('update-additional-fields') }}">
                    @csrf


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

                    <div class="flex items-center justify-end">
                        <button type="submit" class="btn-save">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

<style>
    .input-field {
        border: 1px solid #e5e7eb;
        border-radius: 0.375rem;
        padding: 0.5rem;
        width: 100%;
        margin-top: 0.25rem;
    }

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
