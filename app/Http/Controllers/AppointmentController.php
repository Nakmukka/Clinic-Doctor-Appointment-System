<?php
namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AppointmentController extends Controller
{
    // Show the main appointment form with appointment details if available
    public function showFormAndAppointments()
    {
        $userId = Auth::id();
        $appointments = Appointment::where('user_id', $userId)->get();

        return view('main', compact('appointments')); // Load the main view with appointments data
    }

    // Store the appointment in the database and flash the data to the session
    public function bookAppointment(Request $request)
    {
        \Log::info('Incoming request data:', $request->all());

        // Validate the input
        $validatedData = $request->validate([
            'date' => 'required|date|after_or_equal:today',
            'time' => 'required|string',
            'health_condition' => 'required|string',
            'blood_type' => 'required|string',
        ]);

        // Check if the appointment date is today
        if (Carbon::parse($validatedData['date'])->isToday()) {
            // Create the appointment and associate it with the authenticated user
            $appointment = Appointment::create([
                'user_id' => Auth::id(),
                'date' => $validatedData['date'],
                'time' => $validatedData['time'],
                'health_condition' => $validatedData['health_condition'],
                'blood_type' => $validatedData['blood_type'],
                'payment_status' => 'Pending',
            ]);

            // Flash appointment details to the session for immediate display
            session()->flash('appointment', [
                'date' => $appointment->date,
                'time' => $appointment->time,
                'name' => Auth::user()->name,
                'health_condition' => $appointment->health_condition,
                'blood_type' => $appointment->blood_type,
                'payment_status' => 'Pending',
            ]);

            return redirect()->route('appointments.create')->with('success', 'Appointment booked successfully!');
        }

        // If the date is not today, redirect back with an error
        return redirect()->back()->withErrors(['date' => 'The appointment date must be today.'])->withInput();
    }
//for payment
    public function confirmPayment($id)
{
    // Find the appointment by ID
    $appointment = Appointment::findOrFail($id);

    // Update the payment status to 'Paid'
    $appointment->payment_status = 'Paid';
    $appointment->save();

    return redirect()->back()->with('success', 'Payment confirmed successfully!');
}

// Confirm the appointment without requiring a message
public function confirmAppointment($id)
{
    $appointment = Appointment::findOrFail($id);
    $appointment->confirmation_status = 'confirmed'; // Set status to confirmed
    $appointment->save(); // Save the updated status

    // Redirect to the admin dashboard with a success message
    return redirect()->route('admin.dashboard')->with('success', 'Appointment confirmed successfully.');
}

public function cancel($id)
{
    $appointment = Appointment::find($id);

    // Check if the appointment exists and belongs to the authenticated user
    if (!$appointment || $appointment->user_id !== Auth::id()) {
        return redirect()->route('appointments.create')->with('error', 'Appointment not found or you do not have permission to cancel this appointment.');
    }

    // Update the status to 'canceled' (or delete it, if that's your preference)
    $appointment->status = 'Canceled';
    $appointment->save();

    return redirect()->route('appointments.create')->with('success', 'Appointment canceled successfully.');
}


}
