<?php
session_start();
include '../conn.php';


if (!isset($_SESSION['sacco_id'])) {
    header("Location: login_sacco.html");
    exit();
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['rental_id']) && isset($_POST['rental_approval_status']) && isset($_POST['rental_price'])) {
    
    $rentalId = $_POST['rental_id'];
    $status = $_POST['rental_approval_status'];
    $price = $_POST['rental_price'];

    $query = "UPDATE rentals SET rental_approval_status = ?, rental_fee = ? WHERE rental_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sdi", $status, $price, $rentalId);
    
    
    if ($stmt->execute()) {
        echo "Status and price updated successfully."; 
    } else {
        echo "Error updating status and price: " . $conn->error;
    }

    $stmt->close();
} else {
   
    header("Location: rental_requests.php");
    exit();
}
?>
