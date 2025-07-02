<?php
include '../conn.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $Sacco_Name = $_POST['Sacco_Name'];
    $Registration_Number = $_POST['Registration_Number'];

    $saccoQuery = "INSERT INTO saccos (Sacco_Name, Registration_Number) VALUES ('$Sacco_Name', '$Registration_Number')";
    $conn->query($saccoQuery);
   
    $conn->close();

    header("Location:login_sacco.html");
    exit();


}

?>
