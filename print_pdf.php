<?php
include '../conn.php';

session_start();

if (!isset($_SESSION['sacco_id'])) {
    header("Location: login_sacco.html"); 
    exit();
}

$currentSaccoId = $_SESSION['sacco_id'];


$query = "SELECT * FROM saccos WHERE sacco_id = '$currentSaccoId'";
$result = $conn->query($query);

$saccoInformation = [];

while ($row = $result->fetch_assoc()) {
    
    $saccoInformation[] = $row;
}
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BeBA bEBa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.lineicons.com/4.0/lineicons.css" />
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
  <div class="wrapper">
    <aside id="sidebar">
     <div class="d-flex">
      <button id="toggle-btn" type="button">
        <i class="lni lni-travel"></i>
      </button>
      <div class="sidebar-logo">
        <a href="#">BeBA bEBa</a>
      </div>
     </div> 
     <ul class="sidebar-nav">
     <li class="sidebar-item">
                    <a href="#" class="sidebar-link">
                        <i class="lni lni-agenda"></i>
                        <span>Task</span>
                    </a>
                </li>
      <li class="sidebar-item">
        <a href="#" class="sidebar-link has-dropdown collapsed" data-bs-toggle="collapse" data-bs-target="#manage" aria-expanded="false" aria-controls="manage">
        <i class="lni lni-car"></i>
          <span>Manage</span>
        </a>
        <ul id="manage" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar"> 
        <li class="sidebar-item">
        <a href="Manage.php" class="sidebar-link">
          <i class="lni lni-stop"></i>  
          <span> Manage Drivers </span>
         </a>
        </li>
        <li class="sidebar-item">
          <a href="Manage.php" class="sidebar-link">
          <i class="lni lni-stop"></i>  
          <span> Manage Matatus </span>
         </a>
        </li>
        </ul>
      </li>
      <li class="sidebar-item">
        <a href="Add_infor.php" class="sidebar-link has-dropdown collapsed" data-bs-toggle="collapse" data-bs-target="#auth" aria-expanded="false" aria-controls="auth">
        <i class="lni lni-grid-alt"></i>
        <span>ADD INFOR</span>
       </a>
       <ul id="auth" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar"> 
       <li class="sidebar-item">
        <a href="Add_infor.php" class="sidebar-link">
          <i class="lni lni-popup"></i>
          <span>Drivers</span>
        </a>
      </li>
       <li class="sidebar-item">
        <a href="#Cars" class="sidebar-link">
          <i class="lni lni-agenda"></i>
          <span>Matatus</span>
        </a>
      </li>
      <li class="sidebar-item">
        <a href="#Routes" class="sidebar-link">
          <i class="lni lni-popup"></i>
          <span>Routes</span>
        </a>
      </li>
    
        </ul>
        <li class="sidebar-item">
        <a href="#" class="sidebar-link has-dropdown collapsed" data-bs-toggle="collapse" data-bs-target="#manage_hrsrents" aria-expanded="false" aria-controls="manage">
        <i class="lni lni-car"></i>
          <span>Rentals and Hires</span>
        </a>
        <ul id="manage_hrsrents" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar"> 
        <li class="sidebar-item">
             <a href="Manage_hires.php" class="sidebar-link">
               <i class="lni lni-stop"></i>  
               <span>Manage Hires</span>
          </a>
          </li>
        <li class="sidebar-item">
          <a href="Manage_rental.php" class="sidebar-link">
          <i class="lni lni-stop"></i>  
          <span> Manage Rents</span>
         </a>
        </li>
        </ul>
      </li>
      </li>
      <li class="sidebar-item">
        <a href="" class="sidebar-link" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">

        </a>
      </li>

     </ul>
  
     <div class="sidebar-footer">
        <a href="#" class="sidebar-link">
          <i class="lni lni-exit"></i>
          <span>logout</span>
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
 <!------------------------- main ----------->
 
     
 
<!-----------------section----------------->

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="script-sacco.js"></script>
  </body>



</div><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">