<?php 

session_start();
require('config/dbinit.php');
require('function.php');


	if($_SERVER['REQUEST_METHOD'] == "POST")
	{

		$user_name = $_POST['username'];
		$user_password = $_POST['password'];

		if(!empty($user_name) && !empty($user_password))
		{

			//read from database
			$sql = "select * from users where user_name = '$user_name' limit 1";
			$result = mysqli_query($con, $sql);

			if($result)
			{
				if($result && mysqli_num_rows($result) > 0)
				{

					$user_data = mysqli_fetch_assoc($result);
					
					if($user_data['password'] === $user_password)
					{

						$_SESSION['user_id'] = $user_data['user_id'];
						header("Location: index.php");
						die;
					}
				}
			}
			
			echo "wrong username or password!";
		}else
		{
			echo "wrong username or password!";
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
                    <label for="exampleInputEmail1" class="form-label">Username/Email address</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" >
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1">
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