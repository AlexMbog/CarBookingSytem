<?php
session_start(); 

include 'conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userName = $_POST["user_Name"];
    $password = $_POST["password"];

    $userQuery = "SELECT * FROM users WHERE User_Name = '$userName'";
    $userResult = $conn->query($userQuery);

    if ($userResult->num_rows > 0) {
        $userData = $userResult->fetch_assoc();

        // Verify the password
        if (password_verify($password, $userData['User_Password_Hash'])) {
            // Password is correct, set session variables to indicate user is logged in
            $_SESSION["loggedin"] = true;
            $_SESSION["User_ID"] = $userData['User_ID']; 
            // Redirect to the logged-in page
            header("Location: Home.php");
            exit();
        } else {
            echo "Error: Incorrect password.";
        }
    } else {
        echo "Error: User not found.";
    }
}
?>
