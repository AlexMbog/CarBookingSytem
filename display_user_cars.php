<?php
include 'conn.php';  

$query = "SELECT * FROM drivers
                 JOIN matatu ON drivers.driver_id = matatu.matatu_driver_id
                 JOIN routes ON matatu.matatu_id = routes.route_matatu_id";

$result = $conn->query($query);


if ($result->num_rows > 0) {
    echo "<div class='row mt-3'>";
    while ($row = $result->fetch_assoc()) {
       
       
        $matatuNumber = $row['Matatu_Number_Plates'];
        $driverName = $row['Driver_Name'];
        $route_Start_Location = $row['route_Start_Location'];
        $route_End_Location = $row['route_End_Location'];
        $routePrice = $row['route_Price'];
        $matatuID = $row['Matatu_ID']; 

 
        echo "<div class='col-md-4'>
        <div class='card mb-3'>
            <div class='card-body text-center'>
                <h5 class='card-title'><span class='card-icon'><i class='fas fa-bus'></i></span> $matatuNumber </h5>
                <p class='card-text'>Driver's Name: $driverName</p>
                <p class='card-text'>Stage: $route_Start_Location</p>
                <p class='card-text'>Destination: $route_End_Location</p>
                <p class='card-text'>Price: $routePrice</p>
            </div>
            <div class='card-footer'>
                <form action='book.php' method='post'>
                    <input type='hidden' name='matatuID' value='$matatuID'>
                    <button type='submit' class='btn btn-primary mb-2' name='bookNow'>Book Now</button>
                </form>
            </div>
        </div>
    </div>";
}
 echo "</div>";
} else {
    // Handle the case where no rows are found
    echo "No drivers found in the database.";
}
?>
