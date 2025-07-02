<?php
session_start();
include '../conn.php';
require_once '../TCPDF-main/tcpdf.php';
if (!isset($_SESSION['sacco_id'])) {
    header("Location: login.php"); 
    exit();
}

$currentSaccoId = $_SESSION['sacco_id'];
$query = "SELECT * FROM saccos WHERE sacco_id = '$currentSaccoId'";
$result = $conn->query($query);
$saccoInformation = [];

while ($row = $result->fetch_assoc()) {
    $saccoInformation[] = $row;
}
$query = "SELECT b.booking_id, b.booking_time, b.booking_passenger_name, b.booking_contact_number, b.booking_location
          FROM bookings b
          JOIN matatu m ON b.Booking_matatu_id = m.matatu_id
          JOIN drivers d ON m.matatu_Driver_ID = d.driver_id
          JOIN routes r ON m.matatu_id = r.route_matatu_id
          JOIN saccos s ON d.Driver_sacco_ID= s.sacco_id";

$result = $conn->query($query);
$resultBookings = $conn->query($query);
if (!$resultBookings) {
    // Query execution failed, output error message and SQL query for debugging
    echo "Error executing the query: " . $conn->error;
    echo "SQL Query: " . $query;
    exit(); // Stop further execution
}

// Fetch data only if the query executed successfully
$bookingLocations = [];

while ($booking = $resultBookings->fetch_assoc()) {
    $bookingLocations[] = $booking['booking_location'];
}

$conn->close();
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beba beBA</title>
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
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
                   <a href="#">BeBA bEBa</a>
                </div>
            </div>
            <ul class="sidebar-nav">
                <li class="sidebar-item">
                    <a href="bookings.php" class="sidebar-link">
                    <i class="lni lni-car-alt"></i>
                        <span>Bookings</span>
                    </a>
                </li>
               
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                        data-bs-target="#auth" aria-expanded="false" aria-controls="auth">
                        <i class="lni lni-stop"></i>  
                        <span>Manage </span>
                    </a>
                    <ul id="auth" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                            <a href="Manage.php" class="sidebar-link">Manage Drivers </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="Manage.php" class="sidebar-link">Manage Matatus</a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                        data-bs-target="#multi" aria-expanded="false" aria-controls="multi">
                        <i class="lni lni-layout"></i>
                        <span>ADD INFOR</span>
                    </a>
                    <ul id="multi" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                            <a href="#" class="sidebar-link collapsed" data-bs-toggle="collapse"
                                data-bs-target="#multi-two" aria-expanded="false" aria-controls="multi-two">
                                ADD INFOR
                            </a>
                            <ul id="multi-two" class="sidebar-dropdown list-unstyled collapse">
                                <li class="sidebar-item">
                                    <a href="Add_infor.php" class="sidebar-link">Drivers</a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="#Cars" class="sidebar-link">Matatus</a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="#Routes" class="sidebar-link">Routes</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a href="Manage_hires.php" class="sidebar-link">
                    <i class="lni lni-stop"></i>  
                    <span> Manage Hires </span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="Manage_rental.php" class="sidebar-link">
                     <i class="lni lni-stop"></i>  
                       <span> Manage Rents</span>
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


<div class="container mt-2" id="map" style="height: 400px; width: 80%;  border: 2px solid #ccc;  border-radius: 5px; overflow: hidden; "><iframe src="https//www.google.com/maps?q=<?php echo $row["latitude"]; ?>, <?php echo $row["longtude"]; ?>&hl=es;z-14&output=embed"></iframe></div>   
<div class="row" id="Print-section">
<h1>Booking Details</h1> 
            <div class="col">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Booking Time</th>
                            <th>Passenger Name</th>
                            <th>Contact Number</th>
                            <th>Location</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result->num_rows > 0) {
                            while ($booking = $result->fetch_assoc()) {
                                echo "<tr>
                                        <td>{$booking['booking_time']}</td>
                                        <td>{$booking['booking_passenger_name']}</td>
                                        <td>{$booking['booking_contact_number']}</td>
                                        <td>{$booking['booking_location']}</td>
                                      </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5'>No bookings found.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div>
        <!-- Add a Print Button -->
        <button class="btn btn-outline-success mt-2"  id="print-btn" type="button" onclick="generatePDF() ">Print PDF</button>
</div>
   </div>
<!-----------------section----------------->


    <!-- Include the map JavaScript API -->
    <script type="text/javascript">

function generatePDF() {
    var printContents = document.getElementById("Print-section").innerHTML;
    var originalContents = document.body.innerHTML;

    document.body.innerHTML = printContents;

    window.print();

    document.body.innerHTML = originalContents;
}
</script>
<script async
    src="https://maps.googleapis.com/maps/api/js?v=weekly
        &key=AIzaSyDqxkVNBaZfNUN6wRDi7z_IM0W0mDHWCwQ&callback=initMap">
</script>
    <script>
function initMap() {
    var map = new google.maps.Map(document.getElementById("map"), {
        zoom: 12,
        center: { lat: 0, lng: 0 },
    });

    var geocoder = new google.maps.Geocoder();
    
    <?php foreach ($bookingLocations as $location): ?>
        geocoder.geocode({ address: "<?php echo $location; ?>" }, function (results, status) {
            if (status === "OK" && results[0]) {
                var latLng = results[0].geometry.location;
                new google.maps.Marker({
                    position: latLng,
                    map: map,
                });
                map.setCenter(latLng);
            } else {
                console.error("Geocode was not successful for the following reason: " + status);
                console.error("Problematic address: <?php echo $location; ?>");
            }
        });
    <?php endforeach; ?>
}

    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
    <script src="script-sacco.js"></script>
</body>

</html>