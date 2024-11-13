<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 2000 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[Many](https://www.many.co.uk)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[OP.GG](https://op.gg)**
- **[WebReinvent](https://webreinvent.com/?utm_source=laravel&utm_medium=github&utm_campaign=patreon-sponsors)**
- **[Lendio](https://lendio.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

# Clinic-Doctor Appointment Booking System

This project is a **Clinic-Doctor Appointment Booking System** developed with Laravel, designed to simplify the process of booking, managing, and tracking medical appointments in a clinic setting. It features two main modules: a **User Module** for patients and an **Admin Module** for clinic administrators, each providing a set of functionalities tailored to their respective needs.

## Features

### User Module
- **Landing Page**: A welcoming page with a carousel and navigation links, providing easy access to features like booking appointments, viewing appointment details, and user login/register.
- **User Authentication**: Secure login and registration for patients.
- **Book Appointment**: Users can book an appointment with the clinic doctor for the current day by completing a quick form. Their name and phone number are auto-filled from their profile, streamlining the booking process.
- **Appointment Management**: Once an appointment is booked, users can view its details on the main page, including confirmation status and any notes from the doctor.
- **Payment Integration**: Integrated with Razorpay for secure online payments. Users can pay once the doctor confirms the appointment, and the status updates to “Paid” upon successful payment.

### Admin Module
- **Admin Login**: A secure login page with predefined credentials, allowing authorized clinic personnel to access the admin dashboard.
- **Dashboard**: A comprehensive dashboard displays total appointments and today’s bookings.
- **Appointment Management**: Admins can view all appointments with patient details such as name, blood type, date, time, and health condition.
- **Confirmation and Cancellation**: Admins can confirm or cancel appointments as necessary.
- **Doctor's Notes**: Admins have the option to add specific notes for each appointment, visible to the patient in their profile.

## Technology Stack
- **Backend**: Laravel (PHP Framework)
- **Frontend**: Blade templates, Bootstrap 4 for styling
- **Database**: MySQL
- **Payment Gateway**: Razorpay API for secure online payments

## Installation and Setup
1. Clone this repository:
   ```bash
   git clone https://github.com/your-username/clinic-doctor-appointment-system.git
   cd clinic-doctor-appointment-system
   ```

2. Install dependencies:
   ```bash
   composer install
   npm install
   ```

3. Configure `.env` file:
   - Set up your database credentials.
   - Add your Razorpay API keys.

4. Run migrations and seed the database:
   ```bash
   php artisan migrate --seed
   ```

5. Serve the application:
   ```bash
   php artisan serve
   ```

6. Access the application in your browser at `http://localhost:8000`.

## Usage
- **User**: Register and log in to book an appointment. After booking, check the confirmation status and proceed to payment if approved.
- **Admin**: Log in using predefined credentials to access the dashboard, manage appointments, and oversee the payment status.

---

This Clinic-Doctor Appointment Booking System is designed to enhance the efficiency of appointment scheduling in a clinic, providing both users and administrators with a streamlined, user-friendly experience.

PS: Its not compelety finished.
    You can download this project from the importing zip file and migrate for database.
