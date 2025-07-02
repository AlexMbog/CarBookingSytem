<?php
include '../conn.php';

session_start();


if (isset($_POST['login'])) {
    $saccoName = $_POST['Sacco_Name'];
    $registrationNumber = $_POST['Registration_Number'];

   
    $query = "SELECT sacco_id FROM saccos WHERE Sacco_Name = '$saccoName' AND sacco_Registration_Number = '$registrationNumber'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
       
        $row = $result->fetch_assoc();
        $_SESSION['sacco_id'] = $row['sacco_id'];
        header("Location: Darshboard.php"); e
        exit();
    } else {
       
        echo "Invalid SACCO credentials.";
    }
}
?>
