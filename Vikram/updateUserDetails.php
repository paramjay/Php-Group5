<?php 
require ('config/dbinit.php');
require('function.php');
require('user.php');

$db = new Database();
$conn = $db->getConnection();

$user_data = check_login($conn);

function validateInput($input) {
    $validatedInput = trim($input);
    $validatedInput = stripslashes($validatedInput);
    $validatedInput = htmlspecialchars($validatedInput);
    return $validatedInput;
}
$msg='';
$user;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $id = validateInput($_POST['user_id']);
    $name = validateInput($_POST['name']);
    $email = validateInput($_POST['email']);
    $type = validateInput($_POST['type']);
    $address = validateInput($_POST['address']);
    $postal_code = validateInput($_POST['postal_code']);
    $country = validateInput($_POST['country']);
    
    
    
    if (empty($name)) {
        $errors[]= "Name is required.";
    }
    if (empty($email)) {
        $errors[]= "Email is required.";
    }
    if($id==0){
    $password = validateInput($_POST['password']);
    if (empty($password)) {
        $errors[]= "Password is required.";
    }
    }

    if (empty($type)) {
        $errors[]= "User type is required.";
    }
    if (empty($address)) {
        $errors[]= "Address is required.";
    }
    if (empty($postal_code)) {
        $errors[]= "Postal code is required.";
    }
    if (empty($country)) {
        $errors[]= "Country is required.";
   
        
    }
    if (empty($errors)) {
        
        if($id!=0){
            $sql = "UPDATE tbl_users SET user_name=:name, user_email=:email,  user_type=:type,
             user_address=:address, user_postal_code=:postal_code, user_country=:country
                where user_id='".$id."'";
             $stmt = $conn->prepare($sql);
       
        }else{
        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO tbl_users (user_name, user_email, user_password, user_type, user_address, user_postal_code, user_country)
            VALUES (:name, :email, :password, :type, :address, :postal_code, :country)";
             $stmt = $conn->prepare($sql);
             $stmt->bindParam(':password', $hashed_password);
        }

       
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':type', $type);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':postal_code', $postal_code);
        $stmt->bindParam(':country', $country);
       

        if ($stmt->execute()) {
            
            
            
            $msg.="<div class='bg-success-subtle d-grid p-3'>";
            if($id!=0){
                $msg.= "<span class='text-success'>User details Updated successfully!</span>";
            }else{
                $msg.= "<span class='text-success'>User details added successfully!</span>";
            }
            $msg.="</div>";
        } else {
            $msg.="<div class='d-grid'>";
            $msg.= "<span class='bg-danger-subtle text-danger'>Error: " . $stmt->error . "</span>";
            $msg.="</div>";
            
        }

    } else {
        
        $msg.="<div class='bg-danger-subtle d-grid p-3'>";
        foreach ($errors as $error) {
            $msg .= "<span class=' text-danger'>$error</span>";
        }
        $msg.="</div>";
        if($id!=0){
            $userManager = new User($db);
            $users = $userManager->getUserDetailsById($id);
        }
    }
  
  }
  else{
    if(!empty($_GET['id'])){
    $sql = "SELECT * FROM tbl_users WHERE user_id='".$_GET['id']."'";

    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $user = $stmt->fetchAll();
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Add/Edit User Deatils</title>
<?php
      require('layouts/commonHead.php');
    ?>
  </head>
  <body data-bs-spy="scroll" data-bs-target="#navbar" data-bs-root-margin="0px 0px -40%" data-bs-smooth-scroll="true" tabindex="0">
    <?php
      require('layouts/header.php');
    ?>
<br><br><br>
    <main>
        <h2 style="margin-left: 80px;">Add/Edit User Details</h2>
        <div style="margin-left: 80px;">
        <div class="mt-4 mb-4">
            <div class="card shadow rounded-4">
                <div class="card-body p-4">
                    <form action="#" method="POST" >
                    <?php
                        if(!empty($msg)){
                            echo '<div class="mb-3">';
                            echo $msg;
                            echo '</div>';
                        }
                    ?>
                    <input type="hidden" class="form-control" id="user_id" 
                            name="user_id" 
                            value="<?php
                                if(!empty($user)){
                                    echo $user[0]['user_id'];
                                }
                                else{
                                    echo '0';
                                }
                            ?>">
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" 
                            name="name" placeholder="Enter the name of User..." 
                            <?php
                                if(!empty($user)){
                                    echo 'value="'.$user[0]['user_name'].'" ';
                                }
                            ?>
                            >
                        </div>

                        <div class="row g-3">
                        <div class="col-sm-6">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" 
                            name="email" placeholder="Enter the Email of User..." 
                            <?php
                                if(!empty($user)){
                                    echo 'value="'.$user[0]['user_email'].'" ';
                                }
                            ?>
                            >
                        </div>
                        <?php if (empty($_GET['id'])): ?>
                        <div class="col-sm-6">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" 
                            name="password" >
                        </div>
                        <?php endif; ?>

                     <div class="row mt-2">
                        <div class="col-sm-6">
                            <label for="type" class="form-label">Type</label>
                            <select type="text" class="form-control" id="type" name="type" >
                                <option value="">--- select ---</option>
                                <option value="Admin" <?php
                                if(!empty($user)){
                                    if($user[0]['user_type']=='Admin'){
                                        echo 'Selected="selected"';
                                    }
                                }
                                ?>>Admin</option>
                                <option value="Buyer" <?php
                                if(!empty($user)){
                                    if($user[0]['user_type']=='Buyer'){
                                        echo 'Selected="selected"';
                                    }
                                }
                                ?>>Buyer</option>
                            </select>
                        </div>
                    
                     <div class="row g-3">
                        <div class="col-sm-6">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control" id="address" 
                            name="address" placeholder="Enter the address of user..." 
                            <?php
                                if(!empty($user)){
                                    echo 'value="'.$user[0]['user_address'].'" ';
                                }
                            ?>
                            >
                        </div>

                        <div class="row g-3">
                        <div class="col-sm-6">
                            <label for="postal_code" class="form-label">Postal Code</label>
                            <input type="text" class="form-control" id="postal_code" 
                            name="postal_code" placeholder="Enter the postal code of user..." 
                            <?php
                                if(!empty($user)){
                                    echo 'value="'.$user[0]['user_postal_code'].'" ';
                                }
                            ?>
                            >
                        </div>

                        <div class="row g-3">
                        <div class="col-sm-6">
                            <label for="country" class="form-label">Country</label>
                            <input type="text" class="form-control" id="country" 
                            name="country" placeholder="Enter the country of user..." 
                            <?php
                                if(!empty($user)){
                                    echo 'value="'.$user[0]['user_country'].'" ';
                                }
                            ?>
                            >
                        </div>


                    
                    <div class="text-center m-3">
                        <input type="submit" class="btn btn-primary" value="Submit">
                    </div>
                    </form>
                </div>
            </div>
        </div>
        </div>
      </main>
      <br/>
      <br/>
      <br/>
      <?php
      require('layouts/footer.php');
    ?>
      