<?php
session_start();
include 'conn.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $userId = $_SESSION["User_ID"];
    $startDate = $_POST['start_date'];
    $endDate = $_POST['end_date'];
    $location = $_POST['location'];
    $occasion = $_POST['occasion'];
    $numMatatus = $_POST['num_matatus'];
    
    $saccoId = $_SESSION['selectedSaccoId'];

    
    $query = "INSERT INTO hires (hire_user_id, hire_start_date, hire_end_date, hire_location, hire_num_matatus, hire_occasion, sacco_id) 
              VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("isssisi", $userId, $startDate, $endDate, $location, $numMatatus, $occasion, $saccoId);
    
    if ($stmt->execute()) {
      
        header("Location: rental_success.php");
        exit;
    } else {
        $error = "Error occurred while processing the hire.";
    }

    $stmt->close();
}
?>
