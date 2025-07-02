<?php
include '../conn.php';

session_start();
// Check if the SACCO is logged in
if (!isset($_SESSION['sacco_id'])) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit();
}
// Assume $conn is your database connection
$currentSaccoId = $_SESSION['sacco_id'];

// Fetch SACCO-specific information from the database
$query = "SELECT * FROM saccos WHERE sacco_id = '$currentSaccoId'";
$result = $conn->query($query);

// Fetch and display information
$saccoInformation = [];

while ($row = $result->fetch_assoc()) {
    // Store the fetched information in an array for display
    $saccoInformation[] = $row;
}
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BeBA bEBa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.lineicons.com/4.0/lineicons.css" />
   <script src="https://maps.googleapis.com/maps/api/js?key= AIzaSyCpstdF2iSB36LPIXVTRNIcsF-_YpTrejU"></script>

    <link rel="stylesheet" href="style.css">
  </head>
  <body>
  <div class="wrapper">
    <aside id="sidebar">
     <div class="d-flex">
      <button id="toggle-btn" type="button">
        <i class="lni lni-travel"></i>
      </button>
      <div class="sidebar-logo">
        <a href="#">BeBA bEBa</a>
      </div>
     </div> 
     <ul class="sidebar-nav">
      <li class="sidebar-item">
        <a href="#" class="sidebar-link has-dropdown collapsed" data-bs-toggle="collapse" data-bs-target="#Drivers" aria-expanded="false" aria-controls="Drivers">
        <i class="lni lni-car"></i>
          <span>Manage</span>
        </a>
        <ul id="Drivers" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar"> 
        <li class="sidebar-item">
        <a href="#" class="sidebar-link">
          <i class="lni lni-stop"></i>  
          <span> Manage Drivers </span>
         </a>
        </li>
        <li class="sidebar-item">
          <a href="#" class="sidebar-link">
          <i class="lni lni-stop"></i>  
          <span> Manage Matatus </span>
         </a>
        </li>
        </ul>
      </li>
      <li class="sidebar-item">
        <a href="#" class="sidebar-link has-dropdown collapsed" data-bs-toggle="collapse" data-bs-target="#auth" aria-expanded="false" aria-controls="auth">
        <i class="lni lni-grid-alt"></i>
        <span>Auth</span>
       </a>
       <ul id="auth" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar"> 
       <li class="sidebar-item">
        <a href="#Cars" class="sidebar-link">
          <i class="lni lni-agenda"></i>
          <span>ADD vehicles</span>
        </a>
      </li>
      <li class="sidebar-item">
        <a href="#Routes" class="sidebar-link">
          <i class="lni lni-popup"></i>
          <span>Manage routes</span>
        </a>
      </li>
    
        </ul>
      </li>
      <li class="sidebar-item">
        <a href="" class="sidebar-link" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">

        </a>
      </li>

     </ul>
     <div class="sidebar-footer">
        <a href="#" class="sidebar-link">
          <i class="lni lni-exit"></i>
          <span>logout</span>
        </a>
    
    </div>

    </aside> 
    <!----------nav-------------->
  <div class="main p-3" id="main">
    <nav class="navbar bg-body-tertiary">
      <div class="container-fluid">
        <form class="d-flex" role="search">
          <input class="form-control me-2" type="search"  aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
        <a class="user" href="#"> <i class="lni lni-user"></i>
          <span><?php foreach ($saccoInformation as $info): ?>
                <?php echo $info['Sacco_Name']; ?></li>
                <?php endforeach; ?>
          </span>
        </a>
      </div>
    </nav> 
 <!------------------------- main ----------->
  <div class="container mt-5">
      <h2 class="mb-4">SACCO Information Collection</h2>
      <form action="add_drivers.php" method="post">
          
            <!-- Driver Information -->
        <div id="Drivers">
            <h4 class="mt-4" id="Driver">Driver Information</h4>

            <div class="form-group">
                <label for="Driver_Name">Driver Name:</label>
                <input type="text" class="form-control" id="Driver_Name" name="Driver_Name" placeholder="Enter Driver Name" required>
            </div>

            <div class="form-group">
                <label for="driverLicense">Driver License Number:</label>
                <input type="text" class="form-control" id="driverLicense" name="License_Number" placeholder="Enter License Number" required>
            </div>

            <div class="form-group">
                <label for="contactNumber">Contact Number:</label>
                <input type="text" class="form-control" id="contactNumber" name="Contact_Number" placeholder="Enter Contact Number" required>
            </div>

            <div class="form-group">
                <label for="driverEmail">Email:</label>
                <input type="email" class="form-control" id="driverEmail" name="Email" placeholder="Enter Email" required>
            </div>

            <div class="form-group">
                <label for="driverAddress">Address:</label>
                <textarea class="form-control" id="driverAddress" name="Address" rows="3" placeholder="Enter Address" required></textarea>
            </div>
            <!-- <button type="button" class="btn btn-primary mb-3">Add Additional Driver </button> -->
        </div>
         <div id="Cars">
            <h4 class="mt-4" id="Car">Vehicle Information</h4>

            <div class="form-group">
                <label for="Matatu_Number">Matatu Number:</label>
                <input type="text" class="form-control" name="Matatu_Number" id="Matatu_Number" placeholder="Enter matatu Number" required>
            </div>

            <div class="form-group">
                <label for="car_Number_Plates">Car Number Plates:</label>
                <input type="text" class="form-control" name ="car_Number_Plates" id="car_Number_Plates" placeholder="Enter Number Plates" required>
            </div>
            <button type="submit" class="btn btn-success"  name="register" >Submit</button>
            <!--<button type="button" class="btn btn-primary mb-3">Add Additional Vehicle</button>-->
        </div>

      </form>
      
      <!-- Route Information -->
  <form action="add_route.php" method="post">
    <div id="Routes">
        <h4 class="mt-4" id="Route">Route Information</h4>

        <div class="form-group">
            <label for="startLocation">Starting Location:</label>
            <input type="text" class="form-control" id="startLocation" name="Start_Location" placeholder="Enter Starting Location" required>
        </div>

        <div class="form-group">
            <label for="endLocation">Ending Location:</label>
            <input type="text" class="form-control" id="endLocation" name="End_Location" placeholder="Enter Ending Location" required>
        </div>

        <div class="form-group">
            <label for="waypoints">Waypoints (if any):</label>
            <input type="text" class="form-control" id="waypoints" name="waypoints" placeholder="Enter Waypoints" required>
        </div>

        <div class="form-group">
            <label for="estimatedTime">Estimated_Time_In_Minutes</label>
            <input type="time" class="form-control" id="estimatedTime" name="Estimated_Time_In_Minutes" required>
        </div>
    </div>

  <div id="map"></div>

<button type="submit" class="btn btn-success" name="register">Submit</button>

<!-- Initialize Google Maps Autocomplete -->
<script>
    function initAutocomplete() {
        var startInput = document.getElementById('startLocation');
        var endInput = document.getElementById('endLocation');
        var waypointsInput = document.getElementById('waypoints');

        var autocompleteStart = new google.maps.places.Autocomplete(startInput);
        var autocompleteEnd = new google.maps.places.Autocomplete(endInput);
        var autocompleteWaypoints = new google.maps.places.Autocomplete(waypointsInput);
    }

    // Initialize the map when the page loads
    initAutocomplete();
</script>

  </div>
  </div>
     
 
<!-----------------section----------------->

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="script-sacco.js"></script>
  </body>


