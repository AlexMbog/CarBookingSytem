<?php

if(isset($_POST['matatuID'])) {
  
    $matatuID = $_POST['matatuID'];
    $query = "SELECT Matatu_Number_Plates FROM matatu WHERE Matatu_ID = $matatuID";
    $result = $conn->query($query);
    if($result) {
       
        $row = $result->fetch_assoc();
        $matatuNumber = $row['Matatu_Number_Plates'];
        echo json_encode(array('matatuNumber' => $matatuNumber));
    } else {
       
        echo json_encode(array('error' => 'Failed to fetch matatu number'));
    }
} else {
  
    echo json_encode(array('error' => 'Matatu ID not provided'));
}
?>
