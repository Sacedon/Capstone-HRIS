<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User Details') }}
        </h2>
    </x-slot>

    <style>
        /* Custom CSS for User Details */
        .user-details-table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #e5e7eb;
        }

        .user-details-table th,
        .user-details-table td {
            border: 1px solid #e5e7eb;
            padding: 10px;
        }

        .user-details-table th {
            background-color: #f3f4f6;
            font-weight: 600;
            text-align: left;
        }

        .user-details-table td {
            text-align: left;
        }

        .user-details-table img {
            max-width: 150px;
            max-height: 150px;
            display: block;
            margin: 0 auto;
        }

        .user-details-table th,
        .user-details-table td:first-child {
            width: 30%;
        }

        .user-details-table th:first-child,
        .user-details-table td:first-child {
            font-weight: 600;
        }
    </style>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <table class="user-details-table">
                <tbody>
                    <tr>
                        <th colspan="2">Profile Picture</th>
                    </tr>
                    <tr>
                        <td colspan="2">
                            @if ($user->profile_picture)
                                <img src="{{ Storage::url($user->profile_picture) }}" alt="{{ $user->name }} Profile Picture" class="w-32 h-32 object-cover rounded-full mx-auto">
                            @else
                                <div class="text-gray-400">No Profile Picture</div>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Surname</th>
                        <td>{{ $user->surname }}</td>
                    </tr>
                    <tr>
                        <th>First Name</th>
                        <td>{{ $user->first_name }}</td>
                    </tr>
                    <tr>
                        <th>Middle Name</th>
                        <td>{{ $user->middle_name }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{ $user->email }}</td>
                    </tr>
                    <tr>
                        <th>Role</th>
                        <td>{{ $user->role }}</td>
                    </tr>
                    <tr>
                        <th>Address</th>
                        <td>{{ $user->address }}</td>
                    </tr>
                    <tr>
                        <th>Gender</th>
                        <td>{{ $user->gender }}</td>
                    </tr>
                    <tr>
                        <th>Date of Birth</th>
                        <td>{{ $user->date_of_birth }}</td>
                    </tr>
                    <tr>
                        <th>Department</th>
                        <td>{{ $user->department->name }}</td>
                    </tr>
                    <tr>
                        <th>Civil Status</th>
                        <td>{{ $user->civil_status }}</td>
                    </tr>
                    <tr>
                        <th>Height</th>
                        <td>{{ $user->height }}</td>
                    </tr>
                    <tr>
                        <th>Weight</th>
                        <td>{{ $user->weight }}</td>
                    </tr>
                    <tr>
                        <th>Blood Type</th>
                        <td>{{ $user->blood_type }}</td>
                    </tr>
                    <tr>
                        <th>SSS ID No</th>
                        <td>{{ $user->sss_id_no }}</td>
                    </tr>
                    <tr>
                        <th>Pag-IBIG ID No</th>
                        <td>{{ $user->pag_ibig_id_no }}</td>
                    </tr>
                    <tr>
                        <th>PhilHealth No</th>
                        <td>{{ $user->philhealth_no }}</td>
                    </tr>
                    <tr>
                        <th>TIN No</th>
                        <td>{{ $user->tin_no }}</td>
                    </tr>
                    <tr>
                        <th>MDC ID</th>
                        <td>{{ $user->mdc_id }}</td>
                    </tr>
                    <tr>
                        <th>Place of Birth</th>
                        <td>{{ $user->place_of_birth }}</td>
                    </tr>
                    <tr>
                        <th>Residential Address</th>
                        <td>
                            {{ $user->residential_house_no }},
                            {{ $user->residential_street }},
                            {{ $user->residential_subdivision }},
                            {{ $user->residential_barangay }},
                            {{ $user->residential_city }},
                            {{ $user->residential_province }},
                            {{ $user->residential_zip_code }}
                        </td>
                    </tr>
                    <tr>
                        <th>Permanent Address</th>
                        <td>
                            {{ $user->permanent_house_no }},
                            {{ $user->permanent_street }},
                            {{ $user->permanent_subdivision }},
                            {{ $user->permanent_barangay }},
                            {{ $user->permanent_city }},
                            {{ $user->permanent_province }},
                            {{ $user->permanent_zip_code }}
                        </td>
                    </tr>
                    <tr>
                        <th>Telephone Number</th>
                        <td>{{ $user->telephone_number }}</td>
                    </tr>
                    <tr>
                        <th>Mobile Number</th>
                        <td>{{ $user->mobile_number }}</td>
                    </tr>
                    <tr>
                        <th>Messenger Account</th>
                        <td>{{ $user->messenger_account }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
