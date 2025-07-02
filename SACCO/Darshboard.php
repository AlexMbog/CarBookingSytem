<?php
include '../conn.php';

session_start();
/
if (!isset($_SESSION['sacco_id'])) {
    header("Location: login_sacco.html"); 
}

$currentSaccoId = $_SESSION['sacco_id'];


$query = "SELECT * FROM saccos WHERE sacco_id = '$currentSaccoId'";
$result = $conn->query($query);


$saccoInformation = [];

while ($row = $result->fetch_assoc()) {
    
    $saccoInformation[] = $row;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beba beBA</title>
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="wrapper">
        <aside id="sidebar">
            <div class="d-flex">
                <button class="toggle-btn" type="button">
                  <i class="lni lni-travel"></i>
                </button>
                <div class="sidebar-logo">
                   <a href="#">BeBA bEBa</a>
                </div>
            </div>
            <ul class="sidebar-nav">
                <li class="sidebar-item">
                    <a href="bookings.php" class="sidebar-link">
                    <i class="lni lni-car-alt"></i>
                        <span>Bookings</span>
                    </a>
                </li>
               
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                        data-bs-target="#auth" aria-expanded="false" aria-controls="auth">
                        <i class="lni lni-stop"></i>  
                        <span>Manage </span>
                    </a>
                    <ul id="auth" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                            <a href="Manage.php" class="sidebar-link">Manage Drivers </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="Manage.php" class="sidebar-link">Manage Matatus</a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                        data-bs-target="#multi" aria-expanded="false" aria-controls="multi">
                        <i class="lni lni-layout"></i>
                        <span>ADD INFOR</span>
                    </a>
                    <ul id="multi" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                            <a href="#" class="sidebar-link collapsed" data-bs-toggle="collapse"
                                data-bs-target="#multi-two" aria-expanded="false" aria-controls="multi-two">
                                ADD INFOR
                            </a>
                            <ul id="multi-two" class="sidebar-dropdown list-unstyled collapse">
                                <li class="sidebar-item">
                                    <a href="Add_infor.php" class="sidebar-link">Drivers</a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="#Cars" class="sidebar-link">Matatus</a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="#Routes" class="sidebar-link">Routes</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a href="Manage_hires.php" class="sidebar-link">
                    <i class="lni lni-stop"></i>  
                    <span> Manage Hires </span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="Manage_rental.php" class="sidebar-link">
                     <i class="lni lni-stop"></i>  
                       <span> Manage Rents</span>
                    </a>
                </li>
            </ul>
            <div class="sidebar-footer">
                <a href="#" class="sidebar-link">
                    <i class="lni lni-exit"></i>
                    <span>Logout</span>
                </a>
            </div>
        </aside>
        <!----------nav-------------->
  <div class="main p-3" id="main">
    <nav class="navbar bg-body-tertiary">
      <div class="container-fluid">
        <form class="d-flex" role="search">
          <input class="form-control me-2" type="search"  aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
        <a class="user" href="#"> <i class="lni lni-user"></i>
          <span><?php foreach ($saccoInformation as $info): ?>
                <?php echo $info['Sacco_Name']; ?></li>
                <?php endforeach; ?>
          </span>
        </a>
      </div>
    </nav> 
    <div>
        <h1>
            Sacco Darshboard
        </h1>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
    <script src="script-sacco.js"></script>
</body>

</html>