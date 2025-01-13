<!DOCTYPE html>
<html>
<head>
    <title>Attendances</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
        button {
            padding: 10px 15px;
            border: none;
            background-color: #4CAF50;
            color: white;
            border-radius: 5px;
            cursor: pointer;
        }
        button:disabled {
            background-color: #ccc;
            cursor: not-allowed;
        }
    </style>
</head>
<body>
    <h1>Attendance Records</h1>
    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif
    @if(session('error'))
        <p style="color: red;">{{ session('error') }}</p>
    @endif

    <!-- Check-In Logic -->
    @if($checkInPhase === 'normal')
        <form method="POST" action="{{ route('attendances.checkIn') }}">
            @csrf
            <button type="submit">Check In</button>
        </form>
    @elseif($checkInPhase === 'admin_approval')
        <p style="color: orange;">Check-In requires admin approval!</p>
        <form method="POST" action="{{ route('attendances.checkIn') }}">
            @csrf
            <button type="submit" style="background-color: #FFA500;">Request Admin Approval</button>
        </form>
    @else
        <p style="color: red;">Check-In time is over for today!</p>
    @endif

    <!-- Check-Out Button -->
    <form method="POST" action="{{ route('attendances.checkOut') }}">
        @csrf
        <button type="submit">Check Out</button>
    </form>

    <table>
        <tr>
            <th>User</th>
            <th>Date</th>
            <th>Check-In</th>
            <th>Check-Out</th>
        </tr>
        @foreach($attendances as $attendance)
            <tr>
                <td>{{ $attendance->user->name }}</td>
                <td>{{ $attendance->date }}</td>
                <td>{{ $attendance->check_in }}</td>
                <td>{{ $attendance->check_out }}</td>
            </tr>
        @endforeach
    </table>
</body>
</html>
