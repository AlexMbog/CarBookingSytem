<?php
session_start();
include 'conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userId = $_SESSION["User_ID"];
    $duration = $_POST['duration'];
    $numMatatus = $_POST['num_matatus'];
    $location = $_POST['location'];
    $saccoId = $_POST['sacco_id']; 

    
    $startDate = date("Y-m-d");
    $endDate = '';
    if ($duration == 'week') {
        $endDate = date('Y-m-d', strtotime('+7 days', strtotime($startDate)));
    } elseif ($duration == 'month') {
        $endDate = date('Y-m-d', strtotime('+1 month', strtotime($startDate)));

    }

    $query = "INSERT INTO rentals (rental_user_id, rental_start_date, rental_end_date, rental_location, rental_num_matatus, sacco_id) 
              VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("isssii", $userId, $startDate, $endDate, $location, $numMatatus, $saccoId);

    if ($stmt->execute()) {
        
        header("Location: rental_success.php");
        exit;
    } else {
        $error = "Error occurred while processing the rental.";
    }

    $stmt->close();
}
?>
