<?php
session_start();
require('config/dbinit.php');
require('function.php');

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $user_name = $_POST['username'];
    $user_email = $_POST['email'];
    $user_type = $_POST['usertype'];
    $user_password = $_POST['password'];
    $user_address = $_POST['address'];
    $user_postal_code = $_POST['postalCode'];
    $user_country = $_POST['country'];

    $hashed_password = password_hash($user_password, PASSWORD_DEFAULT);


    if(!empty($user_name) && !empty($user_email) && !empty($user_password) && !empty($user_type) && !empty($user_address) && !empty($user_postal_code) && !empty($user_country))
		{

    // SQL query to insert user data into database
    $sql = "INSERT INTO users (username, email, usertype, password, address, postalCode, country) 
            VALUES ('$user_name', '$user_email', '$user_type', '$hashed_password', '$user_address', '$user_postal_code', '$user_country')";

    if (mysqli_query($conn, $sql)) {
      header("Location: login.php");
      exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
   }
}

?>



<!DOCTYPE html>
<html>
  <head>
    <title>Sign Up</title>
    <?php
      require('layouts/commonHead.php');
    ?>
  </head>
  <body data-bs-spy="scroll" data-bs-target="#navbar" data-bs-root-margin="0px 0px -40%" data-bs-smooth-scroll="true" tabindex="0">
    <?php
      require('layouts/header.php');
    ?>

    <section id="signup-banner" class="position-relative overflow-hidden bg-light-blue mb-5" style = "height:1200px">
        <div class="row d-flex flex-wrap align-items-center">
        <div class="col-md-6 col-sm-12">
          <div class="text-content offset-4 padding-medium">
            <br/>
            <h2 class="display-2 pb-5 text-uppercas text-light">Sign Up</h2>
            <form class=" card card-body fs-6 bg-opacity-75 bg-black text-white" method="post" > 
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" >
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="email" >
                </div>
                <div class="mb-3">
                    <label for="usertype" class="form-label">User-Type</label>
                    <select class="form-select" id="usertype" >
                        <option value="Buyer">Buyer</option>
                        <option value="Admin">Admin</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1">
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" class="form-control" id="address">
                </div>
                <div class="mb-3">
                    <label for="postalCode" class="form-label">Postal Code</label>
                    <input type="text" class="form-control" id="postalCode">
                </div>
                <div class="mb-3">
                    <label for="country" class="form-label">Country</label>
                    <input type="text" class="form-control" id="country">
                </div>
                
                <button type="submit" class="btn btn-primary mt-3">Submit</button>
                <span class="text-center m-3">Already have an account? <a class="btn-link ml-2" href="login.php">Login</a></span>
                
            </form> 
          </div>
        </div>
      </div>
      </div>
    </section>

    <?php
      require('layouts/footer.php');
    ?>
    
    
  </body>
</html>