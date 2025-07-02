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

// Collect driver information from the form
$driverName = $_POST['Driver_Name'];
$licenseNumber = $_POST['License_Number'];
$contactNumber = $_POST['Contact_Number'];
$email = $_POST['Email'];
$address = $_POST['Address'];

// Insert driver information into the database
$driverQuery = "INSERT INTO drivers (sacco_id, driver_name, license_number, contact_number, email, address) 
                VALUES ('$currentSaccoId', '$driverName', '$licenseNumber', '$contactNumber', '$email', '$address')";

$conn->query($driverQuery);

// Get the generated driver_id
$driverId = $conn->insert_id;

// Collect vehicle information from the form
$matatuNumber = $_POST['Matatu_Number'];
$carNumberPlates = $_POST['car_Number_Plates'];

// Insert vehicle information into the database
$vehicleQuery = "INSERT INTO matatu (sacco_id, matatu_number, car_number_plates, driver_id) 
                 VALUES ('$currentSaccoId', '$matatuNumber', '$carNumberPlates', '$driverId')";

$conn->query($vehicleQuery);

// Close the database connection
$conn->close();

// Redirect to the dashboard or another page
header("Location: Add_infor.php");
exit();
?>
