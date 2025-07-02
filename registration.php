<?php
include 'conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userName = $_POST["user_Name"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $phoneNumber = $_POST["phoneNumber"];
    $gender = $_POST["gender"];

    // Check for duplicates
    $duplicateCheckQuery = "SELECT User_Name,  User_Email FROM users WHERE User_Name = '$userName' OR  User_Email = '$email'";
    $duplicateResult = $conn->query($duplicateCheckQuery);

    if ($duplicateResult->num_rows > 0) {
        $existingUser = $duplicateResult->fetch_assoc();

        if ($existingUser['User_Name'] == $userName && $existingUser['User_Email'] == $email) {
            echo "Error: Username and email are already in use. Please choose different ones.";
        } elseif ($existingUser['User_Name'] == $userName) {
            echo "Error: Username is already in use. Please choose a different username.";
        } elseif ($existingUser['User_Email'] == $email) {
            echo "Error: Email is already in use. Please choose a different email.";
        }
    } else {
        // Insert new record
        $insertQuery = "INSERT INTO users (User_Name, User_Email, User_Password_Hash, User_Phone_Number, User_Gender) VALUES ('$userName', '$email', '$password', '$phoneNumber', '$gender')";

        if ($conn->query($insertQuery) === TRUE) {
            // Redirect to login page
            header("Location: user_login.php");
            exit();
        } else {
            echo "Error: " . $insertQuery . "<br>" . $conn->error;
        }
    }
}
?>

