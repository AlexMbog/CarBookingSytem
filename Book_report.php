<?php
session_start();
include 'conn.php'; 
require_once 'TCPDF-main/tcpdf.php';
require_once 'retrieve_user_login.php';

if (isset($_GET['booking_id'])) {
    $bookingId = $_GET['booking_id'];

    $query = "SELECT b.*, r.route_Price
    FROM bookings b
    JOIN matatu m ON b.Booking_matatu_id = m.matatu_id
    JOIN drivers d ON m.matatu_driver_id = d.driver_id
    JOIN routes r ON m.matatu_id = r.route_matatu_id
    JOIN saccos s ON d.Driver_sacco_id = s.sacco_id
    WHERE b.booking_id = ?";


    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $bookingId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $booking = $result->fetch_assoc();
    } else {
      
        echo "Booking not found.";
        exit();
    }

    $stmt->close();
} else {

    echo "Booking ID not provided.";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beba beBA</title>
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    </div><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="wrapper">
        <aside id="sidebar">
            <div class="d-flex">
                <button class="toggle-btn" type="button">
                  <i class="lni lni-travel"></i>
                </button>
                <div class="sidebar-logo">
                  <a href="Home.php">BeBA bEBa</a>
                </div>
            </div>
            <ul class="sidebar-nav">
                <li class="sidebar-item">
                    <a href="Home.php" class="sidebar-link">
                       <i class="lni lni-car"></i>
                        <span>Home</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="Book_A_Ride.php" class="sidebar-link">
                        <i class="lni lni-agenda"></i>
                        <span>Book a Ride</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                        data-bs-target="#auth" aria-expanded="false" aria-controls="auth">
                        <i class="lni lni-protection"></i>
                        <span>Auth</span>
                    </a>
                    <ul id="auth" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                            <a href="user_login.php" class="sidebar-link">Login</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="user_register.php" class="sidebar-link">Register</a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a href="select_sacco_book.php" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                        data-bs-target="#multi" aria-expanded="false" aria-controls="multi">
                        <i class="lni lni-layout"></i>
                        <span>My bookings</span>
                    </a>
                    <ul id="multi" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                            <a href="#" class="sidebar-link collapsed" data-bs-toggle="collapse"
                                data-bs-target="#multi-two" aria-expanded="false" aria-controls="multi-two">
                                Two Links
                            </a>
                            <ul id="multi-two" class="sidebar-dropdown list-unstyled collapse">
                                <li class="sidebar-item">
                                    <a href="mybookings.php" class="sidebar-link">My booking</a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="#" class="sidebar-link">Link 2</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a href="select_sacco_book.php" class="sidebar-link">
                        <i class="lni lni-popup"></i>
                        <span>Plan booking</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="rental_success.php" class="sidebar-link">
                        <i class="lni lni-cog"></i>
                        <span>My rental status</span>
                    </a>
                </li>
            </ul>
            <div class="sidebar-footer">
                <a href="logout.php" class="sidebar-link">
                    <i class="lni lni-exit"></i>
                    <span>Logout</span>
                </a>
            </div>
        </aside>
    <div class="main p-3">
    <nav class="navbar bg-body-tertiary">
      <div class="container-fluid">
        <form class="d-flex" role="search">
          <input class="form-control me-2" type="search"  aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
        <a class="user" href="#"> <i class="lni lni-user"></i>
          <span><?php echo $username; ?></span>
        </a>
      </div>
    </nav>

<div class="report-container">
    <div>
        <!-- Add a Print Button -->
        <button class="btn btn-outline-success" id="print-btn" type="button" onclick="generatePDF()">Print PDF</button>
        
    </div>
    <div id="booking-section">
    <button id="toggle-btn" type="button">
        <i class="lni lni-travel"></i>
      </button>
        <h1>Complete Booking</h1>
        <hr>
        <p><strong>Customer Name:</strong> <?php echo $booking['booking_passenger_name']; ?></p>
        <p><strong>Booking ID:</strong> <?php echo $booking['Booking_id']; ?></p>
        <p><strong>Destination:</strong> <?php echo $booking['booking_destination']; ?></p>
        <p><strong>Location Name:</strong> <?php echo $booking['booking_location']; ?></p>
        <p><strong>Price Paid:</strong> <?php echo $booking['route_Price']; ?></p>

        <!-- 
        <form action="https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest" method="post">
            <input type="hidden" name="booking_id" value="<?php echo $booking['Booking_id']; ?>">
            <button type="submit" class="btn btn-success">Lipa na M-Pesa</button>
        </form>
        -->
        </div>


<button id="checkout-btn" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#checkoutModal">Checkout</button>

<div class="modal fade" id="checkoutModal" tabindex="-1" aria-labelledby="checkoutModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="checkoutModalLabel">Payment Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              
                <form id="payment-form">
                    <label for="payment-method">Select Payment Method:</label>
                    <select id="payment-method" name="payment-method">
                        <option value="mpesa">Lipa na M-Pesa</option>
                        <option value="bank">Bank Transfer</option>
                    </select>
                   
                    <div id="mpesa-details" style="display:none;">
                        <label for="mpesa-number">M-Pesa Number:</label>
                        <input type="text" id="mpesa-number" name="mpesa-number">
                    </div>
                  
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="processPayment()">Process Payment</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

function generatePDF() {
    var printContents = document.getElementById("booking-section").innerHTML;
    var originalContents = document.body.innerHTML;

    document.body.innerHTML = printContents;

    window.print();

    document.body.innerHTML = originalContents;
}
</script>

<script type="text/javascript">
    function processPayment() {
        // Process payment here
        // You can use AJAX to send payment details to the server for processing
    }

    // Show/hide additional fields based on the selected payment method
    document.getElementById('payment-method').addEventListener('change', function() {
        var paymentMethod = this.value;
        if (paymentMethod === 'mpesa') {
            document.getElementById('mpesa-details').style.display = 'block';
        } else {
            document.getElementById('mpesa-details').style.display = 'none';
        }
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="SCRIPTS/script.js"></script>  
</body>
</html>
