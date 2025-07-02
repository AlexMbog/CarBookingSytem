<?php
include 'conn.php'; // Include your database connection file
session_start();
require_once 'retrieve_user_login.php';
require_once 'TCPDF-main/tcpdf.php';
// Check if SACCO admin is logged in
if (!isset($_SESSION['sacco_id'])) {
  
}

// Execute the SQL query to retrieve hire and rent details
$query = "
SELECT 
    h.hire_id AS transaction_id,
    'hire' AS transaction_type,
    h.hire_user_id AS user_id,
    u.User_Name AS user_name,
    u.User_Phone_Number AS user_phone_number,
    h.hire_start_date AS start_date,
    h.hire_end_date AS end_date,
    h.hire_location AS location,
    h.hire_num_matatus AS num_matatus,
    h.hire_occasion AS occasion,
    h.hire_approval_status AS status,
    h.hire_cost AS fee
FROM 
    hires h
JOIN 
    users u ON h.hire_user_id = u.User_ID
    UNION

SELECT 
    r.rental_id AS transaction_id,
    'rent' AS transaction_type,
    r.rental_user_id AS user_id,
    u.User_Name AS user_name,
    u.User_Phone_Number AS user_phone_number,
    r.rental_start_date AS start_date,
    r.rental_end_date AS end_date,
    r.rental_location AS location,
    r.rental_num_matatus AS num_matatus,
    NULL AS occasion,
    r.rental_approval_status AS status,
    r.rental_fee AS fee
FROM 
    rentals r
JOIN 
    users u ON r.rental_user_id = u.User_ID;
";

$result = $conn->query($query);

 // Close the database connection
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
                    <a href="Book.php" class="sidebar-link">
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
                        <span>My booking</span>
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
  
  <div class="row" id="Print-section">
    <?php
  if ($result->num_rows > 0) {
    ?>
    <div class="row">
        <div class="col">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Transaction ID</th>
                        <th>Transaction Type</th>
                        <th>User ID</th>
                        <th>User Name</th>
                        <th>User Phone Number</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Location</th>
                        <th>Number of Matatus</th>
                        <th>Occasion</th>
                        <th>Status</th>
                        <th>Fee</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Output data of each row
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <tr>
                            <td><?php echo $row["transaction_id"]; ?></td>
                            <td><?php echo $row["transaction_type"]; ?></td>
                            <td><?php echo $row["user_id"]; ?></td>
                            <td><?php echo $row["user_name"]; ?></td>
                            <td><?php echo $row["user_phone_number"]; ?></td>
                            <td><?php echo $row["start_date"]; ?></td>
                            <td><?php echo $row["end_date"]; ?></td>
                            <td><?php echo $row["location"]; ?></td>
                            <td><?php echo $row["num_matatus"]; ?></td>
                            <td><?php echo $row["occasion"]; ?></td>
                            <td><?php echo $row["status"]; ?></td>
                            <td><?php echo $row["fee"]; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
<?php } else {
    echo "No hires or rentals found.";
}
// Close the database connection
$conn->close();
?>
<div style="position: relative;" >
        
        <button class="btn btn-outline-success mt-2"  id="print-btn" type="button" onclick="generatePDF() ">Print PDF</button>
        
    </div>
</div>
</div>

<script type="text/javascript">

function generatePDF() {
    var printContents = document.getElementById("Print-section").innerHTML;
    var originalContents = document.body.innerHTML;

    document.body.innerHTML = printContents;

    window.print();

    document.body.innerHTML = originalContents;
}
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
<script src="script.js"></script>
</body>

</html>