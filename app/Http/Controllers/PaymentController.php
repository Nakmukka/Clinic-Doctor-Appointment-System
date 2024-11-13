<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use Razorpay\Api\Api;

class PaymentController extends Controller
{
    public function process(Request $request, $appointmentId)
    {
        // Load Razorpay API with configured keys
        //$api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));
        $api = new Api('your_key_here', 'your_secret_here');

        $appointment = Appointment::findOrFail($appointmentId);

        // Create Razorpay order
        $order = $api->order->create([
            'amount' => $appointment->fee * 100, // Amount in paisa (INR)
            'currency' => 'INR',
            'receipt' => 'order_rcptid_' . $appointment->id,
            'notes' => [
                'appointment_id' => $appointment->id
            ]
        ]);

        return view('payment.checkout', [
            'order' => $order,
            'appointment' => $appointment
        ]);
    }

    public function success(Request $request)
    {
        // Validate payment
        $appointment = Appointment::findOrFail($request->input('appointment_id'));
        $appointment->update(['payment_status' => 'Paid']);

        return redirect()->route('main')->with('success', 'Payment successful and status updated to Paid');
    }
}
