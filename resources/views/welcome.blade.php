<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Attendance System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
        }

        header {
            background-color: #007bff;
            color: white;
            padding: 20px 0;
            text-align: center;
        }

        header h1 {
            margin: 0;
            font-size: 2.5rem;
        }

        .container {
            max-width: 900px;
            margin: 20px auto;
            padding: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .buttons {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 20px;
        }

        .buttons a {
            text-decoration: none;
            color: white;
            background-color: #007bff;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .buttons a:hover {
            background-color: #0056b3;
        }

        footer {
            margin-top: 20px;
            text-align: center;
            color: #666;
        }
    </style>
</head>
<body>

<header>
    <h1>Job Attendance System</h1>
</header>

<div class="container">
    <p>Welcome to the Job Attendance System! This application helps you manage employee attendance by tracking check-in and check-out times, generating attendance reports, and much more.</p>
    <p>If you are an admin, you can view attendance records and manage users. Employees can check in and check out directly from this system.</p>

    @auth
        <p>You are logged in as <strong>{{ Auth::user()->name }}</strong>.</p>
        <div class="buttons">
            <a href="{{ route('attendances.index') }}">View Attendance Records</a>
            <a href="{{ route('logout') }}"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
        </div>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    @else
        <p>Please log in to access the system or sign up if you don’t have an account.</p>
        <div class="buttons">
            <a href="{{ route('login') }}">Login</a>
            <a href="{{ route('register') }}">Sign Up</a>
        </div>
    @endauth
</div>

<footer>
    <p>&copy; {{ date('Y') }} Job Attendance System. All rights reserved.</p>
</footer>

</body>
</html>
