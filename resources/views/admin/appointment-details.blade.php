<!-- resources/views/admin/appointment-details.blade.php -->
@extends('layouts.admin')

@section('content')
<h1>Appointment Details</h1>

<table class="table table-bordered">
    <tr>
        <th>Patient Name</th>
        <td>{{ $appointment->name }}</td>
    </tr>
    <tr>
        <th>Blood Type</th>
        <td>{{ $appointment->blood_type }}</td>
    </tr>
    <tr>
        <th>Date</th>
        <td>{{ $appointment->date }}</td>
    </tr>
    <tr>
        <th>Time</th>
        <td>{{ $appointment->time }}</td>
    </tr>
    <tr>
        <th>Health Condition</th>
        <td>{{ $appointment->health_condition }}</td>
    </tr>
    <tr>
        <th>Doctor's Message</th>
        <td>{{ $appointment->doctor_message ?? 'No message from doctor yet' }}</td>
    </tr>
</table>

<!-- Form to add a message and confirm the appointment -->
<form action="{{ route('admin.appointment.confirm', $appointment->id) }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="doctor_message">Doctor's Message</label>
        <textarea name="doctor_message" class="form-control" rows="3">{{ $appointment->doctor_message }}</textarea>
    </div>
    <button type="submit" class="btn btn-success">Confirm Appointment</button>
</form>
@endsection
