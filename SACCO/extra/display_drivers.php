<?php
include '../conn.php';  // Include your database connection

// Check if the SACCO is logged in
if (!isset($_SESSION['sacco_id'])) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit();
}

$currentSaccoId = $_SESSION['sacco_id'];

// Retrieve driver information
$driverQuery = "SELECT * FROM drivers WHERE sacco_id = '$currentSaccoId'";
$driverResult = $conn->query($driverQuery);

// Display driver information
echo "<h2>Driver Information</h2>";
while ($row = $driverResult->fetch_assoc()) {
    echo "Driver Name: " . $row['Driver_Name'] . "<br>";
    echo "License Number: " . $row['License_Number'] . "<br>";
    // Add more fields as needed
    echo "<hr>";
}

// Close the database connection
$conn->close();
?>
