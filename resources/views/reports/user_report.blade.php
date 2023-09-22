<!DOCTYPE html>
<html>
<head>
    <title>User Report</title>
</head>
<body>
    <h1>User Report</h1>
    <table>
        <thead>
            <tr>
                <th>Full Name</th>
                <th>Email</th>
                <th>Role</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->surname }}, {{ $user->middle_name }} {{ $user->first_name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
