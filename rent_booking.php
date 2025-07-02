<?php
session_start();
include 'conn.php';
require_once 'retrieve_user_login.php'; 

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $duration = $_POST['duration'];
    $numMatatus = $_POST['num_matatus'];

    // Insert the data into the database (replace with your database logic)
    $query = "INSERT INTO rental (user_id, duration, num_matatus) 
              VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("isi", $_SESSION['User_ID'], $duration, $numMatatus);
    if ($stmt->execute()) {
        // Rental successful, redirect to success page or do further processing
        header("Location: rental_success.php");
        exit;
    } else {
        // Error handling
        $error = "Error occurred while processing the rental.";
    }
}
?>

<html lang="en">
<head>
    <!-- Add your head content here -->
</head>
<body>
<div class="wrapper">
    <!-- Add sidebar content here -->
</div>
<div class="main p-2">
    <nav class="navbar bg-body-tertiary">
        <!-- Add navigation bar content here -->
    </nav>
    <div class="container text-center">
        <div class="container">
            <h1>Rent Matatus</h1>
            <p>Welcome, <?php echo $username; ?>!</p>
            <hr>
            <!-- Renting form for matatus -->
            <div class="container">
         <form action="process_rent_matatus.php" method="post">
        <div class="mb-3">
            <label for="duration" class="form-label">Duration</label>
            <select class="form-select" id="duration" name="duration" required>
                <option value="week">Week</option>
                <option value="month">Month</option>
                <!-- Add more options as needed -->
            </select>
        </div>
        <div class="mb-3">
            <label for="num_matatus" class="form-label">Number of Matatus</label>
            <input type="number" class="form-control" id="num_matatus" name="num_matatus" required>
        </div>
        <div class="mb-3">
                    <label for="location" class="form-label">Location</label>
                    <input type="text" class="form-control" id="location" name="location" required>
                </div>
        <input type="hidden" name="sacco_id" value="<?php echo $_SESSION['selectedSaccoId']; ?>">
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
            <!-- Display error message if any -->
            <?php if(isset($error)) { ?>
                <div class="alert alert-danger mt-3" role="alert"><?php echo $error; ?></div>
            <?php } ?>
        </div>
    </div>
</div>
</body>
</html>
