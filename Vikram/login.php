<?php

session_start();
require('config/dbinit.php');
require('function.php');

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];
    
    if (!empty($user_email) && !empty($user_password)) {
        
        // Prepare and execute the SQL query
        $sql = "SELECT * FROM tbl_users WHERE user_email = :user_email LIMIT 1";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['user_email' => $user_email]);
        
        // Check if there's a result
        if ($stmt) {
            // Fetch the user data
            $user_data = $stmt->fetch();
            echo "$user_password :  {$user_data['user_password']}";
            // Verify password
            if ($user_data && password_verify($user_password, $user_data['user_password'])) {
                $_SESSION['user_id'] = $user_data['user_id'];
                header("Location: index.php");
                die;
            }else{
              echo "Invalid username or password!";
            }
        } 
        
    } else {
        echo "Wrong username or password!";
    }
}

?>



<!DOCTYPE html>
<html>
  <head>
    <title>Login</title>
    <?php
      require('layouts/commonHead.php');
    ?>
  </head>
  <body data-bs-spy="scroll" data-bs-target="#navbar" data-bs-root-margin="0px 0px -40%" data-bs-smooth-scroll="true" tabindex="0">
    <?php
      require('layouts/header.php');
    ?>

    <section id="login-banner" class="position-relative overflow-hidden bg-light-blue mb-5">
        <div class="row d-flex flex-wrap align-items-center">
        <div class="col-md-6 col-sm-12">
          <div class="text-content offset-4 padding-medium">
            <br/>
            <h2 class="display-2 pb-5 text-uppercas text-light">Login</h2>
            <form class=" card card-body fs-6 bg-opacity-75 bg-black text-white" method="post"> 
                <div class="mb-3">
                    <label for="user_email" class="form-label">Username/Email address</label>
                    <input type="email" class="form-control" id="user_email" name = "user_email" >
                </div>
                <div class="mb-3">
                    <label for="user_password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="user_password" name="user_password">
                </div>
                <button type="submit" class="btn btn-primary mt-3">Submit</button>
                <span class="text-center m-3">Don't have an account? <a class="btn-link" href="registration.php">Sign Up</a></span>
                
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