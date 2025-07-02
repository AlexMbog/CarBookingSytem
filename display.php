<?php
// Assuming you have a database connection $conn

// Fetch data from the database
$matatusQuery = "SELECT * FROM matatu";
$matatusResult = $conn->query($matatusQuery);


while ($matatu = $matatusResult->fetch_assoc()) {
    $matatuID = $matatu['Matatu_ID'];
    $carName = $matatu['Car_Name'];
    $numberPlates = $matatu['Number_Plates'];

  
    $driverQuery = "SELECT * FROM drivers WHERE Matatu_ID = '$matatuID'";
    $driverResult = $conn->query($driverQuery);

    $routeQuery = "SELECT * FROM routes WHERE Matatu_ID = '$matatuID'";
    $routeResult = $conn->query($routeQuery);


    echo '<div class="card">';
    echo "<h3>Car Name: $carName</h3>";
    echo "<p>Number Plates: $numberPlates</p>";

    echo '<h4>Driver:</h4>';
    if ($driver = $driverResult->fetch_assoc()) {
        $driverName = $driver['Driver_Name'];
        $driverNumber = $driver['Contact_Number'];

        echo "<p>Driver Name: $driverName</p>";
        echo "<p>Driver Number: $driverNumber</p>";
    }

    echo '<h4>Route:</h4>';
    while ($route = $routeResult->fetch_assoc()) {
        $startLocation = $route['Starting_Location'];
        $endLocation = $route['Ending_Location'];
        $waypoints = $route['Waypoints'];
        $estimatedTime = $route['Estimated_Time'];

        echo "<p>Starting Location: $startLocation</p>";
        echo "<p>Ending Location: $endLocation</p>";
        echo "<p>Waypoints: $waypoints</p>";
        echo "<p>Estimated Time: $estimatedTime</p>";
    }

    echo '</div>'; 
}


$conn->close();
?>
