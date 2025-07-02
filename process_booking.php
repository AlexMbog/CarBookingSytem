<?php
session_start();
include 'conn.php';  


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
    $matatuID = $_POST['matatuSelect'];
    $numSeats = $_POST['numSeats'];
    $passengerName = $_POST['passengerName'];
    $contactNumber = $_POST['contactNumber'];
    $shareLocation = isset($_POST['shareLocation']) ? 1 : 0; 
    $locationInput = $_POST['locationInput']; 
    $destinationInput = $_POST['destinationInput']; 
    
    
    $query = "INSERT INTO bookings (booking_user_id, booking_matatu_id, booking_num_seats, booking_passenger_name, booking_contact_number, booking_share_location, booking_location, booking_destination, booking_payment_status)
              VALUES (?, ?, ?, ?, ?, ?, ?, ?, 0)"; 
    
    $stmt = $conn->prepare($query);
    
   
    $stmt->bind_param("iiisssss", $userID, $matatuID, $numSeats, $passengerName, $contactNumber, $shareLocation, $locationInput, $destinationInput );

    $userID = $_SESSION['User_ID'];
    
 
    if ($stmt->execute()) {
     
        $bookingID = mysqli_insert_id($conn);
        
        header("Location: Book_report.php?booking_id=$bookingID");

      
        
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
    
   
    $stmt->close();
  
    $conn->close();
}
?>
