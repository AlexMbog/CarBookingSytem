<?php
session_start();
include 'conn.php';


$query = "SELECT sacco_id, sacco_name FROM saccos";
$result = $conn->query($query);


if ($result && $result->num_rows > 0) {
    
    $saccos = [];


    while ($row = $result->fetch_assoc()) {
        $saccos[$row['sacco_id']] = $row['sacco_name'];
    }
} else {
    echo "No SACCOs found.";
}
?>