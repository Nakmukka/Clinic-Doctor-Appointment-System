<!-- resources/views/payment/checkout.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Razorpay Payment</title>

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-primary text-white text-center">
                    <h4>Complete Payment for Appointment #{{ $appointment->id }}</h4>
                </div>
                <div class="card-body">
                    <p class="text-center">Amount Due: <strong>₹{{ $order->amount / 100 }}</strong></p>

                    <form id="payment-form" action="{{ route('payment.success') }}" method="POST">
                        @csrf
                        <input type="hidden" name="appointment_id" value="{{ $appointment->id }}">
                        <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id">
                        <button id="pay-button" type="button" class="btn btn-success btn-block">Pay with Razorpay</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Razorpay Script -->
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

<!-- Bootstrap and jQuery JS -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
    document.getElementById('pay-button').onclick = function () {
        var options = {
            "key": "{{ config('services.razorpay.key') }}",
            "amount": "{{ $order->amount }}",
            "currency": "{{ $order->currency }}",
            "name": "Your Clinic",
            "description": "Appointment Fee",
            "order_id": "{{ $order->id }}",
            "handler": function (response) {
                document.getElementById('razorpay_payment_id').value = response.razorpay_payment_id;
                document.getElementById('payment-form').submit();
            },
            "prefill": {
                "name": "{{ Auth::user()->name }}",
                "email": "{{ Auth::user()->email }}"
            },
            "theme": {
                "color": "#28a745"
            }
        };
        var rzp1 = new Razorpay(options);
        rzp1.open();
    };
</script>

</body>
</html>
