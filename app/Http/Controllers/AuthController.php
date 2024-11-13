<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Show the registration form
    public function showRegistrationForm()
    {
        return view('auth.register'); // Adjust the path as necessary
    }

    // Handle registration logic
    public function register(Request $request)
    {
        // Log the incoming request data to confirm the data being received
         \Log::info('User registration request data: ', $request->all());

        // Validate the request
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            // Log validation errors if any
        \Log::info('Validation failed: ', $validator->errors()->toArray());
            return back()->withErrors($validator)->withInput();
        }

        try{

       
        // Create the user
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
    }
    catch(\Exception $e){
        dd($e->getMessage());
    }

        // Flash a test success message
    //session()->flash('success', 'Test success message'); // Temporary test
        // Redirect to login page with a success message
        return redirect()->route('login')->with('success', 'Successfully registered! Please log in.');
    }

    // Show the login form
    public function showLoginForm()
    {
        return view('auth.login'); // Adjust the path as necessary
    }

    // Handle login logic
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication passed...
            return redirect()->intended('/'); // Adjust the redirection as necessary
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    // Handle logout logic
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/')->with('success', 'Successfully logged out.');
    }
}
