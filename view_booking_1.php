<?php
include 'conn.php'; // Include your database connection file

// Check if booking ID is provided in the URL
if (isset($_GET['booking_id'])) {
    $bookingId = $_GET['booking_id'];

    // Query to retrieve booking details
    $query = "SELECT * FROM bookings WHERE booking_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $bookingId);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the booking exists
    if ($result->num_rows > 0) {
        // Fetch booking details
        $booking = $result->fetch_assoc();
        // Display booking details in HTML below
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Details</title>
</head>
<body>
    <h1>Booking Details</h1>
    <p><strong>Booking ID:</strong> <?php echo $booking['booking_id']; ?></p>
    <p><strong>Number of Seats:</strong> <?php echo $booking['booking_num_seats']; ?></p>
    <p><strong>Passenger Name:</strong> <?php echo $booking['booking_passenger_name']; ?></p>
    <!-- Add more details as needed -->

    <!-- Example back link to go back to previous page -->
    <a href="javascript:history.go(-1)">Go Back</a>
</body>
</html>
<?php
        // End of HTML content after displaying booking details
    } else {
        echo "Booking not found.";
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    echo "Booking ID not provided.";
}
?>
