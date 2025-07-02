<?php
include 'conn.php'; 
require_once 'TCPDF-main/tcpdf.php';
if (isset($_GET['booking_id'])) {
    $bookingId = $_GET['booking_id'];

    $query = "SELECT b.*,m.Matatu_Number_Plates, d.Driver_Name, r.route_Price
              FROM bookings b
              JOIN matatu m ON b.booking_matatu_id = m.matatu_id
              JOIN drivers d ON m.matatu_driver_id = d.driver_id
              JOIN routes r ON m.matatu_id = r.route_matatu_id
              JOIN saccos s ON d.driver_sacco_id = s.sacco_id
              WHERE b.booking_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $bookingId);
    $stmt->execute();
    $result = $stmt->get_result();

   
    if ($result->num_rows > 0) {
        
        $booking = $result->fetch_assoc();
    } else {
        
        echo "Booking not found.";
    }

    
    $stmt->close();
    $conn->close();
} else {
    
    echo "Booking ID not provided.";
}
?>
<?php

session_start();
include 'conn.php';

$userID = "";
$username = "";


function getUserInfoIfLoggedIn($conn) {
    global $userID, $username; 


    if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
        
        $userId = $_SESSION["User_ID"];
        $query = "SELECT * FROM users WHERE User_ID = '$userId'";
        $result = $conn->query($query);

    
        if ($result && $result->num_rows > 0) {
           
            $userInformation = $result->fetch_assoc();  

            $userID = $userInformation['User_ID'];
            $username = $userInformation['User_Name'];
        } else {
            echo "User not found.";
        }
    } else {
        echo "User is not logged in.";
    }
}
getUserInfoIfLoggedIn($conn);
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BeBA bEBa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.lineicons.com/4.0/lineicons.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
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
                <a href="#" class="sidebar-link">
                    <i class="lni lni-exit"></i>
                    <span>Logout</span>
                </a>
            </div>
        </aside>
    
  <div class="main p-2">
    <!------- main------->
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
 
<!-----------------section----------------->
<div  onload="generatePDF()">
<div id="booking-section">
<button id="toggle-btn" type="button">
        <i class="lni lni-travel"></i>
      </button>
        <h1>my Bookings</h1>
        <hr>

    
        <p><strong>Matatu plate number:</strong> <?php echo $booking['Matatu_Number_Plates']; ?></p>
        <p><strong>Drivers Name:</strong> <?php echo $booking['Driver_Name']; ?></p>
        <p><strong>Customer Name:</strong> <?php echo $booking['booking_passenger_name']; ?></p>
        <p><strong>Booking ID:</strong> <?php echo $booking['Booking_id']; ?></p>
        <p><strong>Destination:</strong> <?php echo $booking['booking_destination']; ?></p>
        <p><strong>Location Name:</strong> <?php echo $booking['booking_location']; ?></p>
        <p><strong>Price Paid:</strong> <?php echo $booking['route_Price']; ?></p>

      </div>

        <button class="btn btn-outline-success mt-2" onclick="generatePDF()">Print</button>

    <script type="text/javascript">

        function generatePDF() {
            var printContents = document.getElementById("booking-section").innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;

            window.print();

            document.body.innerHTML = originalContents;
        }
    </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="SCRIPTS/script.js"></script>
  </body>

