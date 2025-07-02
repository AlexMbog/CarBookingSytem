<?php
include 'conn.php';
?> 
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BeBA bEBa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.lineicons.com/4.0/lineicons.css" />
    <link rel="stylesheet" href="STYLES/register_styles.css">
  </head>
  <body class="bg-light main">
    <div class="container">
      <div class="row mt-5" >
        <div class="col-lg-4  m-auto rounded-top rounded-bottom wrapper">
          <h2 class="text-center pt-3">BeBA bEBa</H2>
        
          <form action="registration.php" method="post">
            <div class="input-group mb-2">
                <span class="input-group-text"><i class="lni lni-user"></i></span>
                <input type="text" class="form-control" id="name" name="user_Name" placeholder="Enter your name" required>
            </div>
            <div class="input-group mb-2">
                <span class="input-group-text"><i class="lni lni-envelope"></i></span>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
            </div>
    
            <div class="input-group mb-2">
                <span class="input-group-text"><i class="lni lni-lock-alt"></i></span>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
               <!-- <button id="toggleButton" type="togglePassword" onclick="togglePassword()"><i class="lni lni-eye"></i></button> ---->
            </div>
    
            <div class="input-group mb-2">
                <span class="input-group-text"><i class="lni lni-phone"></i></span>
                <input type="text" class="form-control" id="phoneNumber" name="phoneNumber"  placeholder="Enter your phone Number"required>
            </div>
            <div class="input-group mb-2">
            <span class="input-group-text"><i class="lni lni-users"></i></i></span>
                <select class="form-select" id="gender" name="gender" required>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                </select>
            </div>
            <div class="d-grid mt-2">
            <button type="submit" class="btn btn-dark"  name="register">Signup</button>
            <p class="text-center mt-2">
            <a href="user_login.php">Already have an account?</a>
            </div>
      
          </form>

        </div>
      </div>
    </div>



  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <script>
    function togglePassword() {
        var passwordInput = document.getElementById("password");
        var toggleButton = document.getElementById("toggleButton");

        if (passwordInput && toggleButton) {
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                toggleButton.innerHTML = '<i class="lni lni-eye-off"></i>';
            } else {
                passwordInput.type = "password";
                toggleButton.innerHTML = '<i class="lni lni-eye"></i>';
            }
        }
    }
</script>

  </body>


