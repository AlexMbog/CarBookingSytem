<?php
include '../conn.php'; 

$query = "SELECT * FROM drivers
          JOIN matatu ON drivers.driver_id = matatu.Matatu_Driver_ID
          JOIN routes ON matatu.matatu_id = routes.route_matatu_id
          WHERE drivers.driver_sacco_id = '$currentSaccoId'";

$result = $conn->query($query);

echo "<div class='container mt-1'>";
echo "<h2>Driver, Matatu, and Route Information</h2>";

while ($row = $result->fetch_assoc()) {
    echo "<div class='card mb-3'>";
    echo "<div class='card-header'>Driver: " . $row['Driver_Name'] . "</div>";
    echo "<div class='card-body'>";
    echo "<p>Matatu Number: " . $row['Matatu_Number'] . "</p>";
    echo "<p>Car Number Plates: " . $row['Matatu_Number_Plates'] . "</p>";
    echo "<p>Starting Location: " . $row['route_Start_Location'] . "</p>";
    echo "<p>Ending Location: " . $row['route_End_Location'] . "</p>";

    echo "<a href='remove_drivers.php?driver_id=" . $row['Driver_ID'] . "' class='btn btn-danger'>Remove Driver</a>";
    echo "</div></div>";
}

echo "</div>";
?>
