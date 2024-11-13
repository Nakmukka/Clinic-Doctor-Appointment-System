<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dr. Sanu Joseph</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="{{ route('admin.login') }}">Dr. Sanu Clinic</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item"><a class="nav-link" href="#home">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
            <li class="nav-item"><a class="nav-link" href="#appointment-form">Book Appointment</a></li>
            <li class="nav-item"><a class="nav-link" href="#bookings">My Bookings</a></li>
            <li class="nav-item"><a class="nav-link" href="#contacts">Contact</a></li>
            <!-- Check if user is authenticated -->
            @guest
                <!-- Show Login/Register when user is not logged in -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">Login</a>
                </li>
            @else
                <!-- Show Welcome message and Logout when user is logged in -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
                        Welcome, {{ Auth::user()->name }}
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li>
                            <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Logout
                            </a>
                        </li>
                    </ul>
                </li>
            @endguest
        </ul>
    </div>
</nav>
<!-- Logout Form -->
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>
<!-- Carousel -->
<div id="home" id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img class="d-block w-100" src="{{ asset('images/pic3.jpg') }}" alt="First slide">
            <div class="carousel-caption d-none d-md-block">
                <h5>Welcome to Our Clinic</h5>
                <p>High-quality care for you and your family</p>
            </div>
        </div>
        
        <div class="carousel-item">
            <img src="{{ asset('images/pic2.jpg') }}" class="d-block w-100" alt="Second Slide">
            <div class="carousel-caption d-none d-md-block">
                <h5>Your Health, Our Priority</h5>
                <p>From routine checkups to specialized consultations, we are here to provide you with the best healthcare solutions.</p>
            </div>
        </div>

    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>

<!-- About Section -->
<div id="about" class="container my-5">
    <div class="about-section text-center">

        <h2>About Us</h2>
        <p>Welcome to <b>Dr. Sanu Joseph's Clinic</b>, 
            where compassionate, patient-centered care meets convenience and expertise. 
            Our experienced doctors provide a range of medical services, from routine check-ups to specialized treatments, in a state-of-the-art facility.
             With a focus on building trusted relationships, we make scheduling easy and ensure you receive personalized care for every health need.
              Book an appointment today to experience healthcare that puts you first.</p>
    </div>
</div>

<!-- Appointment Form Section -->

<div   class="container mt-5">
<h2 class="text-center mb-4">Book Your Appointment</h2>
    
    <!-- Alert message placeholder -->
    <div id="alert-message" class="alert alert-info" style="display: none;">
        Sending request... Please wait for confirmation.
    </div>
    
    <form id="appointment-form" method="POST" action="{{ route('appointments.book') }}">
        @csrf

        <!-- User Name (pre-filled, non-editable) -->
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ Auth::user()->name }}" readonly>
        </div>
        <!-- Blood Type Selection -->
        <div class="form-group">
            <label for="blood_type">Blood Type</label>
            <select id="blood_type" name="blood_type" class="form-control" required>
                <option value="" disabled selected>Select your blood type</option>
                <option value="A+">A+</option>
                <option value="A-">A-</option>
                <option value="B+">B+</option>
                <option value="B-">B-</option>
                <option value="O+">O+</option>
                <option value="O-">O-</option>
                <option value="AB+">AB+</option>
                <option value="AB-">AB-</option>
            </select>
        </div>
    
        <!-- Appointment Date (restricted to today) -->
        <div class="form-group">
            <label for="date">Date</label>
            <input type="date" id="date" name="date" class="form-control" value="{{ date('Y-m-d') }}" min="{{ date('Y-m-d') }}" max="{{ date('Y-m-d') }}" required>
        </div>

        <!-- Time Selection -->
        <div class="form-group">
            <label for="time">Select Time</label>
            <select id="time" name="time" class="form-control" required>
                <!-- Populate time slots dynamically -->
                <option value="" disabled selected>Select a time</option>
                <!-- Populate time slots dynamically -->
                <option value="09:00">09:00 AM</option>
                <option value="10:00">10:00 AM</option>
                <option value="11:00">11:00 AM</option>
                <option value="12:00">12:00 PM</option>
                <option value="01:00">01:00 PM</option>
                <option value="02:00">02:00 PM</option>
                <option value="03:00">03:00 PM</option>
                <option value="04:00">04:00 PM</option>
                <option value="05:00">05:00 PM</option>
            </select>
        </div>

        <!-- Health Condition -->
        <div class="form-group">
            <label for="health_condition">Describe Health Condition</label>
            <textarea id="health_condition" name="health_condition" class="form-control" rows="4" placeholder="Describe your health condition" required></textarea>
        </div>

        

        <button type="submit" class="btn btn-primary btn-block">Book Appointment</button>
    </form>
    
</div>
<script>
    document.getElementById('appointment-form').addEventListener('submit', function() {
        // Show the alert message when the form is submitted
        document.getElementById('alert-message').style.display = 'block';
    });
</script>



<!-- Booking Details Table -->
<h2 id="bookings" class="text-center mt-4">My Bookings</h2>

    @if($appointments->isEmpty())
        <p>No appointments have been booked yet.</p>
    @else
        <table class="table table-striped mt-3">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Health Condition</th>
                    <th>Blood Type</th>
                    <th>Appointment Status</th>
                    <th>Payment status</th> <!-- New column for payment action -->
                    <th>Make Payment</th>
                    <th>Action</th>
                    

                </tr>
            </thead>
            <tbody>
                @foreach($appointments as $appointment)
                    <tr>
                        <td>{{ $appointment->date }}</td>
                        <td>{{ $appointment->time }}</td>
                        <td>{{ $appointment->health_condition }}</td>
                        <td>{{ $appointment->blood_type }}</td>
                        <td>
                            @if($appointment->confirmation_status === 'confirmed')
                                Confirmed
                            @else
                                Pending
                            @endif
                        </td>
            
                        <td>{{ $appointment->payment_status }}</td>
                        <td>
                            @if($appointment->payment_status == 'Pending')
                                <form action="{{ route('payment.process', $appointment->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-success">Mark as Paid</button>
                                </form>
                            @else
                                <span class="text-success">Paid</span>
                            @endif
                        </td>
                         <td>
                    @if($appointment->status !== 'Canceled')
                        <form action="{{ route('appointments.cancel', $appointment->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to cancel this appointment?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Cancel</button>
                        </form>
                    @else
                        <span class="text-muted">Canceled</span>
                    @endif
                </td>
                
            </tr>
                @endforeach
            </tbody>
        </table>
    @endif
    
</div>


<!-- Footer -->
<footer class="bg-light text-center text-lg-start">
    <div id="contacts" class="container p-4">
        <div class="row">
            <div class="col-lg-6 col-md-12 mb-4">
                <h5>Contact Us</h5>
                <p>Phone: +123 456 7890</p>
                <p>Email: info@drsanuclinic.com</p>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <h5>Follow Us</h5>
                <ul class="list-unstyled">
                    <li><a href="#" class="text-dark">Facebook</a></li>
                    <li><a href="#" class="text-dark">Twitter</a></li>
                    <li><a href="#" class="text-dark">Instagram</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
        © 2024 Dr. Sanu Clinic. All Rights Reserved.
    </div>
</footer>

<!-- Bootstrap JS and jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<!-- Bootstrap CSS -->
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<!-- Bootstrap JS and dependencies -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
</body>
</html>