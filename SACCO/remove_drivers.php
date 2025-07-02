<?php

include '../conn.php';

if (isset($_GET['driver_id'])) {
    
    $driver_id = mysqli_real_escape_string($conn, $_GET['driver_id']);

    $delete_matatu_query = "DELETE FROM matatu WHERE Matatu_driver_ID = '$driver_id'";
    
    if (mysqli_query($conn, $delete_matatu_query)) {
       
        $delete_driver_query = "DELETE FROM drivers WHERE driver_ID = '$driver_id'";
        
        if (mysqli_query($conn, $delete_driver_query)) {
            
            echo "<script>alert('Driver removed successfully.');</script>";
        } else {
            
            echo "<script>alert('Error: Could not remove driver from drivers table.');</script>";
        }
    } else {
       
        echo "<script>alert('Error: Could not remove associated records from matatu table.');</script>";
    }

    
    header("Location: display_drivers.php");
    exit();
} else {
  
    header("Location: display_drivers.php");
    exit();
}

mysqli_close($conn);
?>
