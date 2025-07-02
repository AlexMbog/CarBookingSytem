<?php
require_once 'process_sacco.php'; 
require_once 'retrieve_user_login.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the selected SACCO ID
    $selectedSaccoId = $_POST['saccoSelect'];
    
    // Store the selected SACCO ID in session
    $_SESSION['selectedSaccoId'] = $selectedSaccoId;
    
    // Redirect to the book_plan.php page
    header("Location: book_plan.php");
    exit;
}
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Beba beba</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.lineicons.com/4.0/lineicons.css" />
    <link rel="stylesheet" href="SACCO/home_style.css">
  </head>
  <body>
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
                        <span>My Bookings</span>
                    </a>
                    <ul id="multi" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                            <a href="#" class="sidebar-link collapsed" data-bs-toggle="collapse"
                                data-bs-target="#multi-two" aria-expanded="false" aria-controls="multi-two">
                                Two Links
                            </a>
                            <ul id="multi-two" class="sidebar-dropdown list-unstyled collapse">
                                <li class="sidebar-item">
                                    <a href="mybookings.php" class="sidebar-link">My bookings</a>
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
<div class="container mt-3">
    <h4 class="mb-1"></h4>
    <div class="card">
        <div class="card-header">
            Booking Details
        </div>
        <div class="card-body">
            <form action="" method="post">
                <!-- Dropdown to select SACCO -->
                <div class="form-group">
                    <label for="saccoSelect">Select SACCO:</label>
                    <select class="form-control" id="saccoSelect" name="saccoSelect">
                        <!-- Display SACCO options retrieved from the database -->
                        <?php foreach ($saccos as $saccoId => $saccoName) { ?>
                            <option value="<?php echo $saccoId; ?>"><?php echo $saccoName; ?></option>
                        <?php } ?>
                    </select>
                </div>
                
                <button type="submit" class="btn btn-primary mt-2">Select Now</button>
            </form>
        </div>
    </div>
</div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="SCRIPTS/script.js"></script>
  </body>




