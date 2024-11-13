<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <style>
        /* Reset and basic styling */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }
        body {
            background-color: #f4f6f9;
        }
        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #007bff;
            padding: 10px 20px;
            color: #fff;
            border-radius: 8px 8px 0 0;
        }
        .navbar .welcome {
            font-size: 1.2em;
        }
        .navbar .logout-btn {
            background-color: #ff4d4d;
            border: none;
            padding: 8px 16px;
            border-radius: 4px;
            color: white;
            cursor: pointer;
            font-weight: bold;
        }
        .dashboard-header {
            text-align: center;
            margin-top: 20px;
            font-size: 2em;
            color: #333;
        }
        .stats {
            display: flex;
            justify-content: space-around;
            margin: 20px 0;
            gap: 20px;
        }
        .stat-card {
            flex: 1;
            background-color: #007bff;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 8px;
            font-size: 1.5em;
        }
        .appointments-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            border-radius: 8px;
            overflow: hidden;
        }
        .appointments-table th, .appointments-table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        .appointments-table th {
            background-color: #007bff;
            color: white;
        }
        .appointments-table tbody tr:hover {
            background-color: #f1f1f1;
        }
        .doctor-message {
            color: #555;
            font-style: italic;
        }
        .confirm-btn {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
</head>
<body>

    <div class="container">
        <!-- Navbar with welcome message and logout -->
        <div class="navbar">
            <div class="welcome">Welcome, Admin</div>
            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="logout-btn">Logout</button>
            </form>
        </div>

        <!-- Dashboard Header -->
        <div class="dashboard-header">Admin Dashboard</div>

        <!-- Stats Cards -->
        <div class="stats">
            <div class="stat-card">Total Appointments: {{ $totalAppointments }}</div>
            <div class="stat-card">Today's Appointments: {{ $appointmentsToday }}</div>
        </div>

        <!-- Appointments Table -->
        <h3>All Appointment Details</h3>
        <table class="appointments-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Patient Name</th>
                    <th>Blood Type</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Health Condition</th>
                    <th>Payment Status</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($appointments as $appointment)
                <tr>
                    <td>{{ $appointment->id }}</td>
                    <td>{{ $appointment->user->name }}</td>
                    <td>{{ $appointment->blood_type }}</td>
                    <td>{{ $appointment->date }}</td>
                    <td>{{ $appointment->time }}</td>
                    <td>{{ $appointment->health_condition }}</td>
                    <td>{{ $appointment->payment_status }}</td>

                    <td>{{ $appointment->confirmation_status }}</td>
                    <td>
                        @if($appointment->confirmation_status !== 'confirmed')
                            <!-- Single Confirm Button -->
                            <form action="{{ route('admin.appointments.confirm', $appointment->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="confirm-btn">Confirm Appointment</button>
                            </form>
                        @else
                            Confirmed
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</body>
</html>
