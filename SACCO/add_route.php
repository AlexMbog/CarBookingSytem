<?php
include '../conn.php';
session_start();

// Check if the SACCO is logged in
if (!isset($_SESSION['sacco_id'])) {
    header("Location: login.php");
    exit();
}


$currentSaccoId = $_SESSION['sacco_id'];

function sanitizeInput($input) {
    return htmlspecialchars(strip_tags(trim($input)));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    print_r($_POST);

    // Collect driver information from the form
    // Sanitize input
    $Driver_Name = sanitizeInput($_POST['Driver_Name']);
    $Driver_License_Number = sanitizeInput($_POST['Driver_License_Number']);
    $Driver_Contact_Number = sanitizeInput($_POST['Driver_Contact_Number']);
    $Driver_Email_Address = sanitizeInput($_POST['Driver_Email_Address']);
    $Driver_Address = sanitizeInput($_POST['Driver_Address']);
    $Matatu_Number = sanitizeInput($_POST['Matatu_Number']);
    $Matatu_Number_Plates = sanitizeInput($_POST['Matatu_Number_Plates']);
    $route_Start_Location = sanitizeInput($_POST['route_Start_Location']);
    $route_End_Location = sanitizeInput($_POST['route_End_Location']);
    $route_waypoints = sanitizeInput($_POST['route_waypoints']);
    $route_Estimated_Time_In_MINUTES = sanitizeInput($_POST['route_Estimated_Time_In_MINUTES']);

$queryDriver = "INSERT INTO drivers (sacco_id, driver_name, Driver_License_Number, Driver_Contact_Number, Driver_Email_Address, Driver_Address) 
                    VALUES ('$currentSaccoId', '$Driver_Name', '$Driver_License_Number', '$Driver_Contact_Number', '$Driver_Email_Address', '$Driver_Address')";
    if ($conn->query($queryDriver) === TRUE) {
        echo "Driver record inserted successfully<br>";
    } else {
        echo "Error inserting driver record: " . $conn->error . "<br>";
    }

    
    $driverId = $conn->insert_id;
    echo "Driver ID: " . $driverId . "<br>";

   
    $queryMatatu = "INSERT INTO matatu (sacco_id, driver_id, matatu_number, Matatu_Number_Plates) 
                    VALUES ('$currentSaccoId', '$driverId', '$Matatu_Number', '$Matatu_Number_Plates')";
    if ($conn->query($queryMatatu) === TRUE) {
        echo "Matatu record inserted successfully<br>";
    } else {
        echo "Error inserting matatu record: " . $conn->error . "<br>";
    }


    $matatuId = $conn->insert_id;
    echo "Matatu ID: " . $matatuId . "<br>";

   
    $queryRoute = "INSERT INTO routes (sacco_id, matatu_id, route_Start_Location, route_End_Location, route_waypoints, route_Estimated_Time_In_MINUTES) 
                    VALUES ('$currentSaccoId', '$matatuId', '$route_Start_Location', '$route_End_Location', '$route_waypoints', '$route_Estimated_Time_In_MINUTES')";
    if ($conn->query($queryRoute) === TRUE) {
        echo "Route record inserted successfully<br>";
    } else {
        echo "Error inserting route record: " . $conn->error . "<br>";
    }

   
    $conn->close();


    header("Location: darshboard.php");
    exit();
}
?>
