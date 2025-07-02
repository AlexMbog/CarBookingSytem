
<?php
session_start();
include 'conn.php';
require_once 'retrieve_user_login.php';
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $bookingType = $_POST['booking_type'];
    if ($bookingType == 1) {
        
        header("Location: hire_matatu_booking.php");
        exit;
    } elseif ($bookingType == 2) {
    
        header("Location: home.php");
        exit;
    } elseif ($bookingType == 3) {
    
        header("Location: rent_booking.php");
        exit;
    } else {
      
        $error = "Invalid booking type selected.";
    }
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
    
 
<!-----------------section----------------->

<!-----------------section----------------->

    <div class="container text-center">
        <div class="container">
            <h1>Plan Bookings</h1>
            <p>Welcome, <?php echo $username; ?>!</p>
            <hr>
            
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="mb-3">
                    <label for="booking_type" class="form-label">Booking Type</label>
                    <select class="form-select" id="booking_type" name="booking_type">
                        <option value="1"> Hire Matatu</option>
                        <option value="2">Matatu Booking</option>
                        <option value="3">Rent Matatu</option>
                    </select>
                </div>
                
              
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
            
            <?php if(isset($error)) { ?>
                <div class="alert alert-danger mt-3" role="alert"><?php echo $error; ?></div>
            <?php } ?>
        </div>
    </div>
</div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="../SCRIPTS/script.js"></script>
  </body>


