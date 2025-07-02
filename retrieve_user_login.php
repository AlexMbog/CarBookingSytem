<?php

include 'conn.php';

//variables to store user information
$userID = "";
$username = "";
$userNumber = ""; // Variable to store passenger name

//fetch user information by user ID if user is logged in
function getUserInfoIfLoggedIn($conn) {
    global $userID, $username, $userNumber; // Add $passengerName to global scope

    // Check if the user is logged in
    if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
        // Get the user ID of the logged-in user
        $userId = $_SESSION["User_ID"];

        $query = "SELECT * FROM users WHERE User_ID = '$userId'";
        $result = $conn->query($query);

        // Check if the query was successful
        if ($result && $result->num_rows > 0) {
            // Fetch user information
            $userInformation = $result->fetch_assoc();
            
            // Store user information in variables
            $userID = $userInformation['User_ID'];
            $username = $userInformation['User_Name'];
            // Get passenger name from user information
            $userNumber = $userInformation['User_Phone_Number'];
        } else {
            echo "User not found.";
        }
    } else {
      header("Location: user_login.php"); 
    }
}
getUserInfoIfLoggedIn($conn);
?>