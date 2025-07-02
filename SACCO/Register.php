<?php
include '../conn.php';
session_start();

if (!isset($_SESSION['sacco_id'])) {
    header("Location: login.php"); 
    exit();
}

$currentSaccoId = $_SESSION['sacco_id'];
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
        <a href="Drivers.php" class="sidebar-link">
          <i class="lni lni-user"></i>
          <span>Register</span>
        </a>
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
<body>
  <div class="main p-3" id="main">
    <nav class="navbar bg-body-tertiary">
      <div class="container-fluid">
        <form class="d-flex" role="search">
          <input class="form-control me-2" type="search"  aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
        <a class="user" href="#"> <i class="lni lni-user"></i>
          <span>SACCO</span>
        </a>
      </div>
    </nav> 
 <!------------------------- main ----------->
  <div class="container mt-5">
      <h2 class="mb-4">SACCO Information Collection</h2>
      <form action="sacco.php" method="post">

         
          
          <div class="form-group">
              <label for="Sacco_Name">SACCO Name:</label>
              <input type="text" class="form-control" id="Sacco_Name" name="Sacco_Name" placeholder="Enter Sacco_Name">
          </div>
          <div class="form-group">
            <label for="Registration_Number">Registration Number:</label>
            <input type="text" class="form-control" id="Registration_Number" name="Registration_Number" placeholder="Enter Registration_Number">
        </div>

          <button type="submit" class="btn btn-success"  name="register" >Submit</button>
          
      </form>

  </div>
  </div>
     
 
<!-----------------section----------------->

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="script-sacco.js"></script>
  </body>


