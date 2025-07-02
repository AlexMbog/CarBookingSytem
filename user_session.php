<?php
// Start the session
session_start();

// Include your database connection file
include 'conn.php';
echo "Session loggedin: " . ($_SESSION["loggedin"] ?? "not set");

// Function to fetch user information by user ID if user is logged in
function getUserInfoIfLoggedIn($conn) {
    // Check if the user is logged in
    if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
        // Get the user ID of the logged-in user
        $userId = $_SESSION["User_ID"];

        // Prepare and execute the SQL query
        $query = "SELECT * FROM users WHERE User_ID = '$userId'";
        $result = $conn->query($query);

        // Check if the query was successful
        if ($result && $result->num_rows > 0) {
            // Fetch the user information
           
            $userInformation = $result->fetch_assoc();
            // Display user information
            echo "User found. User ID: " . $userInformation['User_ID'] . ", Username: " . $userInformation['User_Name'];
        } else {
            echo "User not found.";
        }
    } else {
        echo "User is not logged in.";
    }
}

// Call the function to fetch and display user information
getUserInfoIfLoggedIn($conn);

?>
