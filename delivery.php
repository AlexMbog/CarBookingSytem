<?php
session_start();
include 'conn.php'; 

if (isset($_GET['booking_id'])) {
    $bookingId = $_GET['booking_id'];
    

    $query = "SELECT b.*, r.route_Price
    FROM bookings b
    JOIN matatu m ON b.matatu_id = m.matatu_id
    JOIN drivers d ON m.driver_id = d.driver_id
    JOIN routes r ON m.matatu_id = r.matatu_id
    JOIN saccos s ON d.sacco_id = s.sacco_id
    WHERE b.booking_id = ?";
    
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $bookingId);
    $stmt->execute();
    $result = $stmt->get_result();

    
    if ($result->num_rows > 0) {
        
        $booking = $result->fetch_assoc();
        
        $stmt->close();
    } else {
       
        echo "Booking not found.";
        exit();
    }
} else {
    echo "Booking ID not provided.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Driver Delivery</title>
</head>
<body>
    <h1>Booking Details for Delivery</h1>
    <div id="map" style="height: 400px; width: 100%;"></div>
    <?php

    echo "<p><strong>Booking Time:</strong> " . $booking['booking_time'] . "</p>";
    echo "<p><strong>Passenger Name:</strong> " . $booking['booking_passenger_name'] . "</p>";
    echo "<p><strong>Contact Number:</strong> " . $booking['booking_contact_number'] . "</p>";
    echo "<p><strong>Contact Number:</strong> " . $booking['booking_location'] . "</p>";
    ?>



    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD0_el1E0JmHVvopFNDaPYMIc1UY1PgKgA&callback=initMap&v=weekly"
      defer> </script>
        <script src="map.js"></script>
       
</body>
</html>
