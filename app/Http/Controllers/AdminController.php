<?php
namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use App\Models\Appointment;


class AdminController extends Controller
{
    
    // Show the admin login form
    public function showLoginForm()
    {
        return view('admin.login');
    }

    // Handle admin login logic
    public function login(Request $request)
    {
        $predefinedUsername = 'admin';
        $predefinedPassword = 'admin123';

        if ($request->name === $predefinedUsername && $request->password === $predefinedPassword) {
            session(['is_admin_logged_in' => true]); // Store admin login status in session
            return redirect()->route('admin.dashboard'); // Redirect to dashboard
        }

        return redirect()->back()->withErrors(['Invalid credentials.']);
    }
         

    // Show admin dashboard with appointments
    public function showDashboard()
    {
        if (!session('is_admin_logged_in')) {
            return redirect()->route('admin.login'); // Redirect to login if not authenticated
        }

        $appointments = Appointment::all(); // Fetch all appointments
        return view('admin.dashboard', compact('appointments'));
    }

    // In Admin Dashboard Controller
        public function dashboard()
    {
        // Count total appointments
        $totalAppointments = Appointment::count();

        // Count appointments for today
        $appointmentsToday = Appointment::whereDate('date', Carbon::today())->count();

        // Fetch all appointments with user details
        $appointments = Appointment::with('user')->get();

        return view('admin.dashboard', compact('totalAppointments', 'appointmentsToday', 'appointments'));
    }

    public function updateMessage(Request $request, $id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->doctor_message = $request->input('doctor_message');
        $appointment->save();

        return redirect()->route('admin.dashboard')->with('success', 'Message updated successfully.');
    }

    // Logout method (optional)
    public function logout()
    {
        session()->forget('is_admin_logged_in'); // Clear the session
        return redirect()->route('admin.login');
    }
}
