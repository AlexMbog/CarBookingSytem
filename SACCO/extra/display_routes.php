<?php
include '../conn.php';  // Include your database connection

// Assume $conn is your database connection
session_start();

// Check if the SACCO is logged in
if (!isset($_SESSION['sacco_id'])) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit();
}

$currentSaccoId = $_SESSION['sacco_id'];

// Retrieve route information
$routeQuery = "SELECT * FROM routes WHERE sacco_id = '$currentSaccoId'";
$routeResult = $conn->query($routeQuery);

// Display route information
echo "<h2>Route Information</h2>";
while ($row = $routeResult->fetch_assoc()) {
    echo "Starting Location: " . $row['start_location'] . "<br>";
    echo "Ending Location: " . $row['end_location'] . "<br>";
    // Add more fields as needed
    echo "<hr>";
}

// Close the database connection
$conn->close();
?>
