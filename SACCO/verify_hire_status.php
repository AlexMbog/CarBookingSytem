<?php
include '../conn.php';
session_start();


if (!isset($_SESSION['sacco_id'])) {
    header("Location: login_sacco.html");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['hire_id']) && isset($_POST['hire_approval_status']) && isset($_POST['hire_price'])) {

    $hireId = $_POST['hire_id'];
    $status = $_POST['hire_approval_status'];
    $hirePrice = $_POST['hire_price'];

    $query = "UPDATE hires SET hire_approval_status = ?, hire_cost = ? WHERE hire_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sdi", $status, $hirePrice, $hireId);
    

    if ($stmt->execute()) {
        echo "Status and payment updated successfully.";
    } else {
        echo "Error updating status and payment: " . $conn->error; 
    }

   
    $stmt->close();
} else {
    
    header("Location: hires_requests.php");
    exit();
}
?>
