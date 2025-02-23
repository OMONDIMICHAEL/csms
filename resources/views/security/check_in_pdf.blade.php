<!DOCTYPE html>
<html>
<head>
    <title>Check-In History</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Check-In History</h2>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Role</th>
                <th>Check-In Time</th>
                <th>Check-Out Time</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($checkIns as $checkIn)
                <tr>
                    <td>{{ $checkIn->user->name }}</td>
                    <td>{{ ucfirst($checkIn->user->role) }}</td>
                    <td>{{ $checkIn->check_in_time }}</td>
                    <td>{{ $checkIn->check_out_time ?? 'Still Checked In' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
