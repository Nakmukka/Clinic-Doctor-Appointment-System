<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PaymentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function(){
    return view('main');
});
// Auth Routes
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

//appointment Routes
// Show the appointment form and appointments
Route::get('/', [AppointmentController::class, 'showFormAndAppointments'])->name('appointments.create');

// Handle booking the appointment
Route::post('/book', [AppointmentController::class, 'bookAppointment'])->name('appointments.book');

Route::post('/appointments/{id}/confirm-payment', [AppointmentController::class, 'confirmPayment'])->name('appointments.confirmPayment');
Route::delete('/appointments/{id}/cancel', [AppointmentController::class, 'cancel'])->name('appointments.cancel');


//admin
// Admin login route
Route::get('/admin/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login.submit');
Route::get('/admin/dashboard', [AdminController::class, 'showDashboard'])->name('admin.dashboard');
Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::post('/admin/appointment/{id}/update-message', [AdminController::class, 'updateMessage'])->name('admin.updateMessage');
// Add this route for confirming an appointment
Route::post('/admin/appointments/{id}/confirm', [AppointmentController::class, 'confirmAppointment'])->name('admin.appointments.confirm');


//payment
// Payment routes
Route::post('/payment/process/{appointment}', [PaymentController::class, 'process'])->name('payment.process');
Route::post('/payment/success', [PaymentController::class, 'success'])->name('payment.success');


